<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Assure;
use App\Models\Beneficiaire;
use App\Models\Souscription;
use App\Models\Contrat;
use App\Models\Fichier;
use Illuminate\Http\Request;
use App\Models\StatutSouscription;
use App\Models\Versement;
use Illuminate\Support\Facades\Mail;

class VersementController extends Controller
{
    public function index()
    {
      $versements = Versement::all();
      return view('dash.versements.index', compact(['versements']));
    }


    public function users_commissions()
    {
        #$users = User::all();
        $nsia = User::role(config('custom.roles.nsia'))->first();
        $direction = User::role(config('custom.roles.direction'))->first();
        $users = User::role([config('custom.roles.smarchand'), config('custom.roles.marchand')])->get();

        // $supermarchands = User::role(config('custom.roles.smarchand'))->get();
        // $marchands = User::role(config('custom.roles.marchand'))->get();

        // $total_marchands = $marchands->sum(function ($marchand) {
        //     return $marchand->getWallet('commission')->balance;
        // });
        // $total_smarchands = $supermarchands->sum(function ($smarchand) {
        //     return $smarchand->getWallet('commission')->balance;
        // });

        #dd($supermarchands, $marchands, $users);

        // foreach($users as $u){
        //     if($u->getWallet('commission')){
        //         #dump($u->assure->users->first()->full_name);
        //         #sleep(1);
        //     }else{
        //         echo $u->id;
        //         dump($u);
        //         dd('finin');
        //     }
        // }

        // $marchands_total = User::role(config('custom.roles.marchand'))->map(function ($item, $key) {
        //     return $item->taux;
        // });

        #dd($nsia->getWallet('commission')->balance, $direction->getWallet('commission')->balance, $supermarchands, $marchands);

        $mois = Carbon::now();
        return view('dash.versements.users_commissions', compact(['users', 'direction', 'nsia', 'mois']));
    }


    public function create()
    {
        return view('dash.versements.create');
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        if($user) {
          if($user->recevoir_commission) {
            if($user->getWallet('commission')){
              if($user->getWallet('commission')->balance <= $request->montant) {
                $versement = Versement::create([
                    'user_id' => $user->id,
                    'montant' => $request->montant,
                    'motif' => $request->motif,
                    'created_by' => Auth::id(),
                ]);

                // send an email to the one who need to validate it

                Session::flash('sucess', 'Versement crée avec succes.');
              } else{
                  Session::flash('error', 'Ce utilisateur ne dispose pas d\'assez de fond.');
              }
            }
          } else{
              Session::flash('error', 'L\'utilisateur n\'a pas activé la reception de commission.');
          }
        } else{
            Session::flash('error', 'Nous ne retrouvons pas cet utilisateur.');
        }

        return redirect()->route('versements.create');
    }


    public function show(Versement $versement)
    {
        //
    }


    public function edit(Versement $versement)
    {
        //
    }


    public function update(Request $request, Versement $versement)
    {
        //
    }

    public function destroy(Versement $versement)
    {
        if(!$versement->validated_by) {
            $versement->delete();
            Session::flash('sucess', 'Versement supprimé.');
        }
        return redirect()->route('versements.index');
    }
}
