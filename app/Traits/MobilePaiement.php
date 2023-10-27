<?php

namespace App\Traits;

use App\Models\MobileMoney;
use Auth;

trait MobilePaiement
{
  // user objet, montant, MTN | MOOV, narration
  protected function makePay($payingUser, $amount, $reseau, $motif)
  {
    $transref = time() . config('paiement.' . $reseau . '.CLIENTID');
    $data = [
      "msisdn"        =>  '22955028592'/*  . $payingUser->telephone */,
      "amount"        =>  $amount,
      'firstname'     =>  $payingUser->nom,
      'lastname'      =>  $payingUser->prenom,
      'transref'      =>  $transref,
      'clientid'      =>  config('paiement.' . $reseau . '.CLIENTID'),
      'narration'     =>  $motif
    ];

    // save transaction in database
    $momo = MobileMoney::create([
      'msisdn'        => '22955028592'/*  . $payingUser->telephone */,
      #'msisdn'        => '22995071520',
      'operation_type' => "REQUESTPAYMENT",
      'operateur'     => $reseau,
      'amount'        => $amount,
      'response'      => "not set",
      'response_code' => "not set",
      'response_msg'  => "not set",
      'transref'      => $transref,
      'firstname'     => $payingUser->nom,
      'lastname'      => $payingUser->prenom,
      'narration'     => $motif,
      'user_id'       => Auth::id(),
    ]);

    $client = new \GuzzleHttp\Client(['headers' => ['content-type' => 'application/json'], 'verify' => false]);
    $response = $client->request('POST', config('paiement.' . $reseau . '.REQUEST_PAYMENT_URL'), [
      'auth' => [config('paiement.' . $reseau . '.USERNAME'), config('paiement.' . $reseau . '.PASSWORD')], 'json' => $data,
    ]);

    dump('Requete de paiement envoyé vers 55028592'/*  . $payingUser->telephone */ . ' : ' . $payingUser->shortFullname);
    $response = $response->getBody()->getContents();
    $str_response = $response;
    $response = json_decode($response);

    $momo->update([
      'response'      => $str_response,
      'response_code' => $response->responsecode,
      'response_msg'  => $response->responsemsg,
    ]);

    if ($reseau == "MOOV") {
      return $response;
    } else {
      return $response->transref;
    }
  }

  protected function get_status($transref, $reseau)
  {
    $data = [
      'transref' => $transref,
      'clientid' => config('paiement.' . $reseau . '.CLIENTID'),
    ];
    $client = new \GuzzleHttp\Client(['headers' => ['content-type' => 'application/json'], 'verify' => false]);
    $response = $client->request('POST', config('paiement.' . $reseau . '.TRANSACTION_STATE_URL'), [
      'auth' => [config('paiement.' . $reseau . '.USERNAME'), config('paiement.' . $reseau . '.PASSWORD')], 'json' => $data,
    ]);

    dump('Verification état de la transaction...');
    $response = $response->getBody()->getContents();
    $str_response = $response;
    $response = json_decode($response); //json proper

    $momo = MobileMoney::where('transref', '=', $transref)->first();
    $momo->update([
      'response'      => $str_response,
      'response_code' => $response->responsecode,
      'response_msg'  => $response->responsemsg,
    ]);

    #dd($response);

    $readable_status = null;
    if ($reseau == "MOOV") {
      $readable_status = $this->translateResponseMOOV($response);
    } else {
      $readable_status = $this->translateResponseMTN($response);
    }
    return $readable_status;
  }

