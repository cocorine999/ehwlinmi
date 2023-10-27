<?php

namespace App\Jobs\Paiements;

use App\Models\StatutSouscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PayerSouscriptionJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $contrat;
  protected $auth_id;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($contrat, $auth_id)
  {
    $this->queue = 'paiements';
    $this->contrat = $contrat;
    $this->auth_id = $auth_id;
  }

  public function tags()
  {
    return ['souscription', $this->contrat->reference . "S" . $this->contrat->souscriptions->count()];
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $contrat = $this->contrat;
    $auth_id = $this->auth_id;

    if ($contrat->souscriptions->last()->statut === "Attente de paiement") {
      $contrat->souscriptions->last()->update(['statut' => "Attente de traitement"]);
      $statut = StatutSouscription::whereLabel('Attente de traitement')->get();
      $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Paiement adhésion éffectué"]);

      if ($contrat->q1 == 0 && $contrat->q2 == 0 && $contrat->q3 == 0 && $contrat->q4 == 0 && $contrat->q5 == 1) {
        $contrat->souscriptions->last()->update(['statut' => "Valide", 'date_effet' => Carbon::now()->format('Y-m-d')]);
        $statut = StatutSouscription::whereLabel('Valide')->get();
        $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Validation automatique"]);
      }

      $direction = User::role(config('custom.roles.direction'))->first();
      $direction->getWallet('principal')->deposit(1000  * config('custom.points.coefficient'));
    } else {
      PayerPrimeJob::dispatch($contrat, 1000, $auth_id);
    }
  }
}
