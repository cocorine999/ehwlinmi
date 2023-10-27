<?php

namespace App\Traits;

use App\Models\Contrat;
use App\Models\Primes;
use App\Models\Souscription;
use App\Models\SouscriptionStatutSouscription;
use App\Models\StatutSouscription;
use App\User;
use Auth;
use Carbon\Carbon;

trait ServicesValidationTrait
{

  public function process_paiement_souscription($contrat, $auth_id)
  {
    if ($contrat->souscriptions->last()->statut === "Attente de paiement") {
      $contrat->souscriptions->last()->update(['statut' => "Attente de traitement"]);
      $statut = StatutSouscription::whereLabel('Attente de traitement')->get();
      $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Paiement adhésion éffectué"]);

      if ($contrat->q1 == 0 && $contrat->q2 == 0 && $contrat->q3 == 0 && $contrat->q4 == 0 && $contrat->q5 == 1) {
        $contrat->souscriptions->last()->update(['statut' => "Attente de validation"]);
        $statut = StatutSouscription::whereLabel('Attente de validation')->get();
        $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Attente de validation"]);
      }

      $direction = User::role(config('custom.roles.direction'))->first();
      $direction->getWallet('principal')->deposit(1000  * config('custom.points.coefficient'));
    } else {
      $this->process_paiement_prime($contrat, 1000, $auth_id);
    }
  }


  public function process_paiement_renouvellement($contrat, $auth_id)
  {
    if ($contrat->souscriptions->last()->statut === "Terminé") {
      // creation de la souscription
      $souscription = Souscription::create([
        "statut" => "Attente de validation",
        "user_id" => $auth_id,
        "contrat_id" => $contrat->id
      ]);
      $souscription = Souscription::findOrFail($souscription->id);

      // si la date d'aujourdhui est inferieur à la date d'effet actuelle + 1 an ,
      // la nouvelle valeur est la date d'effet actuelle + 1 an
      // sinon
      // la nouvelle valeur est la date d'effet actuelle + 1 an

      $contrat = Contrat::find($contrat->id);

      $statut = StatutSouscription::whereLabel('Attente de validation')->first();
      $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Renouvellement"]);
      // envoyer l'sms de renouvellement
      // $this->sendSMS($contrat->client->users->first()->shortFullName . ', votre contrat ' . $contrat->reference . ' est renouvelé avec succes. Tachez de payer la premiere prime pour le valider. GMMS et NSIA vous remercient.', $contrat->client->users->first());

      // envoyer les sous dans le compte de MMS
      $direction = User::role(config('custom.roles.direction'))->first();
      $direction->getWallet('principal')->deposit(1000  * config('custom.points.coefficient'));
    }
  }


  public function process_paiement_prime($contrat, $prime, $auth_id)
  {
    // $contrat = $this->contrat;
    // $prime = $this->prime;
    // $auth_id = $this->auth_id;
    $montant_payee = $prime;
    $commissions = null;

    if ($contrat->souscriptions->last()->primes->count() == 0) { // si le contrat n'a pas encore de primes
      if ($prime == 1000) {
        $n = 1;
        $commissions = [
          "actual_marchand"   => 200 * config('custom.points.coefficient'),
          "super_marchand"    => 100 * config('custom.points.coefficient'),
          "direction"         => 25 * config('custom.points.coefficient'),
          "nsia"              => 675 * config('custom.points.coefficient'),
        ];

        $contrat->souscriptions->last()->update(['statut' => "Valide", 'date_effet' => Carbon::now()->format('Y-m-d')]);
        $statut = StatutSouscription::whereLabel('Valide')->get();
        $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Validation automatique"]);

        $this->payerPrime($n, $contrat->souscriptions->last(), $commissions, $auth_id);
      } elseif ($prime > 1000) {
        $n = 1;
        $commissions = [
          "actual_marchand"   => 200 * config('custom.points.coefficient'),
          "super_marchand"    => 100 * config('custom.points.coefficient'),
          "direction"         => 25 * config('custom.points.coefficient'),
          "nsia"              => 675 * config('custom.points.coefficient'),
        ];
        $this->payerPrime($n, $contrat->souscriptions->last(), $commissions, $auth_id);

        $prime = $prime - 1000;
        $n = $prime / 1000;
        $n = (int) $n;

        $commissions = [
          "actual_marchand"   => 180 * config('custom.points.coefficient'),
          "super_marchand"    => 65 * config('custom.points.coefficient'),
          "direction"         => 80 * config('custom.points.coefficient'),
          "nsia"              => 675 * config('custom.points.coefficient'),
        ];
        $this->payerPrime($n, $contrat->souscriptions->last(), $commissions, $auth_id);
      }
    } elseif ($contrat->souscriptions->last()->primes->count() > 0) {
      $n = $prime / 1000;
      $n = (int) $n;
      $commissions = [
        "actual_marchand"   => 180 * config('custom.points.coefficient'),
        "super_marchand"    => 65 * config('custom.points.coefficient'),
        "direction"         => 80 * config('custom.points.coefficient'),
        "nsia"              => 675 * config('custom.points.coefficient'),
      ];
      $this->payerPrime($n, $contrat->souscriptions->last(), $commissions, $auth_id);
    }

    $reste = ((12 - $contrat->souscriptions->last()->primes->count()) * 1000) - ((int) $montant_payee);

    if ($reste == 0) {
      $contrat->souscriptions->last()->update(['statut' => "Terminé"]);
      $statut = StatutSouscription::whereLabel('Terminé')->get();
      $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Primes totalement payées"]);
      toastr()->success('Prime enregistrée avec succès.', 'Succès');
    }
    // $this->sendSMS($contrat->client->users->first()->shortFullName.', votre payement de '.$montant_payee.'F est recu pour le contrat '.$contrat->reference.'. Reste a payer '.$reste. '. GMMS et NSIA vous remercient.' , $contrat->client->users->first());
  }