  protected function translateResponseMTN($response)
  {
    // dump($response);
    $response_code = $response->responsecode;
    $response_msg = $response->responsemsg;
    if ($response_code == "00") {
      toastr()->success('Transaction réussie', 'Transaction réussie');
      dump('Transaction réussie');
      return "SUCCESS";
    } elseif ($response_code == "01") {
      toastr()->info('Transaction en attente | ' . $response_msg, 'Transaction en attente');
      dump('Transaction en attente');
      return "CONTINUELOOP";
    } elseif ($response_code == "-1") {
      toastr()->error('Paramètres non complets | ' . $response_msg, 'Paramètres incomplets');
      dump('Paramètres non complets');
      return "CONTINUELOOP";
    } elseif ($response_code == "-2") {
      toastr()->error('Mot de pass non valide | ' . $response_msg, 'Mot de pass invalide');
      dump('Mot de pass non valide');
      return "STOP";
    } elseif ($response_code == "100") {
      toastr()->error('General failure | ' . $response_msg, 'Identifiants invalides');
      dump('Identifiants non valides');
      return "STOP";
    } elseif ($response_code == "515") {
      toastr()->error('Compte non trouvé | ' . $response_msg, 'Compte non trouvé');
      dump('Compte non trouvé');
      return "STOP";
    } else {
      toastr()->error('Erreur inconnue. Réponse vide. ' . $response_msg, 'Identifiants invalides');
      dump('Erreur inconnue. Réponse vide. ' . $response_msg);
      return "STOP";
    }
  }

  protected function translateResponseMOOV($response)
  {
    // dump($response);
    $response_code = $response->responsecode;
    $response_msg = $response->responsemsg;

    if ($response_code == "0") {
      dump('Transaction réussie | ' . $response_msg);
      return "SUCCESS";
    } elseif ($response_code == "8") {
      dump('Mot de passe entré invalide | ' . $response_msg);
      return "ERROR";
    } elseif ($response_code == "33") {
      dump('Compte bloqué | ' . $response_msg);
      return "ERROR";
    } elseif ($response_code == "92") {
      dump('Requete de paiement non acceptée par l\'utilisateur | ' . $response_msg);
      return "ERROR";
    } elseif ($response_code == "94") {
      dump('La transaction n\'existe pas | ' . $response_msg);
      return "ERROR";
    } elseif ($response_code == "95") {
      dump('Les transactions ont échoué en raison d\'une <erreur> | ' . $response_msg);
      return "ERROR";
    } elseif ($response_code == "91") {
      dump('Paramètres non complets | ' . $response_msg);
      return "ERROR";
    } elseif ($response_code == "98") {
      dump('Identifiants non valides | ' . $response_msg);
      return "ERROR";
    } elseif ($response_code == "99" || $response_code == "-1") {
      dump('Systeme occupé | Erreur de connexion à la base de données | ' . $response_msg);
      return "ERROR";
    } else {
      return "ERROR";
    }
  }

  protected function pay($payingUser, $amount, $reseau, $motif)
  {
    $paiement_result_data = [];
    if (config('app.env') == 'local') {
      $amount = 1;
    }
    $transref = $this->makePay($payingUser, $amount, $reseau, $motif);
    $paiement_result_data['transref'] = $transref;
    $actual_status_flag = null;
    if ($reseau == "MOOV") {
      $paiement_result_data['transref'] = $transref->transref;
      $paiement_result_data['status'] = $this->translateResponseMOOV($transref);
    } else {
      if ($transref) { //loop for MTN
        $stepper = 0;
        $max_exec_time = 70; // max paiement delay in seconds (1min 10s)
        do {
          sleep(5);
          $stepper += 5;
          if ($stepper < $max_exec_time) {
            $actual_status_flag = $this->get_status($transref, $reseau);
            if ($actual_status_flag == "CONTINUELOOP") { // continuer la boucle
              continue;
            } elseif ($actual_status_flag == "SUCCESS") { // paiement effectué
              break;
              dump("Paiement réussi. Redirection en cours.");
            }
          } elseif ($stepper >= $max_exec_time) {
            toastr()->error('Paiement non effectué', 'Erreur');
            $actual_status_flag = "STOP";
          }
        } while ($actual_status_flag == "CONTINUELOOP");
      } else {
        toastr()->error('Paiement non effectué', 'Erreur');
      }
      $paiement_result_data['status'] = $actual_status_flag;
    }

    return $paiement_result_data;
  }
}
