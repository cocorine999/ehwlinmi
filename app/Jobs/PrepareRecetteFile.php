<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Primes;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelRecettes;
use App\Mail\RecetteFileMail;

use Mail;

class PrepareRecetteFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $timeout = 600;

    protected $data;
        
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $primes = Primes::all();
        $data = [];
        if($primes){
            foreach ($primes as $key => $p) {
                array_push($data, [
                    'DATE ADHESION'  => $p->souscription->contrat->date_effet,
                    'DATE DE PAIEMENT'  => $p->created_at,
                    'NUMERO DE POLICE'  => $p->souscription->contrat->reference,
                    'IDENTIFIANT SOUSCRIPTEUR'  => $p->souscription->contrat->client->users->first()->id,
                    'NOM & PRENOMS SOUSCRIPTEUR'  => $p->souscription->contrat->client->users->first()->full_name,
                    'TELEPHONE' => $p->souscription->contrat->client->users->first()->telephone,
                    'NOM & PRENOMS ASSURE'  => $p->souscription->contrat->assure->users->first()->full_name,
                    'MONTANT PAYE'  => $p->montant,
                    'QUOTE PART NSIA' => ((int) $p->c_nsia) / 10,
                    'COMMISSION MMS'  => ((int) $p->c_mms) / 10,
                    'COMMISSION SM' => ((int) $p->c_smarchand) / 10,
                    'COMMISSION MARCHAND' => ((int) $p->c_marchand) / 10,
                ]);
            }
            $filename = 'recettes'.time().'.xlsx';
            $path = Excel::store(new ExcelRecettes($data), $filename);
            #dump($data, $filename, $path);

            $data['to'] = ['adeleyeclarisse95@gmail.com'];
            $data['cc'] = ['baldynah@yahoo.fr', 'jospygoudalo@gmail.com', 'wmaditoma@gmail.com'];
            Mail::to($data['to'])->cc($data['cc'])->send(new RecetteFileMail($filename));
        }
    }
}
