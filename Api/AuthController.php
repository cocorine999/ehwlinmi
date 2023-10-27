<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;

use App\Jobs\Paiements\CheckPaiementStatusJob;
use App\Jobs\Paiements\PayerPrimeJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\SinistreResource;
use App\Http\Resources\UserContratResource;
use App\Http\Resources\UserMarchandResource;
use App\Http\Resources\ProfilResource;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use App\Models\Prospect;
use App\Models\Sinistre;
use App\Models\Contrat;
use App\Models\Marchand;
use App\Models\MobileMoney;
use App\Models\Primes;
use App\Models\Client;
use App\Models\SuperMarchand;
use App\Models\StatutSouscription;
use App\Models\Commune;
use App\Traits\MobilePaiement;
use App\Traits\ServicesValidationTrait;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Database\Eloquent\Builder;
class AuthController extends Controller
{
  use MobilePaiement, ServicesValidationTrait;
    //

    public function logIn(Request $request){

        request()->validate([
            'identifiant' => 'required',
            'password' => 'required',
        ]);

        $credentials = ['telephone' => $request["identifiant"], 'password' => $request["password"]];
        if (Auth::attempt($credentials)) {

          return response()->json([
              'data' => [
                  'profil' => new UserResource(request()->user())
                  'role' => Auth::user()->roles[0]->name,
                  'access_token' => auth()->user()->createToken("Laravel")->accessToken,
              ]

          ],Response::HTTP_OK);
        }

        else{
		return response()->json([
			    'message' => "Echec d'authentification",
			    'errors' => [
				 'message' => ["Identifiant incorrect"],
			    ]
		       ],Response::HTTP_UNPROCESSABLE_ENTITY);

        }
    }

