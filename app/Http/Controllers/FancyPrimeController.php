<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Nsia;
use App\Models\Primes;
use App\Models\Contrat;
use App\Models\Souscription;
use App\Models\StatutSouscription;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SuperMarchand;
use Session;

class FancyPrimeController extends Controller
{
  private function calcul_penalite($souscription, $commission)
  {
    // recalculer déja les commissions si contrat en retart ici
    $retard = $souscription->retardEnMois;
    if ($retard) {
      $commission['actual_marchand'] = $commission['actual_marchand'] - ($commission['actual_marchand'] * 0.1);
      $commission['super_marchand'] = $commission['super_marchand']  - ($commission['super_marchand'] * 0.1);
      $commission['direction'] = $commission['direction'] + ($commission['actual_marchand'] * 0.1) + ($commission['super_marchand'] * 0.1);
      $commission['nsia'] = $commission['nsia'];
      return $commission;
    }
    return $commission;
  }

  private function payerPrime($n, $souscription, $commission)
  {
    $first_marchand_user = $souscription->contrat->marchands->first()->users->first();
    $actual_marchand_user = $souscription->contrat->marchands->last()->users->first();

    // Bloc controllant la gestion des penalités
    if ($first_marchand_user->getKey() == $actual_marchand_user->getKey() && $souscription->contrat->marchands->count() == 1) {

      $super_marchand = $actual_marchand_user->marchand->first()->super_marchands->last()->users->first();
      $direction = User::role(config('custom.roles.direction'))->first();
      $nsia = User::role(config('custom.roles.nsia'))->first();

      for ($i = 0; $i < $n; $i++) {
        $commission = $this->calcul_penalite($souscription, $commission);
        $actual_marchand_user->getWallet('commission')->deposit($commission['actual_marchand']);
        $super_marchand->getWallet('commission')->deposit($commission['super_marchand']);
        $direction->getWallet('commission')->deposit($commission['direction']);
        $nsia->getWallet('commission')->deposit($commission['nsia']);
        #dd([$n, $souscription, $commission]);
        $createdprime = Primes::create([
          'souscription_id' => $souscription->id,
          'montant'    => 1000,
          'user_id' => Auth::id(),
          'c_marchand' => $commission['actual_marchand'],
          'c_smarchand' => $commission['super_marchand'],
          'c_nsia' => $commission['nsia'],
          'c_mms' => $commission['direction'],
        ]);
      }
    } else {   // si le 1er marchand  du contrat est different du marchand actuel
      // on recalcule les commissions recues
      // 70 pour l'ancien et 30 pour le nouveau
      $first_marchand_user = $first_marchand_user->marchand->first()->super_marchands->last()->users->first();
      $super_marchand = $actual_marchand_user->marchand->first()->super_marchands->last()->users->first();
      $direction = User::role(config('custom.roles.direction'))->first();
      $nsia = User::role(config('custom.roles.nsia'))->first();

      for ($i = 0; $i < $n; $i++) {
        $commission = $this->calcul_penalite($souscription, $commission);
        // nouveau calcul
        $commission['first_marchand']   = 0.7 * $commission['actual_marchand'];
        $commission['actual_marchand']  = 0.3 * $commission['actual_marchand'];

        $first_marchand_user->getWallet('commission')->deposit($commission['first_marchand']);
        $actual_marchand_user->getWallet('commission')->deposit($commission['actual_marchand']);
        $super_marchand->getWallet('commission')->deposit($commission['super_marchand']);
        $direction->getWallet('commission')->deposit($commission['direction']);
        $nsia->getWallet('commission')->deposit($commission['nsia']);

        $createdprime = Primes::create([
          'souscription_id' => $souscription->id,
          'montant'    => 1000,
          'user_id' => Auth::id(),
          'c_first_marchand' => $commission['first_marchand'],
          'c_marchand' => $commission['actual_marchand'],
          'c_smarchand' => $commission['super_marchand'],
          'c_nsia' => $commission['nsia'],
          'c_mms' => $commission['direction'],
        ]);
      }
    }
  }

