<?php

namespace App\Jobs\Paiements;

use App\Jobs\Paiements\PayerPrimeJob;
use App\Jobs\TestMailJob;
use App\Models\MobileMoney;
use App\Traits\MobilePaiement;
use App\Traits\ServicesValidationTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckPaiementStatusJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, MobilePaiement, ServicesValidationTrait;

  protected $transref;
  protected $reseau;
  protected $contrat;
  protected $action; // prime, adhesion, etc ...
  protected $auth_id;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($transref, $contrat, $auth_id, $action)
  {
    $this->queue = 'paiements';
    $this->transref = $transref;
    $this->contrat = $contrat;
    $this->action = $action;
    $this->auth_id = $auth_id;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $contrat = $this->contrat;
    $transref = $this->transref;
    $auth_id = $this->auth_id;
    $momo = MobileMoney::where('transref', $transref)->first();
    $actual_status_flag = $this->get_status($transref, $momo->operateur);
    if ($actual_status_flag == "SUCCESS") {
      switch ($this->action) {
        case 'prime':
          // Log::channel('horizon_log_channel')->info('Prime automatique'. $momo->amount .' à payer sur : '.$contrat->reference);
          # PayerPrimeJob::dispatchNow($contrat, $momo->amount, $auth_id);
          $this->process_paiement_prime($contrat, $momo->amount, $auth_id);

          $data = [
            'reference' => $contrat->reference,
            'type' => 'prime' . $momo->amount,
          ];
          Mail::send('email.newcorrection', $data, function ($m) use ($data) {
            $m->from(config('mail.from.address'), config('mail.from.name'))
              ->to('jospygoudalo@gmail.com')
              ->subject('Régularisation automatique. ' . $data['type'] . ' : ' . $data['reference']);
          });

          break;

        case 'souscription':
          // Log::channel('horizon_log_channel')->info('Souscription automatique à payer sur : '.$contrat->reference);
          # PayerSouscriptionJob::dispatchNow($contrat, $auth_id);
          $this->process_paiement_souscription($contrat, $auth_id);

          $data = [
            'reference' => $contrat->reference,
            'type' => 'souscription'
          ];
          Mail::send('email.newcorrection', $data, function ($m) use ($data) {

            $m->from(config('mail.from.address'), config('mail.from.name'))
              ->to('jospygoudalo@gmail.com')
              ->subject('Régularisation automatique. ' . $data['type'] . ' : ' . $data['reference']);
          });

          break;


        case 'renouvellement':
          // Log::channel('horizon_log_channel')->info('Souscription automatique à payer sur : '.$contrat->reference);
          # PayerSouscriptionJob::dispatchNow($contrat, $auth_id);
          $this->process_paiement_renouvellement($contrat, $auth_id);

          $data = [
            'reference' => $contrat->reference,
            'type' => 'renouvellement'
          ];
          Mail::send('email.newcorrection', $data, function ($m) use ($data) {

            $m->from(config('mail.from.address'), config('mail.from.name'))
              ->to('jospygoudalo@gmail.com')
              ->subject('Régularisation automatique. ' . $data['type'] . ' : ' . $data['reference']);
          });

          break;

        case 'test':
          # Log::channel('horizon_log_channel')->info('Test : 1F payé sur le contrat aléatoire: '.$contrat->reference);
          //TestMailJob::dispatchNow();

          $data = [
            'type' => 'test'
          ];
          Mail::send('email.newcorrection', $data, function ($m) use ($data) {

            $m->from(config('mail.from.address'), config('mail.from.name'))
              ->to('jospygoudalo@gmail.com')
              ->subject('Régularisation automatique. ' . $data['type']);
          });

          break;

        default:
          # noting to do for now
          break;
      }
    }
  }
}
