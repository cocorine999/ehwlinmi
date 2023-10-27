<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use App\Models\Contrat;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelEtatProduction;
use App\Mail\EtatProdcutionFileMail;

use Mail;


class PrepareEtatProductionFile implements ShouldQueue
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
        $contrat = Contrat::all();
        $data = [];
        if($contrat){
            foreach ($contrat as $key => $c) {
                $selection = '';
                if ($c->q1 == 1) { $selection .= "  1   "; }
                if ($c->q2 == 1) { $selection .= "  2   "; }
                if ($c->q3 == 1) { $selection .= "  3   "; }
                if ($c->q4 == 1) { $selection .= "  4   "; }
                if ($c->q5 == 1) { $selection .= "  5   "; }
                array_push($data, [
                    "N°" => $key,
                    "Date d'adhésion" => $c->date_effet,
                    "Code du produit" => $c->reference,
                    "Code de l'agent" => $c->marchands->last()->reference,
                    "Nom et prénom de l'adhérent" => $c->client->users->first()->full_name,
                    "Profession de l'adhérent" => $c->client->users->first()->profession,
                    "Numéro de téléphone de l'adhérent" => $c->client->users->first()->telephone,
                    "Nom et prénom de l'assuré" => $c->assure->users->first()->full_name,
                    "Marchand " => $c->marchands->last()->users->first()->full_name,
                    "Statut" => $c->statut,
                    "Primes Payées" => $c->primes->count(),
                    "Réponses au questionnaire médical" => $selection,
                ]);
            }
            $filename = 'etatproduction'.time().'.xlsx';
            $path = Excel::store(new ExcelEtatProduction($data), $filename);
            #dump($data, $filename, $path);

            $data['to'] = ['abiguelle83@gmail.com'];
            $data['cc'] = ['jospygoudalo@gmail.com', 'wmaditoma@gmail.com'];
            Mail::to($data['to'])->cc($data['cc'])->send(new EtatProdcutionFileMail($filename));
        }
    }
}