  private function notifyUser($contrat, $request)
  {
    $this->sendSMS('Souscription de ' . $request->prime . ' Francs enregistre pour votre contrat: ' . $contrat->reference, $contrat->client->users->first());
    toastr()->success('Prime enregistrée avec succès.', 'Succès');
    toastr()->success('Commissions transférées avec succès.', 'Succès');
    Session::flash('success', 'Prime enregistrée avec succès.');
    Session::flash('success', 'Commissions transférées avec succès.');
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
      $payingUser = $contrat->client->users->first();
      $final_primes = 1 + $contrat->souscriptions->last()->primes->count();
      $paiement = $this->pay($payingUser, $prime, $request->paiementChoice, $contrat->reference . "S" . $contrat->souscriptions->count() . "P" . $final_primes);
      #$paiement = true;
      if ($paiement) {
        if ($contrat->souscriptions->last()->primes->count() == 0) {
          if ($prime == 1000) {
            $n = 1;
            $commission = [
              "actual_marchand"   => 200 * config('custom.points.coefficient'),
              "super_marchand"    => 100 * config('custom.points.coefficient'),
              "direction"         => 25 * config('custom.points.coefficient'),
              "nsia"              => 675 * config('custom.points.coefficient'),
            ];

            $contrat->souscriptions->last()->update(['statut' => "Valide", 'date_effet' => Carbon::now()->format('Y-m-d')]);
            $statut = StatutSouscription::whereLabel('Valide')->get();
            $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Validation automatique"]);

            $this->payerPrime($n, $contrat->souscriptions->last(), $commission);
          } elseif ($prime > 1000) {
            $n = 1;
            $commission = [
              "actual_marchand"   => 200 * config('custom.points.coefficient'),
              "super_marchand"    => 100 * config('custom.points.coefficient'),
              "direction"         => 25 * config('custom.points.coefficient'),
              "nsia"              => 675 * config('custom.points.coefficient'),
            ];
            $this->payerPrime($n, $contrat->souscriptions->last(), $commission);

            $prime = $prime - 1000;
            $n = $prime / 1000;
            $n = (int) $n;

            $commission = [
              "actual_marchand"   => 180 * config('custom.points.coefficient'),
              "super_marchand"    => 65 * config('custom.points.coefficient'),
              "direction"         => 80 * config('custom.points.coefficient'),
              "nsia"              => 675 * config('custom.points.coefficient'),
            ];
            $this->payerPrime($n, $contrat->souscriptions->last(), $commission);
          }
        } elseif ($contrat->souscriptions->last()->primes->count() > 0) {
          $n = $prime / 1000;
          $n = (int) $n;
          $commission = [
            "actual_marchand"   => 180 * config('custom.points.coefficient'),
            "super_marchand"    => 65 * config('custom.points.coefficient'),
            "direction"         => 80 * config('custom.points.coefficient'),
            "nsia"              => 675 * config('custom.points.coefficient'),
          ];
          $this->payerPrime($n, $contrat->souscriptions->last(), $commission);
        }

        $reste = ((12 - $contrat->souscriptions->last()->primes->count()) * 1000) - ((int) $request->prime);

        if ($reste == 0) {
          $contrat->souscriptions->last()->update(['statut' => "Terminé"]);
          $statut = StatutSouscription::whereLabel('Terminé')->get();
          $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => Auth::id(), 'motif' => "Primes totalement payées"]);
          toastr()->success('Prime enregistrée avec succès.', 'Succès');
        }

