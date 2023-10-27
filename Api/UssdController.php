<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class UssdController extends BaseController
{

    public function check_key($value){
        if($value == 'ULfcpHjqHOzBf89B'){
            return true;
        }else{
            return false;
        }
    }

    // récupérer la liste des contrats d'un client 
    public function liste_contrats(Request $request){
        $check = $this->check_key($request->key);
        if(!$check){
            return response()->json(['message' => 'INCORRECT_KEY'], 401);
        }

        $contrats = [];
        $telephone = $request->telephone;
        $user = User::where('telephone','=',$telephone)->first();
        if ($user) {
            $client = $user->client->first();
            if($user->hasAnyRole([config('custom.roles.direction'), config('custom.roles.marchand'), config('custom.roles.smarchand'), config('custom.roles.direction')])){
                $user = False ;
            }
            elseif($client){
                foreach($client->contrats as $c){
                    if(!in_array($c->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Terminé'], true)){
                        array_push($contrats, [
                        "reference"=>$c->reference,
                        "assure" => $c->assure->users->first()->shortFullName,
                        "primes"=> 12 - $c->primes->count()
                        ]);
                    }
                }
            }
        }else{
            $user= false;
        }
        return response()->json(['contrats' => $contrats], 200);
    }

    // enregistrer la transaction effectuée par un client
    public function post_paiement(Request $request){
        $check = $this->check_key($request->key);
        if(!$check){
            return response()->json(['message' => 'INCORRECT_KEY'], 401);
        }

        $data = [
            [
                'other1'    => '',
                'other2'    => \serialize($request->all()),
                'response'     => \serialize($request->all()),
            ],
        ];
        DB::transaction(function () use ($data) {
            DB::table('tempp')->insert($data);
        });
        return response()->json(['request' => "SUCCESS"], 200);
    }
    
    // identifier le client
    public function check_user(Request $request){
        $check = $this->check_key($request->key);
        if(!$check){
            return response()->json(['message' => 'INCORRECT_KEY'], 401);
        }

        $telephone = $request->telephone;
        $user = User::where('telephone','=',$telephone)->first();
        if ($user) {
            if($user->hasAnyRole([config('custom.roles.working_users_cs')])){
              $user = false;
            }else{
                $user= true;
            }
        }else{
            $user= false;
        }
        
        return response()->json(['user' => $user], 200);
    }



}
