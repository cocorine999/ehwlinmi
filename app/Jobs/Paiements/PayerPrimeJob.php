<?php

namespace App\Jobs\Paiements;

use App\Models\Primes;
use App\Models\StatutSouscription;
use App\User;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PayerPrimeJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


  protected $contrat;
  protected $prime;
  protected $auth_id;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($contrat, $prime, $auth_id)
  {
    $this->queue = 'paiements';
    $this->contrat = $contrat;
    $this->prime = $prime;
    $this->auth_id = $auth_id;
  }

  public function tags()
  {
    $final_primes = 1 + $this->contrat->souscriptions->last()->primes->count();
    return ['prime', $this->contrat->reference . "S" . $this->contrat->souscriptions->count() . "P" . $final_primes];
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $contrat = $this->contrat;
    $prime = $this->prime;
    $auth_id = $this->auth_id;
    $montant_payee = $this->prime;
    $commissions = null;

    if ($contrat->souscriptions->last()->primes->count() == 0) {
      if ($prime == 1000) {
        $n = 1;
        $commissions = [
          "actual_marchand"   => 200 * config('custom.points.coefficient'),
          "super_marchand"    => 100 * config('custom.points.coefficient'),
          "direction"         => 25 * config('custom.points.coefficient'),
          "nsia"              => 675 * config('custom.points.coefficient'),
        ];
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
