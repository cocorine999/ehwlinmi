<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Direction;
use App\Models\Itadmin;
use App\Models\Nsia;
use App\Models\SuperMarchand;
use App\Models\Marchand;
use App\Models\Contrat;
use Faker\Factory as Faker;

class CorrectionMaintenanceController extends Controller
{

    public function reorganisation_contrats()
    {
        $contrats = ['references'];
        foreach ($contrats as $c) {
            $c = Contrat::where('reference', $c)->first();
            dump($c->reference);
        }
        return "terminé";
    }

    public function correction_adhesion()
    {

        // $user_marchand= User::where('telephone', '95606058' )->first();
        // if($user_marchand){
        //     $contrat = Contrat::where('reference', '26A110N1873')->first();
        //     if($contrat){
        //         $contrat->souscriptions->last()->update(['statut' => "Attente de traitement"]);
        //         $statut = StatutSouscription::whereLabel('Attente de traitement')->get();
        //         $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $user_marchand->id, 'motif' => "Paiement éffectué"]);

        //         toastr()->success('Contrat payé avec succès.', 'success');
        //         Session::flash('success', 'Contrat payé avec succès.');

        //         if ($contrat->q1 == 0 && $contrat->q2 == 0 && $contrat->q3 == 0 && $contrat->q4 == 0 && $contrat->q5 == 1) {

        //             $contrat->souscriptions->last()->update(['statut' => "Valide", 'date_effet' => Carbon::now()->format('Y-m-d')]);
        //             $statut = StatutSouscription::whereLabel('Valide')->get();
        //             $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $user_marchand->id, 'motif' => "Validation automatique"]);
        //             toastr()->success('Contrat valide avec succès.', 'success');
        //         }

        //         $direction = User::role(config('custom.roles.direction'))->first();
        //         $direction->getWallet('principal')->deposit(1000  * config('custom.points.coefficient'));

        //         $momo = MobileMoney::where('transref', '=', '1583593130EHWHLINMIA')->first();
        //         $momo->update([
        //             'response_msg'  => "Validation manuelle (voir tableau QUOS pour justification)",
        //         ]);
        //         return 'cool';
        //     }
        // }

        // return 'ok';
    }

    public function payer_adhesion()
    {

        // $user_marchand= User::where('telephone', '95606058' )->first();
        // if($user_marchand){
        //     $contrat = Contrat::where('reference', '26A110N1873')->first();
        //     if($contrat){
        //         $contrat->souscriptions->last()->update(['statut' => "Attente de traitement"]);
        //         $statut = StatutSouscription::whereLabel('Attente de traitement')->get();
        //         $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $user_marchand->id, 'motif' => "Paiement éffectué"]);

        //         toastr()->success('Contrat payé avec succès.', 'success');
        //         Session::flash('success', 'Contrat payé avec succès.');

        //         if ($contrat->q1 == 0 && $contrat->q2 == 0 && $contrat->q3 == 0 && $contrat->q4 == 0 && $contrat->q5 == 1) {

        //             $contrat->souscriptions->last()->update(['statut' => "Valide", 'date_effet' => Carbon::now()->format('Y-m-d')]);
        //             $statut = StatutSouscription::whereLabel('Valide')->get();
        //             $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $user_marchand->id, 'motif' => "Validation automatique"]);
        //             toastr()->success('Contrat valide avec succès.', 'success');
        //         }

        //         $direction = User::role(config('custom.roles.direction'))->first();
        //         $direction->getWallet('principal')->deposit(1000  * config('custom.points.coefficient'));

        //         $momo = MobileMoney::where('transref', '=', '1583593130EHWHLINMIA')->first();
        //         $momo->update([
        //             'response_msg'  => "Validation manuelle (voir tableau QUOS pour justification)",
        //         ]);
        //         return 'cool';
        //     }
        // }

        // return 'ok';
    }
}
