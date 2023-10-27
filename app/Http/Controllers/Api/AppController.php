<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SinistreResource;
use App\Http\Resources\UserContratResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserMarchandResource;
use App\Http\Resources\ProspectResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Marchand;
use App\Models\SuperMarchand;
use App\Models\Commune;
use App\Models\Prospect;
use App\Models\Contrat;
use App\Models\Sinistre;
use App\Models\StatutSouscription;
use App\User;

class AppController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function getUserContrats(Request $request){
      try {
	        //$user = $request->user();

          if($request->user()->hasRole(config('custom.roles.direction_all_cs')) == true){
              $contrats = UserContratResource::collection(Contrat::all()->load('souscriptions')->whereIn('statut',["Valide","Attente de paiement"])->sortByDesc('created_at')->take(50));
          }

          elseif($request->user()->hasRole("SuperMarchand") == true){
              $contrats = [];

              foreach ($request->user()->super_marchand->first()->actual_marchands as $marchand)
              {
                  foreach ($marchand->actual_contrats->whereIn('statut',["Valide","Sinistre","Attente de paiement"]) as $c)
                  {
                      array_push($contrats);
                  }
              }
              
              $contrats = UserContratResource::collection($contrats);

              //$contrats = $this->paginate(UserContratResource::collection($contrat),4)->setPath($request->url());

          }

          elseif($request->user()->hasRole("Marchand") == true){
            $contrats = UserContratResource::collection($request->user()->marchand->first()->actual_contrats->load('souscriptions')->whereIn('statut',["Valide","Attente de paiement"])->sortByDesc('created_at')->take(6));
          }

          elseif($request->user()->hasRole("Client") == true){
              $contrats = UserContratResource::collection($request->user()->client->first()->contrats->load('souscriptions')->whereIn('statut',["Valide","Sinistre","Attente de paiement","Terminé"])->sortByDesc('created_at'));
          }

          else{
              $contrats = ['data' => [] ] ;
          }

          return response()->json(['data' => $contrats ],Response::HTTP_OK);

      } catch (\Exception $e) {
          $message = $e->getMessage();
          return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }
    }

    public function getContratByReferenceOrPhone($request){

      try{

          $contrats = UserContratResource::collection(Contrat::reference($request));
          if($contrats->count() == 0){
          	
          	$user = User::where("telephone",$request)->first();
          	if($user){
		      if($user->hasRole("Client") ==true){
		          $contrats = UserContratResource::collection($user->client->first()->contrats->load('souscriptions')->where('statut','=','Valide')->sortByDesc('created_at'));
		      }
		}
          }

          return response()->json(['data' => $contrats],Response::HTTP_OK);
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json(['message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }

    public function getContratByReference(Request $request){

      try{

          $contrats = UserContratResource::collection(Contrat::reference($request->searchValue));

          return response()->json(['data' => $contrats],Response::HTTP_OK);
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json(['message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }

    public function getContratsByClientPhoneNumber($request){

      try{

          $contrats = [];
          $user = User::where("telephone",$request)->first();

          if($user){
              if($user->hasRole("Client") ==true){
                  $contrats = UserContratResource::collection($user->client->first()->contrats->load('souscriptions')->whereIn('statut',["Valide","Attente de paiement"])->sortByDesc('created_at'));
              }
          }
          return response()->json(['data' => $contrats],Response::HTTP_OK);
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json(['message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }



    public function getUserMarchands(Request $request){

      try{

            if($request->user()->hasRole(config('custom.roles.direction_all_cs')) == true){
                $marchands = UserMarchandResource::collection(Marchand::all()->load('users')->sortByDesc('created_at')->take(50));
            }

            elseif($request->user()->hasRole(config('custom.roles.smarchand')) == true){
                $marchands = UserMarchandResource::collection($request->user()->super_marchand->first()->actual_marchands->load("users")->sortByDesc('created_at'));
            }

            else{
              $marchands = [];
            }
            return response()->json(['data' => $marchands],Response::HTTP_OK);
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json(['message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }

    public function getMarchandByKey(Request $request){

      try{

            if($request->user()->hasRole(config('custom.roles.smarchand')) == true || $request->user()->hasRole(config('custom.roles.direction_all_cs')) == true){
              $marchands = UserMarchandResource::collection(Marchand::reference($request->searchValue));//->where("reference",$request->searchValue)->orWhere("user.nom",$request->searchValue));//,"user.nom"=>$request->searchValue,
            }
            else{
              $marchands = [];
            }
            return response()->json(['data' => $marchands],Response::HTTP_OK);
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json(['message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }

    public function getUserSinistres(Request $request){
      try {

          if($request->user()->hasRole(config('custom.roles.direction_all_cs')) == true){
            $sinistres =  SinistreResource::collection(Contrat::all()->load('souscriptions')->whereIn('statut',["Sinistre"])->load("sinistre")->sortByDesc('created_at'));
            //$sinistres = Sinistre::latest()->with('contrat')->get();
          }

          elseif($request->user()->hasRole("SuperMarchand") == true){
              $sinistres = [];
              foreach ($request->user()->super_marchand->first()->actual_marchands as $marchand){
                  foreach ($marchand->actual_contrats->where('statut', '=', 'Sinistre')->sortByDesc('created_at') as $c){
                          array_push($sinistres, new SinistreResource($c->load('sinistre')));
                  }
              }
          }

          elseif($request->user()->hasRole("Marchand") == true){
            $sinistres = SinistreResource::collection($request->user()->marchand->first()->actual_contrats->where('statut', '=', 'Sinistre')->load("sinistre")->sortByDesc('created_at'));
          }

          elseif($request->user()->hasRole("Client") == true){
              $sinistres = SinistreResource::collection($request->user()->client->first()->contrats->where('statut', '=', 'Sinistre')->load('sinistre')->sortByDesc('created_at'));
          }

          else{
              $sinistres = [];
          }

          return response()->json(['data' => $sinistres ],Response::HTTP_OK);

      } catch (\Exception $e) {
          $message = $e->getMessage();
          return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }
    }


    public function addSinistre(Request $request){

        $request->validate([
           'contrat.reference'        => 'required',
           'date_sinistre'        => 'required',
           'description'        => 'required',
        ]);


        try{

            $user = $request->user();
            if($user->hasRole("Client") == true){
                $contrat = Contrat::where('reference',$request["contrat"]["reference"])->first();
                if($contrat && $contrat->client_id==$user->client->first()->id) {
                    if($contrat->statut == "Attente de traitement"){
                        return response()->json(['message' => "Ce contrat est encore en attente de validation. Veuillez patienter"],Response::HTTP_UNPROCESSABLE_ENTITY);
                    }
                    elseif($contrat->statut == "Sinistre"){
                        return response()->json(['message' => "Un sinistre est déjà signalé sur ce contrat."],Response::HTTP_UNPROCESSABLE_ENTITY);
                    }
                    else{
                        $sinistre = new Sinistre();
                        $sinistre->client_id  = $user->client->first()->id;
                        $sinistre->date_sinistre  = $request->date_sinistre;
                        $sinistre->description    = $request->description;
                        $sinistre->contrat_id    = $contrat->id;
                        $sinistre->statut   = "Non traité";
                        $sinistre->save();

                        #$contrat = Contrat::where('reference',$contrat->id)->first();
                        $contrat->souscriptions->last()->update(['statut' =>'Sinistre']);
                        $statut = StatutSouscription::whereLabel('Sinistre')->get();
                        $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, [ 'user_id' => Auth::id(), 'motif'=> ""] );

                        return response()->json(['message' => "Nous vous prions de recevoir nos condoléances, les mesures seront enclenchées pour que les fonds vous soientt versés. Merci."],Response::HTTP_OK);
                    }
                }
                else{
                  return response()->json(['message' => "Ce contrat n\'existe pas. Veuillez bien verifier le numéro de police du contrat."],Response::HTTP_NOT_FOUND);
                }
            }
            else{
              return response()->json(['message' => "Vous n'avez pas le droit d'éffectuer cette operation."],Response::HTTP_UNAUTHORIZED);
            }
        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['message' => $message,],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function getUserProspects(Request $request){

      try{


          if($request->user()->hasRole(config('custom.roles.direction_all_cs')) == true){
              $prospects = ProspectResource::collection(Prospect::latest()->get());
          }

          elseif($request->user()->hasRole(config('custom.roles.smarchand')) == true){
              //$prospects = ProspectResource::collection($request->user()->super_marchand->first()->actual_marchands->load('prospects')->);

              $prospects = [];
              foreach ($request->user()->super_marchand->first()->actual_marchands as $marchand){
                  foreach ($marchand->prospects->sortByDesc('created_at') as $prospect){
                      array_push($prospects, new ProspectResource($prospect));
                  }
              }
          }

          elseif($request->user()->hasRole(config('custom.roles.marchand')) == true){

          	    $prospects = ProspectResource::collection($request->user()->marchand->first()->prospects->sortByDesc('created_at'));
          }

        else{
          $prospects = [];
        }

          return response()->json(['data' => $prospects],Response::HTTP_OK);
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }

    public function addProspect(Request $request){

        $request->validate([
            'nom'        => 'required',
            'prenom'     => 'required',
            'telephone'    => 'required|unique:users',
            'commune'    => 'required',
        ]);


        try{

            $prospect = Prospect::create([
                "nom"          => $request->nom,
                "prenom"       => $request->prenom,
                "telephone"    => $request->telephone,
                "description"  => $request->description,
                "commune_id"   => $request["commune"]["id"],
                "marchand_id"  => $request->user()->marchand->first()->id
            ]);
            return response()->json(['message' => "Prospect enregistré avec succes."],Response::HTTP_OK);
        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['message' => $message,],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function getCommunes(Request $request){
        try{
          return response()->json(['data' =>  Commune::all()],Response::HTTP_OK);
        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['message' => $message,],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getCounts(Request $request){

      try{

          if($request->user()->hasRole(config('custom.roles.direction_all_cs')) == true){
            return response()->json(['data' => [
              'nbre_prospects' => Prospect::all()->count(),
              'nbre_sinistres' => Sinistre::all()->count(),
              'nbre_contrats' => Contrat::all()->count(),
              'nbre_supermarchands' => SuperMarchand::all()->count(),
              'nbre_marchands' => Marchand::all()->count(),
            ] ],Response::HTTP_OK);
          }

          elseif($request->user()->hasRole(config('custom.roles.marchand')) == true){
            return response()->json(['data' => [
              'nbre_prospects' => $request->user()->marchand->first()->prospects->count(),
              'nbre_contrats' => $request->user()->marchand->first()->contrats->load('souscriptions')->whereIn('statut',["Valide","Attente de paiement"])->count(),
            ]

            ],Response::HTTP_OK);
          }

          else{
            return response()->json( ['data' =>[]],Response::HTTP_OK);
          }
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json(['message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }

    public function getAllSuperMarchands(Request $request){

        try{

            if($request->user()->hasRole(config('custom.roles.direction_all_cs')) == true){
                $smarchands = SuperMarchand::latest()->with(["users"])->get();
            }

            else{
                $smarchands = [];
            }
            return response()->json(['data' =>UserMarchandResource::collection($smarchands) ],Response::HTTP_OK);
        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    public function paginate($items, $perPage = 5, $page = null, $options = []) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function getContratsValide(Request $request){
      try {
        return UserContratResource::collection(Contrat::all()->load('souscriptions')->whereIn('statut',["Valide",])->take(20));

      } catch (\Exception $e) {
          $message = $e->getMessage();
          return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }
    }
}