        $this->sendSMS($contrat->client->users->first()->shortFullName . ', votre payement de ' . $request->prime . 'F est recu pour le contrat ' . $contrat->reference . '. Reste a payer ' . $reste . '. GMMS et NSIA vous remercient.', $contrat->client->users->first());
        toastr()->success('Prime enregistrée avec succès.', 'Succès');
        toastr()->success('Commissions transférées avec succès.', 'Succès');
        Session::flash('success', 'Prime enregistrée avec succès.');
        Session::flash('success', 'Commissions transférées avec succès.');
        return redirect()->route('primes.create');
      } else {
        toastr()->error('Paiement non effectué', 'Erreur');
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
  public function store_correction_maintenance()
  {

    $liste_contrats = [
      ["ref" => '46L6N171844', "montant" => 1000],
      ["ref" => '48L541N6790', "montant" => 1000],
      ["ref" => '48L323N5283', "montant" => 1000],
      ["ref" => '48L489N264226', "montant" => 1000],
    ];

    foreach ($liste_contrats as $key => $c) {

      $reference = $c["ref"];
      $prime = $c["montant"];
      $error = False;
      $reste = 0;
      $contrat = Contrat::where('reference', '=', $reference)->first();


      if ($contrat) {
        // si le statut du contrat est dans la liste suivante (pas bon)
        if (in_array($contrat->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Terminé'], true)) {
          dump('Vous ne pouvez pas enregistrer de primes sur ce contrat.', 'Erreur');
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
        dd('des erreurs');
        exit();
      } // breakIfErrors



      if ($contrat) {
        $payingUser = $contrat->client->users->first();
        $paiement = true;
        #dd($reference, $contrat, $prime);
        if ($paiement) {
          if ($contrat->souscriptions->last()->primes->count() == 0) {
            if ($prime == 1000) {
              $n = 1;
              $commission = [
                "actual_marchand"   => 200 * config('custom.points.coefficient'),
                "super_marchand"    => 100 * config('custom.points.coefficient'),
                "direction"         => 25 * config('custom.points.coefficient'),
                "nsia"              => 675 * config('custom.points.coefficient'),
              ];
              $this->payerPrime($n, $contrat->souscriptions->last(), $commission);
            } elseif ($prime > 1000) {
              $n = 1;
              $commission = [
                "actual_marchand"   => 200 * config('custom.points.coefficient'),
                "super_marchand"    => 100 * config('custom.points.coefficient'),
                "direction"         => 25 * config('custom.points.coefficient'),
                "nsia"              => 675 * config('custom.points.coefficient'),
              ];
              $this->payerPrime($n, $contrat->souscriptions->last(), $commission);

              $prime = $prime - 1000;
              $n = $prime / 1000;
              $n = (int) $n;

              $commission = [
                "actual_marchand"   => 180 * config('custom.points.coefficient'),
                "super_marchand"    => 65 * config('custom.points.coefficient'),
                "direction"         => 80 * config('custom.points.coefficient'),
                "nsia"              => 675 * config('custom.points.coefficient'),
              ];
              $this->payerPrime($n, $contrat->souscriptions->last(), $commission);
            }
          } elseif ($contrat->souscriptions->last()->primes->count() > 0) {
            $n = $prime / 1000;
            $n = (int) $n;
            $commission = [
              "actual_marchand"   => 180 * config('custom.points.coefficient'),
              "super_marchand"    => 65 * config('custom.points.coefficient'),
              "direction"         => 80 * config('custom.points.coefficient'),
              "nsia"              => 675 * config('custom.points.coefficient'),
            ];
            $this->payerPrime($n, $contrat->souscriptions->last(), $commission);
          }

          $reste = ((12 - $contrat->souscriptions->last()->primes->count()) * 1000) - ((int) $prime);

          if ($reste == 0) {
            $contrat->souscriptions->last()->update(['statut' => "Terminé"]);
            $statut = StatutSouscription::whereLabel('Terminé')->get();
            $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => Auth::id(), 'motif' => "Primes totalement payées"]);
            dump('Prime enregistrée avec succès.', 'Succès');
          }

          #$this->sendSMS($contrat->client->users->first()->shortFullName.', votre payement de '.$prime.'F est recu pour le contrat '.$contrat->reference.'. Reste a payer '.$reste. '. GMMS et NSIA vous remercient.' , $contrat->client->users->first());
          dump('Prime enregistrée avec succès.', 'Succès');
          dump('Commissions transférées avec succès.', 'Succès');
          Session::flash('success', 'Prime enregistrée avec succès.');
          Session::flash('success', 'Commissions transférées avec succès.');
        } else {
          dump('Paiement non effectué', 'Erreur');
        }
      } else {
        dump('Veuillez entrer un contrat valide.', 'Erreur');
      }
    }
    dd('end loop');



    dd('fini');
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