  private function calcul_penalite($souscription, $commissions)
  {
    // recalculer déja les commissions si contrat en retart ici
    $retard = $souscription->retardEnMois;
    if ($retard) {
      $commissions['actual_marchand'] = $commissions['actual_marchand'] - ($commissions['actual_marchand'] * 0.1);
      $commissions['super_marchand'] = $commissions['super_marchand']  - ($commissions['super_marchand'] * 0.1);
      $commissions['direction'] = $commissions['direction'] + ($commissions['actual_marchand'] * 0.1) + ($commissions['super_marchand'] * 0.1);
      $commissions['nsia'] = $commissions['nsia'];
      return $commissions;
    }
    return $commissions;
  }

  private function payerPrime($n, $souscription, $commissions, $auth_id)
  {
    $first_marchand_user = $souscription->contrat->marchands->first()->users->first();
    $actual_marchand_user = $souscription->contrat->marchands->last()->users->first();

    // Bloc controllant la gestion des penalités
    if ($first_marchand_user->getKey() == $actual_marchand_user->getKey() && $souscription->contrat->marchands->count() == 1) {

      $super_marchand = $actual_marchand_user->marchand->first()->super_marchands->last()->users->first();
      $direction = User::role(config('custom.roles.direction'))->first();
      $nsia = User::role(config('custom.roles.nsia'))->first();

      for ($i = 0; $i < $n; $i++) {
        $commissions = $this->calcul_penalite($souscription, $commissions);
        $actual_marchand_user->getWallet('commission')->deposit($commissions['actual_marchand']);
        $super_marchand->getWallet('commission')->deposit($commissions['super_marchand']);
        $direction->getWallet('commission')->deposit($commissions['direction']);
        $nsia->getWallet('commission')->deposit($commissions['nsia']);
        $createdprime = Primes::create([
          'souscription_id' => $souscription->id,
          'montant'    => 1000,
          'user_id' => $auth_id,
          'c_marchand' => $commissions['actual_marchand'],
          'c_smarchand' => $commissions['super_marchand'],
          'c_nsia' => $commissions['nsia'],
          'c_mms' => $commissions['direction'],
        ]);
      }
    } else {   // si le 1er marchand  du contrat est different du marchand actuel
      // on recalcule les commissions a dispatcher
      // 70 pour l'ancien et 30 pour le nouveau
      $first_marchand_user = $first_marchand_user->marchand->first()->super_marchands->last()->users->first();
      $super_marchand = $actual_marchand_user->marchand->first()->super_marchands->last()->users->first();
      $direction = User::role(config('custom.roles.direction'))->first();
      $nsia = User::role(config('custom.roles.nsia'))->first();

      for ($i = 0; $i < $n; $i++) {
        $commissions = $this->calcul_penalite($souscription, $commissions);
        // nouveau calcul
        $commissions['first_marchand']   = 0.7 * $commissions['actual_marchand'];
        $commissions['actual_marchand']  = 0.3 * $commissions['actual_marchand'];

        $first_marchand_user->getWallet('commission')->deposit($commissions['first_marchand']);
        $actual_marchand_user->getWallet('commission')->deposit($commissions['actual_marchand']);
        $super_marchand->getWallet('commission')->deposit($commissions['super_marchand']);
        $direction->getWallet('commission')->deposit($commissions['direction']);
        $nsia->getWallet('commission')->deposit($commissions['nsia']);

        $createdprime = Primes::create([
          'souscription_id' => $souscription->id,
          'montant'    => 1000,
          'user_id' => $auth_id,
          'c_first_marchand' => $commissions['first_marchand'],
          'c_marchand' => $commissions['actual_marchand'],
          'c_smarchand' => $commissions['super_marchand'],
          'c_nsia' => $commissions['nsia'],
          'c_mms' => $commissions['direction'],
        ]);
      }
    }
  }
}
