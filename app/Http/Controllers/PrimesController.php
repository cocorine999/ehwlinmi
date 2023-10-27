<?php

namespace App\Http\Controllers;

use App\Jobs\Paiements\CheckPaiementStatusJob;
use App\Jobs\Paiements\PayerPrimeJob;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Nsia;
use App\Models\Primes;
use App\Models\Contrat;
use App\Models\MobileMoney;
use App\Models\Souscription;
use App\Models\StatutSouscription;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SuperMarchand;
use App\Models\Ticket;
use App\Traits\MobilePaiement;
use App\Traits\ServicesValidationTrait;
use Session;

class PrimesController extends Controller
{

  use MobilePaiement, ServicesValidationTrait;

  public function test()
  {
    #$payingUser = User::where('telephone', '=', '67929211')->first();
    #$payingUser = User::where('telephone', '=', '95071520')->first();
    #$paiement = $this->pay($payingUser, config('prices.'.config('app.env').'.prime'), "MOOV", "primeC".$payingUser->id );
    #dd($paiement);

    #$this->add_error('Paiement non effectué');
  }

  public function index()
  {
    $primes = Auth::user()->primes;
    return view('dash.primes.index', compact(['primes']));
  }

  public function create()
  {
    $primes = Auth::user()->primes;
    return view('dash.primes.create', compact(['primes']));
  }

  public function store(Request $request)
  {
    $request->validate(['prime' => 'required']);
    $prime = $request->prime;
    $error = False;
    $reste = 0;

    if ($prime > 12000) { // si le montant supérieur a 12000f
      toastr()->warning('Le total des primes ne peut etre supérieur à 12000.', 'Erreur');
      $error = True;
    }
    if ($prime % 1000 != 0) { //si le montant n'est pas multiple de 1000
      $monnaie = $prime % 1000;
      $proposition = $prime - $monnaie;
      toastr()->warning('Veuillez enregistrer un multiple de 1000. Proposition: ' . $proposition . ' ou ' . ($proposition + 1000), 'Erreur');
      $error = True;
    }

    // recuperer le contrat
    $reference = $request->reference;
    $contrat = Contrat::where('reference', '=', $reference)->first();

    if ($contrat) {
      // si le statut du contrat est dans la liste suivante (pas bon)
      if (in_array($contrat->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Terminé'], true)) {
        toastr()->warning('Vous ne pouvez pas enregistrer de primes sur ce contrat.', 'Erreur');
        $error = True;
      } else { // si le statut est bon
        if ($contrat->souscriptions->last()->primes->count() > 0) { // et que le contrat dispose deja de primes
          // calcul du reste ici
          $reste = (12 - $contrat->souscriptions->last()->primes->count()) * 1000; // primes restantes
          if ($reste == 0) {
            toastr()->warning('Ce client est déja à jour pour ce contrat.', 'Erreur');
            $error = True;
          } else {
            if ($prime > $reste) {
              toastr()->warning('Ce client doit payer: ' . $reste . ' F. La prime fournie ne peut être supérieure à ce montant.', 'Erreur');
              $error = True;
            }
          }
        }
      }
    } else {
      toastr()->warning('Veuillez entrer un contrat valide.', 'Erreur');
      $error = True;
    }

    if ($error) {
      return redirect()->route('primes.create');
      exit();
    } // breakIfErrors

    if ($contrat) {
      $auth_id = Auth::id();
      $payingUser = $contrat->client->users->first();
      $final_primes = 1 + $contrat->souscriptions->last()->primes->count();
      $paiement = $this->pay($payingUser, $prime, $request->paiementChoice, $contrat->reference . "S" . $contrat->souscriptions->count() . "P" . $final_primes);
      # $paiement = true;
      if ($paiement['status'] == "SUCCESS") {
        $this->process_paiement_prime($contrat, $prime, $auth_id);
        # $this->sendSMS($contrat->client->users->first()->shortFullName . ', votre payement de ' . $request->prime . 'F est recu pour le contrat ' . $contrat->reference . '. Reste a payer ' . $reste . '. GMMS et NSIA vous remercient.', $contrat->client->users->first());
        $this->sendSMS($contrat->client->users->first()->shortFullName . ', votre payement de ' . $request->prime . 'F est recu pour le contrat ' . $contrat->reference . '. GMMS et NSIA vous remercient.', $contrat->client->users->first());
        toastr()->success('Prime enregistrée avec succès.', 'Succès');
        toastr()->success('Commissions transférées avec succès.', 'Succès');
        Session::flash('success', 'Prime enregistrée avec succès.');
        Session::flash('success', 'Commissions transférées avec succès.');
        return redirect()->route('primes.create');
      } else {
        CheckPaiementStatusJob::dispatch($paiement['transref'], $contrat, $auth_id, "prime")->delay(now()->addMinutes(10));
        toastr()->error('Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.', 'Erreur');
        Session::flash('errors', ['Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.']);
        $this->add_error('Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.');
        return redirect()->route('primes.create');
      }
    } else {
      toastr()->warning('Veuillez entrer un contrat valide.', 'Erreur');
      return redirect()->route('primes.index');
    }
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store_correction_maintenance($ticket, $transref)
  {
    $ticket = Ticket::find($ticket);
    $momo = MobileMoney::where('transref', '=', $transref)->first();
    $prime = $momo->montant;

    $reference = $ticket->contrat->reference;
    $error = False;
    $reste = 0;
    $contrat = Contrat::where('reference', '=', $reference)->first();


    if ($contrat) {
      // si le statut du contrat est dans la liste suivante (pas bon)
      if (in_array($contrat->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Terminé'], true)) {
        dump('Vous ne pouvez pas enregistrer de primes sur ce contrat. Contrat ' . $contrat->statut, 'Erreur');
        $error = True;
      } else { // si le statut est bon
        if ($contrat->souscriptions->last()->primes->count() > 0) { // et que le contrat dispose deja de primes
          // calcul du reste ici
          $reste = (12 - $contrat->souscriptions->last()->primes->count()) * 1000; // primes restantes
          if ($reste == 0) {
            dump('Ce client est déja à jour pour ce contrat.', 'Erreur');
            $error = True;
          } else {
            if ($prime > $reste) {
              dump('Ce client doit payer: ' . $reste . ' F. La prime fournie ne peut être supérieure à ce montant.', 'Erreur');
              $error = True;
            }
          }
        }
      }
    } else {
      dump('Veuillez entrer un contrat valide.', 'Erreur');
      $error = True;
    }

    if ($error) {
      sleep(10);
      return back()->withErrors(['Cette transaction ne concerne pas ce contrat']);
    } // breakIfErrors

    if ($contrat) {
      $auth_id = Auth::id();
      $this->process_paiement_prime($contrat, $prime, $auth_id);

    } else {
      dump('Veuillez entrer un contrat valide.', 'Erreur');
    }

    dump('Tickect Fermé. Redirection en cours', 'success');

    $ticket->status_id = 3;
    $ticket->transref = $transref;
    $ticket->corrected_by_user_id = Auth::id();
    $ticket->corrige_le = Carbon::now();
    $ticket->save();

    $momo->response_msg = $momo->response_msg . 'success VM';
    $momo->save();

    sleep(10);
    Session::flash('success', 'opération effectue');
    return redirect()->route('tickets.show', $ticket->id);
  }


  public function contrat_primes($reference)
  {
    $contrat = Contrat::where('reference', $reference)->first();
    if ($contrat) {
      $primes = $contrat->souscriptions->last()->primes;
    } else {
      abort(404);
    }
    return view('dash.primes.index_list', compact(['primes']));
  }
}