  public function paiementPrime(Request $request)
  {
    $request->validate(['prime' => 'required']);
    $prime = $request->prime;
    $error = False;
    $reste = 0;

    if ($prime > 12000) { // si le montant supérieur a 12000f
      return response()->json(['message' => "Le total des primes ne peut etre supérieur à 12000.",],Response::HTTP_INTERNAL_SERVER_ERROR);
      toastr()->warning('Le total des primes ne peut etre supérieur à 12000.', 'Erreur');
      $error = True;
    }
    if ($prime % 1000 != 0) { //si le montant n'est pas multiple de 1000
      $monnaie = $prime % 1000;
      $proposition = $prime - $monnaie;
      return response()->json(['message' => 'Veuillez enregistrer un multiple de 1000. Proposition: ' . $proposition . ' ou ' . ($proposition + 1000),],Response::HTTP_INTERNAL_SERVER_ERROR);
      toastr()->warning('Veuillez enregistrer un multiple de 1000. Proposition: ' . $proposition . ' ou ' . ($proposition + 1000), 'Erreur');
      $error = True;
    }

    // recuperer le contrat
    $reference = $request->reference;
    $contrat = Contrat::where('reference', '=', $reference)->first();

    if ($contrat) {
      // si le statut du contrat est dans la liste suivante (pas bon)
      if (in_array($contrat->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Terminé'], true)) {
        return response()->json(['message' => "Vous ne pouvez pas enregistrer de primes sur ce contrat.",],Response::HTTP_INTERNAL_SERVER_ERROR);
        toastr()->warning('Vous ne pouvez pas enregistrer de primes sur ce contrat.', 'Erreur');
        $error = True;
      } else { // si le statut est bon
        if ($contrat->souscriptions->last()->primes->count() > 0) { // et que le contrat dispose deja de primes
          // calcul du reste ici
          $reste = (12 - $contrat->souscriptions->last()->primes->count()) * 1000; // primes restantes
          if ($reste == 0) {
            return response()->json(['message' => "Ce client est déja à jour pour ce contrat.",],Response::HTTP_INTERNAL_SERVER_ERROR);
            toastr()->warning('Ce client est déja à jour pour ce contrat.', 'Erreur');
            $error = True;
          } else {
            if ($prime > $reste) {
              return response()->json(['message' => "Ce client doit payer: ' . $reste . ' F. La prime fournie ne peut être supérieure à ce montant.",],Response::HTTP_INTERNAL_SERVER_ERROR);
              toastr()->warning('Ce client doit payer: ' . $reste . ' F. La prime fournie ne peut être supérieure à ce montant.', 'Erreur');
              $error = True;
            }
          }
        }
      }
    } else {
      return response()->json(['message' => "Veuillez entrer un contrat valide.",],Response::HTTP_INTERNAL_SERVER_ERROR);
      toastr()->warning('Veuillez entrer un contrat valide.', 'Erreur');
      $error = True;
    }

    if ($error) {
      return response()->json(['message' => "Erreur",],Response::HTTP_INTERNAL_SERVER_ERROR);
      return redirect()->route('primes.create');
      exit();
    } // breakIfErrors

    if ($contrat) {
      $auth_id = Auth::id();
      $payingUser = $contrat->client->users->first();
      $final_primes = 1 + $contrat->souscriptions->last()->primes->count();
      $paiement = $this->pay($payingUser, $prime, $request->paiementChoice, $contrat->reference . "S" . $contrat->souscriptions->count() . "P" . $final_primes);
      # $paiement = true;
      if ($paiement['status'] == "SUCCESS") {
        $this->process_paiement_prime($contrat, $prime, $auth_id);
        # $this->sendSMS($contrat->client->users->first()->shortFullName . ', votre payement de ' . $request->prime . 'F est recu pour le contrat ' . $contrat->reference . '. Reste a payer ' . $reste . '. GMMS et NSIA vous remercient.', $contrat->client->users->first());
        $this->sendSMS($contrat->client->users->first()->shortFullName . ', votre payement de ' . $request->prime . 'F est recu pour le contrat ' . $contrat->reference . '. GMMS et NSIA vous remercient.', $contrat->client->users->first());
        toastr()->success('Prime enregistrée avec succès.', 'Succès');
        toastr()->success('Commissions transférées avec succès.', 'Succès');
        Session::flash('success', 'Prime enregistrée avec succès.');
        Session::flash('success', 'Commissions transférées avec succès.');
        return redirect()->route('primes.create');
      } else {
        CheckPaiementStatusJob::dispatch($paiement['transref'], $contrat, $auth_id, "prime")->delay(now()->addMinutes(10));
        return response()->json(['message' => "Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.",],Response::HTTP_INTERNAL_SERVER_ERROR);
        toastr()->error('Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.', 'Erreur');
        Session::flash('errors', ['Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.']);
        $this->add_error('Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.');
        return redirect()->route('primes.create');
      }
    } else {
      return response()->json(['message' => "Veuillez entrer un contrat valide.",],Response::HTTP_INTERNAL_SERVER_ERROR);
      toastr()->warning('Veuillez entrer un contrat valide.', 'Erreur');
      return redirect()->route('primes.index');
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
                "marchand_id"  => Auth::user()->marchand->first()->id
            ]);
            return response()->json(['message' => "Prospect enregistré avec succes."],Response::HTTP_OK);
        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['message' => $message,],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function addSinistre(Request $request){

        $request->validate([
           'contrat.reference'        => 'required',
           'date_sinistre'        => 'required',
           'description'        => 'required',
        ]);


        try{

        $user = Auth::user();
        $contrat = Contrat::where('reference',$request["contrat"]["reference"])->first();

        if($contrat && $contrat->client_id==$user->client->first()->id)
        {
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
        else
        {
          return response()->json(['message' => "Ce contrat n\'existe pas. Veuillez bien verifier le numéro de police du contrat."],Response::HTTP_NOT_FOUND);
        }
        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json(['message' => $message,],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function getUser(Request $request){
        try{
          return response()->json(['data' =>  new UserResource(request()->user())],Response::HTTP_OK);
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

    public function getUserProspects(Request $request){

      try{
        if(request()->user()->hasRole(config('custom.roles.marchand')) == true){
          return response()->json(['data' => ProfilResource::collection(request()->user()->marchand->first()->prospects) ],Response::HTTP_OK);
        }
            else if(request()->user()->hasRole(config('custom.roles.direction')) == true){

              return response()->json(['data' => ProfilResource::collection(Prospect::all()) ],Response::HTTP_OK);
            }

        else{
          return response()->json(['message' => "Aucun résultats"],Response::HTTP_OK);
        }

      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }


    public function getUserSinistres(Request $request){

      try{
        if(request()->user()->hasRole(config('custom.roles.client')) == true){
          return response()->json(['data' => SinistreResource::collection( request()->user()->client->first()->sinistres->load("contrat"))
          ],Response::HTTP_OK);
        }

        else if(request()->user()->hasRole(config('custom.roles.marchand')) == true){
          return response()->json(['data' =>collect(request()->user()->marchand->first()->contrats->where('statut', '=', 'Sinistre')->load("sinistre"))->map(function ($contrat){
          	return $contrat == null ? null : [
          'id' => $contrat->sinistre->id,
          'statut' => $contrat->sinistre->statut,
          'description' => $contrat->sinistre->description,
          'date_sinistre' => $contrat->sinistre->date_sinistre,
          'contrat' => new UserContratResource($contrat),
      ];
          }),

           ],Response::HTTP_OK);
        }
            else if(request()->user()->hasRole(config('custom.roles.direction')) == true){

              return response()->json(['data' => SinistreResource::collection(Sinistre::all()->load('contrat')) ],Response::HTTP_OK);
            }
      

        else{
          return response()->json( ['message' => "Aucun résultat"],Response::HTTP_OK);
        }
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }


    public function getUserMarchands(Request $request){

      try{
        if(request()->user()->hasRole(config('custom.roles.smarchand')) == true){
          return response()->json(['data' => UserMarchandResource::collection(request()->user()->super_marchand->first()->actual_marchands->load("users")) ],Response::HTTP_OK);
        }
            else if(request()->user()->hasRole(config('custom.roles.direction')) == true){

              return response()->json(['data' => UserMarchandResource::collection(Marchand::all()->load('users')) ],Response::HTTP_OK);
            }else{
              return response()->json(['message' => "Aucun résultat"],Response::HTTP_OK);
            }
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json(['message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }


    public function getUserContrats(Request $request){

        try{
            if(request()->user()->hasRole(config('custom.roles.client')) == true){
              return response()->json(['data' => UserContratResource::collection(request()->user()->client->first()->contrats->load('souscriptions')->whereIn('statut',["Valide","Attente de paiement"])) ],Response::HTTP_OK);
            }
            else if(request()->user()->hasRole(config('custom.roles.marchand')) == true){
                        
            return response()->json(['data' => UserContratResource::collection(Auth::user()->marchand->first()->actual_contrats->load('souscriptions')->whereIn('statut',["Valide","Attente de paiement"])) ],Response::HTTP_OK);
            
            
              //return response()->json(['data' => UserContratResource::collection(request()->user()->marchand->first()->contrats->load('souscriptions')->where('statut',"Valide")) ],Response::HTTP_OK);
            }
            else if(request()->user()->hasRole(config('custom.roles.smarchand')) == true){

                $contrats = [];
                foreach (request()->user()->super_marchand->first()->actual_marchands as $marchand)
                {
                    foreach ($marchand->actual_contrats as $c)
                    {
                        array_push($contrats, $c->load('souscriptions')->whereIn('statut',["Valide","Attente de paiement"]));
                    }
                }
              return response()->json(['data' => UserContratResource::collection($contrats) ],Response::HTTP_OK);
            }
            else if(request()->user()->hasRole(config('custom.roles.direction')) == true){

              return response()->json(['data' => UserContratResource::collection(Contrat::all()->load('souscriptions')) ],Response::HTTP_OK);
            }else{
              return response()->json(['message' => "Aucun résultat"],Response::HTTP_OK);
            }
        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function logOut(Request $request){

        try{
            $accessToken=Auth::user()->token();
            $accessToken->revoke();
            return response()->json([ 'message' => 'Logout successful'],Response::HTTP_OK);
        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function getCounts(Request $request){

      try{
        if(request()->user()->hasRole(config('custom.roles.marchand')) == true){
          return response()->json(['data' => [
          	'nbre_prospects' => request()->user()->marchand->first()->prospects->count(),
          	'nbre_contrats' => request()->user()->marchand->first()->contrats->load('souscriptions')->whereIn('statut',["Valide","Attente de paiement"])->count(),
          ]

          ],Response::HTTP_OK);
        }
        else if(request()->user()->hasRole(config('custom.roles.direction')) == true){
          return response()->json(['data' => [
          	'nbre_prospects' => Prospect::all()->count(),
          	'nbre_sinistres' => Sinistre::all()->count(),
          	'nbre_contrats' => Contrat::all()->count(),
          	'nbre_supermarchands' => SuperMarchand::all()->count(),
          	'nbre_marchands' => Marchand::all()->count(),
          ] ],Response::HTTP_OK);
        }

        else{
          return response()->json( ['message' => "Aucun résultats"],Response::HTTP_OK);
        }
      }
      catch(\Exception $e){
          $message = $e->getMessage();
          return response()->json(['message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
      }

    }


    public function getAllContrats(Request $request){

        try{


        	$contrats = Contrat::all()->load('souscriptions');
              		return response()->json(['data' => UserContratResource::collection($contrats) ],Response::HTTP_OK);
            	

        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function getAllProspects(Request $request){

        try{


         if(request()->user()->hasRole(config('custom.roles.direction')) == true){

            $prospects = Prospect::all();
            if($prospects->count() !=0){
              return response()->json(['data' => ProfilResource::collection($prospects) ],Response::HTTP_OK);
            }
            else{
              return response()->json(['message' => "Aucune donnée"],Response::HTTP_OK);
            }
        }

        else{
          return response()->json( ['message' => "Aucun résultats"],Response::HTTP_OK);
        }

        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function getAllSinistres(Request $request){

        try{


         if(request()->user()->hasRole(config('custom.roles.direction')) == true){

            $sinistres = Sinistre::all()->load("contrat","client");
            if($sinistres->count() !=0){
              return response()->json(['data' =>SinistreResource::collection($sinistres) ],Response::HTTP_OK);
            }
            else{
              return response()->json(['message' => "Aucune donnée"],Response::HTTP_OK);
            }
        }

        else{
          return response()->json( ['message' => "Aucun résultats"],Response::HTTP_OK);
        }

        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function getAllMarchands(Request $request){

        try{


         if(request()->user()->hasRole(config('custom.roles.direction')) == true){


        	$marchands = Marchand::all()->load("users");
            if($marchands->count() !=0){
              return response()->json(['data' => UserMarchandResource::collection($marchands) ],Response::HTTP_OK);
            }
            else{
              return response()->json(['message' => "Aucune donnée"],Response::HTTP_OK);
            }
        }

        else{
          return response()->json( ['message' => "Aucun résultats"],Response::HTTP_OK);
        }

        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function getAllSuperMarchands(Request $request){

        try{

         if(request()->user()->hasRole(config('custom.roles.direction')) == true){

        	$smarchands = SuperMarchand::all()->load("users")->load("marchands");
            if($smarchands->count() !=0){
              return response()->json(['data' =>UserMarchandResource::collection($smarchands) ],Response::HTTP_OK);
            }
            else{
              return response()->json(['message' => "Aucune donnée"],Response::HTTP_OK);
            }
        }

        else{
          return response()->json( ['message' => "Aucun résultats"],Response::HTTP_OK);
        }

        }
        catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }



  public function addPrime(Request $request)
  {
    $request->validate(['prime' => 'required']);

        try{
		    $prime = $request->prime;
		    $error = False;
		    $reste = 0;

		    if ($prime > 12000) { // si le montant supérieur a 12000f
		      $error = True;
          return response()->json(['message' => "Le total des primes ne peut etre supérieur à 12000."],Response::HTTP_UNPROCESSABLE_ENTITY);
		    }
		    if ($prime % 1000 != 0) { //si le montant n'est pas multiple de 1000
		      $monnaie = $prime % 1000;
		      $proposition = $prime - $monnaie;
		      $error = True;
          return response()->json(['message' => "Veuillez enregistrer un multiple de 1000. Proposition: ' . $proposition . ' ou ' . ($proposition + 1000)"],Response::HTTP_UNPROCESSABLE_ENTITY);
		    }

		    // recuperer le contrat
		    $reference = $request->reference;
		    $contrat = Contrat::where('reference', '=', $reference)->first();

		    if ($contrat) {
		      // si le statut du contrat est dans la liste suivante (pas bon)
		      if (in_array($contrat->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Terminé'], true)) {
			$error = True;
          return response()->json(['message' => "Vous ne pouvez pas enregistrer de primes sur ce contrat."],Response::HTTP_UNPROCESSABLE_ENTITY);
		      } else { // si le statut est bon
			if ($contrat->souscriptions->last()->primes->count() > 0) { // et que le contrat dispose deja de primes
			  // calcul du reste ici
			  $reste = (12 - $contrat->souscriptions->last()->primes->count()) * 1000; // primes restantes
			  if ($reste == 0) {
			    $error = True;
          return response()->json(['message' => "Ce client est déja à jour pour ce contrat."],Response::HTTP_UNPROCESSABLE_ENTITY);
			  } else {
			    if ($prime > $reste) {
			      $error = True;
          return response()->json(['message' => "Ce client doit payer: ' . $reste . ' F. La prime fournie ne peut être supérieure à ce montant."],Response::HTTP_UNPROCESSABLE_ENTITY);
			    }
			  }
			}
		      }
		    } else {
		      $error = True;
          return response()->json(['message' => "Veuillez entrer un contrat valide."],Response::HTTP_NOT_FOUND);
		    }

		    if ($error) {
          return response()->json(['message' => "Erreur du serveur. Veuillez réessayer."],Response::HTTP_INTERNAL_SERVER_ERROR);
		      exit();
		    } // breakIfErrors

		    if ($contrat) {
		      $auth_id = Auth::id();
		      $payingUser = $contrat->client->users->first();
		      $final_primes = 1 + $contrat->souscriptions->last()->primes->count();
		      $paiement = $this->pay($payingUser, $prime, $request->paiementChoice, $contrat->reference . "S" . $contrat->souscriptions->count() . "P" . $final_primes);
		      # $paiement = true;
		      if ($paiement['status'] == "SUCCESS") {
			$this->process_paiement_prime($contrat, $prime, $auth_id);
			# $this->sendSMS($contrat->client->users->first()->shortFullName . ', votre payement de ' . $request->prime . 'F est recu pour le contrat ' . $contrat->reference . '. Reste a payer ' . $reste . '. GMMS et NSIA vous remercient.', $contrat->client->users->first());
			$this->sendSMS($contrat->client->users->first()->shortFullName . ', votre payement de ' . $request->prime . 'F est recu pour le contrat ' . $contrat->reference . '. GMMS et NSIA vous remercient.', $contrat->client->users->first());

          return response()->json(['message' => "Prime enregistrée avec succès."],Response::HTTP_OK);
		      } else {
              CheckPaiementStatusJob::dispatch($paiement['transref'], $contrat, $auth_id, "prime")->delay(now()->addMinutes(10));

              return response()->json(['message' => "Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement." ],Response::HTTP_UNPROCESSABLE_ENTITY);
              Session::flash('errors', ['Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.']);
              $this->add_error('Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.');
              return redirect()->route('primes.create');
		      }
		    } else {
          return response()->json(['message' => "Veuillez entrer un contrat valide."],Response::HTTP_NOT_FOUND);
		    }

         }catch(\Exception $e){
            $message = $e->getMessage();
            return response()->json([ 'message' => $message],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
  }

}
