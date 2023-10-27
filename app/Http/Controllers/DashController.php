<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Models\Solde;
use App\Models\Client;
use App\Models\Primes;
use App\Models\Commune;
use App\Models\Contrat;
use App\Models\Marchand;
use App\Models\Prospect;
use App\Models\Departement;
use App\Models\Souscription;
use Illuminate\Http\Request;
use App\Models\SuperMarchand;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        #dd(config('prices.'.config('app.env').'.prime'));

        $userconnecterId = Auth::id();
        $contrats = "";
        $users = User::all()->count();

        $clients = User::role(config('custom.roles.client'))->get()->count();

        $assures = User::role(config('custom.roles.assure'))->get()->count();

        $beneficiaires = User::role(config('custom.roles.beneficiaire'))->get()->count();

        $departements = Departement::all()->count();
        $contratsAttente = Contrat::all()->load('souscriptions')->where('statut',"Attente de traitement")->count();
        $contratsPaiement = Contrat::all()->load('souscriptions')->where('statut',"Attente de paiement")->count();
        $contratsValide = Contrat::all()->load('souscriptions')->where('statut',"Valide")->count();
        $contratsRejete =  Contrat::all()->load('souscriptions')->where('statut',"Rejeté")->count();
        $contratsSinistre =  Contrat::all()->load('souscriptions')->where('statut',"Sinistre")->count();
        $contratsTermine =  Contrat::all()->load('souscriptions')->where('statut',"Terminé")->count();
        $soldescommission = "";
        $soldesprincipal = "";
        $marchandSuperMarchand = "";

        $commissions_sm = User::role(config('custom.roles.smarchand'))->get()->map(function ($item, $key) {
            return $item->getWallet('commission')->balance;
        });
        $commissions_sm = array_sum($commissions_sm->all()) / config('custom.points.coefficient');

        $commissions_m = User::role(config('custom.roles.marchand'))->get()->map(function ($item, $key) {
            return 200000;//$item->getWallet('commission')->balance;
        });
        $commissions_m = array_sum($commissions_m->all()) / config('custom.points.coefficient');

        if (Auth::user()->hasRole(config('custom.roles.smarchand'))){


          #$mesMarchands = Marchand::where('super_marchand_id',$userconnecterId)->get()->count();
          #$mesMarchands = Marchand::where('super_marchand_id',$userconnecterId)->get()->count();
          $mesMarchands = Auth::user()->super_marchand->first()->marchands;
          if($mesMarchands->count() == 0){

            $contratsAttente= 0;
            $contratsValide= 0;
            $contratsPaiement= 0;
            $contratsRejete= 0;
            $contratsSinistre= 0;
            $contratsTermine= 0;
          }
          else{

            $contratsAttente= 0;
            $contratsValide= 0;
            $contratsPaiement= 0;
            $contratsRejete= 0;
            $contratsSinistre= 0;
            $contratsTermine= 0;

              foreach ($mesMarchands as $m) {
                  $contratsPaiement += $m->actual_contrats->load('souscriptions')->where('statut',"Attente de paiement")->count();
                  $contratsAttente += $m->actual_contrats->load('souscriptions')->where('statut',"Attente de traitement")->count();
                  $contratsValide += $m->actual_contrats->load('souscriptions')->where('statut',"Valide")->count();
                  $contratsRejete += $m->actual_contrats->load('souscriptions')->where('statut',"Rejete")->count();
                  $contratsSinistre += $m->actual_contrats->load('souscriptions')->where('statut',"Sinistre")->count();
                  $contratsTermine += $m->actual_contrats->load('souscriptions')->where('statut',"Terminé")->count();
                     //  dd($contratsPaiement);
              }
          }
              if (Auth::user()->getWallet('principal') != null)
                {
                  $soldesprincipal = Auth::user()->getWallet('principal')->balance / config('custom.points.coefficient');
                }
                else{
                  $soldescommissions = Auth::user()->getWallet('commission')->balance /10;
                }

            $marchandSuperMarchand = Auth::user()->super_marchand->first()->marchands->count();
           // dd($marchandSuperMarchand);
        }
        if (Auth::user()->hasRole(config('custom.roles.marchand'))){

              $contratsPaiement= Auth::user()->marchand->first()->actual_contrats->load('souscriptions')->where('statut',"Attente de paiement")->count();
              $contratsAttente= Auth::user()->marchand->first()->actual_contrats->load('souscriptions')->where('statut',"Attente de traitement")->count();
              $contratsValide= Auth::user()->marchand->first()->actual_contrats->load('souscriptions')->where('statut',"Valide")->count();
              $contratsRejete= Auth::user()->marchand->first()->actual_contrats->load('souscriptions')->where('statut',"Rejete")->count();
              $contratsSinistre= Auth::user()->marchand->first()->actual_contrats->load('souscriptions')->where('statut',"Sinistre")->count();
              $contratsTermine= Auth::user()->marchand->first()->actual_contrats->load('souscriptions')->where('statut',"Terminé")->count();

              if (Auth::user()->getWallet('principal') != null)
                {
                $soldesprincipal = Auth::user()->getWallet('principal')->balance / config('custom.points.coefficient');
                }
                else{
                  $soldescommission = Auth::user()->getWallet('commission')->balance / config('custom.points.coefficient');
                }
               // dd($contratsPaiement);
        }
        if (Auth::user()->hasRole(config('custom.roles.client'))){

          $contratsPaiement= Auth::user()->client->first()->contrats->load('souscriptions')->where('statut',"Attente de paiement")->count();
          $contratsAttente= Auth::user()->client->first()->contrats->load('souscriptions')->where('statut',"Attente de traitement")->count();
          $contratsValide= Auth::user()->client->first()->contrats->load('souscriptions')->where('statut',"Valide")->count();
          $contratsRejete= Auth::user()->client->first()->contrats->load('souscriptions')->where('statut',"Rejete")->count();
          $contratsSinistre= Auth::user()->client->first()->contrats->load('souscriptions')->where('statut',"Sinistre")->count();
          $contratsTermine= Auth::user()->client->first()->contrats->load('souscriptions')->where('statut',"Terminé")->count();

              /* if (Auth::user()->getWallet('principal') != null)
                {
                $soldesprincipal = Auth::user()->getWallet('principal')->balance / config('custom.points.coefficient');
                }
                else{
                  $soldescommission = Auth::user()->getWallet('commission')->balance / config('custom.points.coefficient');
                } */

            //$marchandSuperMarchand = Auth::user()->super_marchand->first()->marchands->count();
            //dd($marchandSuperMarchand);
        }


        $commune = Commune::all()->count();

        $nsia = User::role(config('custom.roles.nsia'))->get()->count();

        $directions = User::role(config('custom.roles.direction'))->get()->count();

        $prospects = Prospect::all()->count();

        $supermarchands = User::role(config('custom.roles.smarchand'))->get()->count();

        $soldes = Solde::all()->count();

        $marchands = User::role(config('custom.roles.marchand'))->get()->count();

        $primes = Primes::all()->count();


        //dd(User::role(config('custom.roles.smarchand'))->first()->id);
        $userconnecterCommune = User::where('id',$userconnecterId)->pluck('commune_id')->toArray();

        $userconnecterdeparteId = Commune::whereIn('id',$userconnecterCommune)->pluck('departement_id')->toArray();

        $userconnecterClientId = User::role(config('custom.roles.client'))->where('id',$userconnecterId)->pluck('id')->toArray();

        $userconnecterAssureId = User::role(config('custom.roles.client'))->where('id',$userconnecterId)->pluck('id')->toArray();


        $usersconnect = User::where('id',$userconnecterId)->get()->count();

        $clientsconnect = User::role(config('custom.roles.client'))->where('id',$userconnecterId)->get()->count();

        $assuresconnect = User::role(config('custom.roles.assure'))->where('id',$userconnecterId)->get()->count();

        $beneficiairesconnect = User::role(config('custom.roles.beneficiaire'))->where('id',$userconnecterId)->get()->count();

        $departementsconnect = Departement::whereIn('id',$userconnecterdeparteId)->count();


        $contratsconnect = Contrat::whereIn('client_id',$userconnecterClientId)
                                  ->whereIn('assure_id',$userconnecterAssureId)
                                  ->count();

        $communeconnect = Commune::whereIn('id',$userconnecterCommune)->count();

        $nsiaconnect = User::role(config('custom.roles.nsia'))->where('id',$userconnecterId)->get()->count();

        $directionsconnect = User::role(config('custom.roles.direction'))->where('id',$userconnecterId)->get()->count();

        $prospectsconnect = Prospect::all()->count();

        $supermarchandsconnect = User::role(config('custom.roles.smarchand'))->where('id',$userconnecterId)->where('id',$userconnecterId)->get()->count();

        $soldesconnect = 0;
        if (Auth::user()->getWallet('principal') != null) {

            $soldesconnect = Auth::user()->getWallet('principal')->balance / config('custom.points.coefficient');
      }

        $marchandsconnect = User::role(config('custom.roles.marchand'))->where('id',$userconnecterId)->get()->count();

        $primesconnect = Primes::all()->count();

        return view('dash.index',compact(['commissions_m', 'commissions_sm', 'users','directions', 'supermarchands', 'marchands', 'clients', 'assures', 'beneficiaires', 'nsia',
                                          'prospects','soldes','primes','contrats','commune','departements','soldesprincipal','soldescommission','marchandSuperMarchand',
                                          'usersconnect','directionsconnect', 'supermarchandsconnect', 'marchandsconnect', 'clientsconnect', 'assuresconnect', 'beneficiairesconnect', 'nsiaconnect',
                                          'prospectsconnect','soldesconnect','primesconnect','contratsconnect','communeconnect','departementsconnect',
                                          'contratsTermine','contratsAttente','contratsValide','contratsRejete','contratsSinistre','contratsPaiement']));
    }
}
