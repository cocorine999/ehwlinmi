<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserContratResource;
use App\Jobs\Paiements\CheckPaiementStatusJob;
use App\Jobs\Paiements\PayerPrimeJob;
use App\Traits\MobilePaiement;
use App\Traits\ServicesValidationTrait;
use App\Models\Fichier;
use Session;
use App\Models\MobileMoney;
use Illuminate\Support\Facades\Auth;
use App\Models\Contrat;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Souscription;
use App\Models\Beneficiaire;
use App\Models\StatutSouscription;
use App\Models\Assure;
use App\User;
use Illuminate\Http\File;

class ContratController extends Controller
{


  use MobilePaiement, ServicesValidationTrait;

  public function __construct(){
    $this->middleware('auth:api');
  }

  public function paiementPrime(Request $request)
  {
    $request->validate(['prime' => 'required']);
    $prime = $request->prime;
    $error = False;
    $reste = 0;


    if ($prime > 12000) { // si le montant supérieur a 12000f
      $error = True;
      return response()->json(['message' => 'Le total des primes ne peut etre supérieur à 12000.',],Response::HTTP_UNPROCESSABLE_ENTITY);
      toastr()->warning('Le total des primes ne peut etre supérieur à 12000.', 'Erreur');

    }
    if ($prime % 1000 != 0) { //si le montant n'est pas multiple de 1000
      $monnaie = $prime % 1000;
      $proposition = $prime - $monnaie;
      $error = True;
      return response()->json(['message' => 'Veuillez enregistrer un multiple de 1000. Proposition: ' . $proposition . ' ou ' . ($proposition + 1000),],Response::HTTP_UNPROCESSABLE_ENTITY);
      toastr()->warning('Veuillez enregistrer un multiple de 1000. Proposition: ' . $proposition . ' ou ' . ($proposition + 1000), 'Erreur');
      $error = True;
    }

    // recuperer le contrat
    $reference = $request->reference;
    $contrat = Contrat::where('reference', '=', $reference)->first();

    if ($contrat) {
      // si le statut du contrat est dans la liste suivante (pas bon)
      if (in_array($contrat->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Terminé'], true)) {
        $error = True;
        return response()->json(['message' => 'Vous ne pouvez pas enregistrer de primes sur ce contrat.',],Response::HTTP_UNPROCESSABLE_ENTITY);
        toastr()->warning('Vous ne pouvez pas enregistrer de primes sur ce contrat.', 'Erreur');
        $error = True;
      } else { // si le statut est bon
        if ($contrat->souscriptions->last()->primes->count() > 0) { // et que le contrat dispose deja de primes
          // calcul du reste ici
          $reste = (12 - $contrat->souscriptions->last()->primes->count()) * 1000; // primes restantes
          if ($reste == 0) {
            $error = True;
            return response()->json(['message' => 'Ce client est déja à jour pour ce contrat.',],Response::HTTP_UNPROCESSABLE_ENTITY);
            toastr()->warning('Ce client est déja à jour pour ce contrat.', 'Erreur');

          } else {
            if ($prime > $reste) {
              return response()->json(['message' => 'Ce client doit payer: ' . $reste . ' F. La prime fournie ne peut être supérieure à ce montant.',],Response::HTTP_UNPROCESSABLE_ENTITY);
              toastr()->warning('Ce client doit payer: ' . $reste . ' F. La prime fournie ne peut être supérieure à ce montant.', 'Erreur');
              $error = True;
            }
          }
        }
      }
    } else {
      return response()->json(['message' => 'Veuillez entrer un contrat valide.',],Response::HTTP_INTERNAL_SERVER_ERROR);
      toastr()->warning('Veuillez entrer un contrat valide.', 'Erreur');
      $error = True;
    }

    if ($error) {
      return response()->json(['message' => 'Paiement non éffectué.',],Response::HTTP_INTERNAL_SERVER_ERROR);
      return redirect()->route('primes.create');
      exit();
    } // breakIfErrors

    if ($contrat) {
      $auth_id = Auth::id();
      $payingUser = $contrat->client->users->first();
      $final_primes = 1 + $contrat->souscriptions->last()->primes->count();
      $paiement = $this->pay($payingUser, $prime, "MOOV"/* $request->paiementChoice */, $contrat->reference . "S" . $contrat->souscriptions->count() . "P" . $final_primes);
      # $paiement = true;
      if ($paiement['status'] == "SUCCESS") {
        $this->process_paiement_prime($contrat, $prime, $auth_id);
        # $this->sendSMS($contrat->client->users->first()->shortFullName . ', votre payement de ' . $request->prime . 'F est recu pour le contrat ' . $contrat->reference . '. Reste a payer ' . $reste . '. GMMS et NSIA vous remercient.', $contrat->client->users->first());
        $this->sendSMS($contrat->client->users->first()->shortFullName . ', votre payement de ' . $request->prime . 'F est recu pour le contrat ' . $contrat->reference . '. GMMS et NSIA vous remercient.', $contrat->client->users->first());
        return response()->json(['message' => 'Paiement de la prime terminé.',],Response::HTTP_OK);
        toastr()->success('Prime enregistrée avec succès.', 'Succès');
        toastr()->success('Commissions transférées avec succès.', 'Succès');
        Session::flash('success', 'Prime enregistrée avec succès.');
        Session::flash('success', 'Commissions transférées avec succès.');
        return redirect()->route('primes.create');
      } else {
        CheckPaiementStatusJob::dispatch($paiement['transref'], $contrat, $auth_id, "prime")->delay(now()->addMinutes(10));
        return response()->json(['message' => "Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.",],Response::HTTP_OK);
        toastr()->error('Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.', 'Erreur');
        Session::flash('errors', ['Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.']);
        $this->add_error('Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.');
        return redirect()->route('primes.create');
      }
    } else {
      return response()->json(['message' => "Veuillez entrer un contrat valide.",],Response::HTTP_OK);
      toastr()->warning('Veuillez entrer un contrat valide.', 'Erreur');
      return redirect()->route('primes.index');
    }
  }
  
  
  public function store(Request $request){
      	if(Auth::user()->hasRole("Marchand") == true){	


              if (!$request->assure_type) {
                return response()->json(['message' => "Veuillez choisir un assure.",],Response::HTTP_INTERNAL_SERVER_ERROR);
                toastr()->error('Veuillez choisir un assure', 'Erreur assure');
                return redirect()->back();
              }
              
	    $r_client = [
	      "ajaxTelephone" => $request->clientajaxTelephone,
	      "type" =>  $request->client_type,
	      "nom" =>  $request->client_nom,
	      "prenom" =>  $request->client_prenom,
	      "date_naissance" =>  $request->client_date_naissance,
	      "sexe" =>  $request->client_sexe,
	      "situation_matrimoniale" =>  $request->client_situation_matrimoniale,
	      "telephone" =>  $request->client_telephone,
	      "email" =>  $request->client_email,
	      "adresse" =>  $request->client_adresse,
	      "ifu" =>  $request->client_ifu,
	      "profession" =>  $request->client_profession,
	      "employeur" =>  $request->client_employeur,
	    ];

	    $r_assure = [
	      "ajaxTelephone" => $request->assureajaxTelephone,
	      "type" =>  $request->assure_type,
	      "nom" =>  $request->assure_nom,
	      "prenom" =>  $request->assure_prenom,
	      "date_naissance" =>  $request->assure_date_naissance,
	      "sexe" =>  $request->assure_sexe,
	      "situation_matrimoniale" =>  $request->assure_situation_matrimoniale,
	      "telephone" =>  $request->assure_telephone,
	      "email" =>  $request->assure_email,
	      "adresse" =>  $request->assure_adresse,
	      "ifu" =>  $request->assure_ifu,
	      "profession" =>  $request->assure_profession,
	      "employeur" =>  $request->assure_employeur,
	      "taux" => $request->taux_assure
	    ];

 

              $q1 = $q2 = $q3 = $q4 = $q5 = '';
              if ($request->filled('q1')) {
                $q1 = $request->q1;
              }
              if ($request->filled('q2')) {
                $q2 = $request->q2;
              }
              if ($request->filled('q3')) {
                $q3 = $request->q3;
              }
              if ($request->filled('q4')) {
                $q4 = $request->q4;
              }
              if ($request->filled('q5')) {
                $q5 = $request->q5;
              }

              $marchand = Auth::user()->marchand->first();
              $user = $client = $assure = $beneficiaire1 = $beneficiaire2 = $beneficiaire3 = "";

              $password_client = "";
              $password_assure = "";
              if (config('app.use_generated_pass') == 1) {
                $password_client = (string) rand(1000, 9999);
                $password_assure = (string) rand(1000, 9999);
              } else {
                $password_client = "1234";
                $password_assure = "1234";
              }

              $new_client = "";
              $user_client = "";
              if ($r_client['type'] == "client_newuser") {
                $this->checkTelephone($r_client['telephone'], 'client');
                $this->checkEmail($r_client['email'], 'client');
                //creer un nouvel utilisateur client
           
                $user_client = new User([
			"nom"               => $request->client_nom,
			"prenom"            => $request->client_prenom,
			"date_naissance"    => $request->client_date_naissance,
			"sexe"              => $request->client_sexe,
			"situation_matrimoniale"   => $request->client_situation_matrimoniale,
			"telephone"         => $request->client_telephone,
			"email"             => $request->client_email,
			"adresse"           => $request->client_adresse,
			"ifu"               => $request->client_ifu,
			'password'          => bcrypt($password_client),
			'commune_id'        => Auth::user()->commune->id,
			'profession'        => $request->client_profession,
			'employeur'         => $request->client_employeur,
		]);
                
                $new_client = true;
              }

              elseif ($r_client['type'] == "client_olduser") { // pour utiliser un ancien user
                //selectionner l'utilisateur et envoyer message en cas d'erreur
                $user_client = $this->getUserWithTelephone($r_client['telephone'], "le client");
                if ($user_client == False) {
                    return response()->json(['message' => 'Nous ne parvenons pas retrouver le numero de telephone fourni pour le client : ' . $r_client['telephone'],],Response::HTTP_INTERNAL_SERVER_ERROR);
                }
              }

              $user_assure = "";
              if ($r_assure['type'] == "assure_newuser") { // pour un nouvel utilisateur assure
                // verifications
                $this->checkAge($r_assure['date_naissance'], 'assure');
                $this->checkTelephone($r_assure['telephone'], 'assuré');
                $this->checkEmail($r_assure['email'], 'assuré');

                //creer un nouvel utilisateur
                
                   $user_assure = new User([
			"nom"               => $request->assure_nom,
			"prenom"            => $request->assure_prenom,
			"date_naissance"    => $request->assure_date_naissance,
			"sexe"              => $request->assure_sexe,
			"situation_matrimoniale"   => $request->assure_situation_matrimoniale,
			"telephone"         => $request->assure_telephone,
			"email"             => $request->assure_email,
			"adresse"           => $request->assure_adresse,
			"ifu"               => $request->assure_ifu,
			'password'          => bcrypt($password_assure),
			'commune_id'        => Auth::user()->commune->id,
			'profession'        => $request->assure_profession,
			'employeur'         => $request->assure_employeur,
		    ]);

                $client = $this->createClientProfil($user_client);
                // creer son compte assure                
		 $assure = Assure::create(['taux' => $request->taux_assure]);
                $assure->users()->save($user_assure)->assignRole(['Assure']);
                //retourner le user et le user_assure
                
              }

              elseif ($r_assure['type'] == "assure_clients") { // pour utiliser le precedent user
                // verifier la date de naissance de l'utlisateur precedent
                $this->checkAge($user_client->date_naissance, 'assure');
                // recuperer le precedent client
                // Verifier si il a un compte client et creer son compte client
                $client = $this->createClientProfil($user_client);

                // Verifier si il a un compte assure et creer son compte assure
		$assure = $this->createAssureProfil($user_client, $request->taux_assure);
                // retourner le user et le user_assure
                
      
              }

              elseif ($r_assure['type'] == "assure_olduser") { // pour utiliser un ancien user
                //selectionner l'utilisateur
                $user_assure = $this->getUserWithTelephone($r_assure['telephone'], "l'assure");

                if ($user_assure == False) {
                  return response()->json(['message' => 'Nous ne parvenons pas retrouver le numero de telephone fourni pour l\'assure : ' . $r_assure['telephone'],],Response::HTTP_INTERNAL_SERVER_ERROR);
                }
                // verifier la date de naissance de l'utlisateur precedent

                $this->checkAge($user_assure->date_naissance, 'assure');
                // recuperer le precedent client
                // Verrifier si il a un compte client et creer son compte client
                $client = $this->createClientProfil($user_client);

                // Verrifier si il a un compte assure et creer son compte assure
                $assure = $this->createAssureProfil($user_assure,  $request->taux_assure);
              }


              //generer reference contrat
              $id_super_marchand = $marchand->super_marchands->last()->id;
              $code_departement = Auth::user()->commune->departement->code;
              $client_count = (int) $marchand->contrats->count();
              $client_count = $client_count + 1;
              $random = rand(100, 999);
              $reference_contrat = $id_super_marchand . "" . $code_departement . "" . $marchand->id . "N" . $client_count . "" . $random;

              // Creation du contrat
              $contrat = Contrat::create([
                'reference'         => $reference_contrat,
                'client_id'         => $client->id,
                'assure_id'         => $assure->id,
                'q1'                => $q1,
                'q2'                => $q2,
                'q3'                => $q3,
                'q4'                => $q4,
                'q5'                => $q5,
              ]);
              $contrat->marchands()->attach($marchand);
	      $contrat->assures()->attach(
	        $assure,
	        ["taux" => $request->taux_assure]
	      );
	      
              // creation de la souscription
              $souscription = Souscription::create([
                "statut" => "Attente de paiement",
                "user_id" => Auth::id(),
                "contrat_id" => $contrat->id
              ]);
              $statut = StatutSouscription::whereLabel('Attente de paiement')->get();
              $souscription->statut_souscriptions()->attach($statut, ['user_id' => Auth::id(), 'motif' => "Nouvelle souscription"]);
    
              if ($contrat) {
                if ($request->hasFile('cni')) {
                  $filenameWithExt = $request->file('cni')->getClientOriginalName();
                  $filename = time() . 'CNI' . $contrat->reference;
                  $extension = $request->file('cni')->getClientOriginalExtension();
                  $fileNameToStore = $filename . '.' . $extension;
                  $path = $request->cni->move('images/CNI/', $fileNameToStore);

                  $fichier = new Fichier([
                    'label'         => "CNI",
                    'nom'           => $fileNameToStore,
                  ]);
                  $contrat->fichiers()->save($fichier);
                }
                
                
                if ($request->hasFile('bai')) {
                  $filenameWithExt = $request->file('bai')->getClientOriginalName();
                  $filename = time() . 'BAI' . $contrat->reference;
                  $extension = $request->file('bai')->getClientOriginalExtension();
                  $fileNameToStore = $filename . '.' . $extension;
                  $path = $request->bai->move('images/BAI/', $fileNameToStore);

                  $fichier = new Fichier([
                    'label'         => "BAI",
                    'nom'           => $fileNameToStore,
                  ]);
                  $contrat->fichiers()->save($fichier);
                }
                
                
	      /*if ($new_client) {
		$this->sendSMS('Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:' . $contrat->reference . '. Login: votre numero, mot de passe: ' . $password_client . '. Ne perdez pas votre couverture, payez votre prime a temps.', $user_client);
	      } else {
		$this->sendSMS('Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:' . $contrat->reference . '. Ne perdez pas votre couverture, payez votre prime a temps.', $user_client);
	      }*/

                return response()->json(['message' => 'Le nouveau contrat vient d\'être créer.','data' => new UserContratResource($contrat)],Response::HTTP_OK);
                toastr()->success('Nouveau Souscripteur ajouté avec succès.', 'Succès');
                toastr()->success('Nouvel Assuré ajouté avec succès.', 'Succès');
                toastr()->success('Nouveau Contrat ajouté avec succès.', 'Succès');
                return redirect()->route('contrats.addBeneficiares', $contrat->reference);
              } else {
                return response()->json(['message' => 'Contrat non créé. Veuillez corriger les erreurs.'],Response::HTTP_INTERNAL_SERVER_ERROR);
              }
          
      }
      else{

        return response()->json(['message' => "Vous n'avez pas la permission pour éffectuer cette operation."],Response::HTTP_UNAUTHORIZED);
      }
  }

  private function createClientProfil($user)
  {
    //Verrifier si il a un compte client
    $client = $user->client->first();
    if (!$client) {
      $client = Client::create();
      $client->users()->save($user)->assignRole(['Client']);
    }
    return $client;
  }
  
  private function createAssureProfil($user, $taux)
  {
    //Verifier si il a un compte client
    $assure = $user->assure->first();
    if (!$assure) {
      $assure = Assure::create(['taux' => $taux]);
      $assure->users()->save($user)->assignRole(['Assure']);
    }
    return $assure;
  }
  
  private function checkAge($date, $usertype)
  {
    $min = 0;
    $max = 0;
    if ($usertype == 'normal') {
      $min = 18;
      $max = 200;
    }
    if ($usertype == 'client') {
      $min = 18;
      $max = 200;
    }
    if ($usertype == 'assure') {
      $min = 18;
      $max = 74;
    }
    if ($usertype == 'beneficiaire1') {
      $min = 0;
      $max = 300;
    }
    if ($usertype == 'beneficiaire2') {
      $min = 0;
      $max = 300;
    }
    if ($usertype == 'beneficiaire3') {
      $min = 0;
      $max = 300;
    }
    if ($usertype == 'beneficiaire4') {
      $min = 0;
      $max = 300;
    }
    if ($usertype == 'beneficiaire5') {
      $min = 0;
      $max = 300;
    }
    $age = Carbon::parse($date)->age;
    if ($age < $min || $age > $max) {
      return response()->json(['message' => "L'assuré doit avoir entre ' . $min . ' et ' . $max . ' ans pour être inscrit.",],Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }

  public function verifAge($request, $usertype)
  {
    $min = 0;
    $max = 0;
    if ($usertype == 'normal') {
      $min = 18;
      $max = 200;
    }
    if ($usertype == 'client') {
      $min = 18;
      $max = 200;
    }
    if ($usertype == 'assure') {
      $min = 18;
      $max = 74;
    }
    if ($usertype == 'beneficiaire1') {
      $min = 0;
      $max = 300;
    }
    if ($usertype == 'beneficiaire2') {
      $min = 0;
      $max = 300;
    }
    if ($usertype == 'beneficiaire3') {
      $min = 0;
      $max = 300;
    }
    if ($usertype == 'beneficiaire4') {
      $min = 0;
      $max = 300;
    }
    if ($usertype == 'beneficiaire5') {
      $min = 0;
      $max = 300;
    }
    $age = Carbon::parse($request)->age;

    if ($age < $min || $age > $max) {
      return response()->json(['message' => "L'age doit être comprise entre ' . $min . ' et ' . $max . ' ans pour être inscrit.",],Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    else {
      return response()->json(['data' => true,],Response::HTTP_OK);
    }
  }

  private function checkTelephone($t, $who)
  {
    $user = User::where('telephone', '=', $t)->get();
    if ($user->count() >= 1) {
      return response()->json(['message' => 'Le téléphone: ' . $t . ' est déja utilisé sur la plateforme, veuillez le changer. (Telephone ' . $who . ')',],Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }

  public function verifTelephone($request)
  {
    $user = User::where('telephone', '=', $request)->get();
    if ($user->count() >= 1) {
      return response()->json(['message' => 'Le numero de téléphone est déja utilisé sur la plateforme, veuillez le changer. (Telephone ' . $request . ')',],Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    else {
      return response()->json(['data' => false,],Response::HTTP_OK);
    }
  }

  private function checkEmail($email, $who)
  {
    if ($email != "") {
      $user = User::where('email', '=', $email)->get();
      if ($user->count() >= 1) {
        return response()->json(['message' => 'L\'email: ' . $email . ' est déja utilisée sur la plateforme, veuillez le changer. (Email ' . $who . ').',],Response::HTTP_UNPROCESSABLE_ENTITY);
      }
    }
  }

  public function verifEmail($request)
  {
    if ($request != "") {
      $user = User::where('email', '=', $request)->get();
      if ($user->count() >= 1) {
        return response()->json(['message' => 'L\'email est déja utilisée sur la plateforme, veuillez le changer. (Email : ' . $request. ').',],Response::HTTP_UNPROCESSABLE_ENTITY);
      }
      else {
        return response()->json(['data' => false,],Response::HTTP_OK);
      }
    }
    else {
      return response()->json(['message' => "Aucune adresse email n'a été fournie.",],Response::HTTP_OK);
    }
  }

  private function getUserWithTelephone($telephone, $message)
  {
    $user = User::where('telephone', '=', $telephone)->first();
    if (!$user) {
      return False;
    } else {
      return $user;
    }
  }

  public function getUserByTelephone($request,$message)
  {
    $user = User::where('telephone', '=', $request)->first();
    if (!$user) {
      return response()->json(['message' => 'Nous ne parvenons pas retrouver l\'utilisateur associé au numero de telephone fourni pour '.$message .' Numero : '  . $request,],Response::HTTP_INTERNAL_SERVER_ERROR);
    } else {
      return response()->json(['data' => new UserResource($user),],Response::HTTP_OK);
    }
  }

  private function checkIfBeneficiaireNotAlreadyAssure($c, $t, $msg)
  {
    $user = $this->getUserWithTelephone($t, $msg);

    if ($user) {
      if ($user->id == $c->assure->users->first()->id) {
        //toastr()->error('Ce numero est celui de l\'assure. veuillez le changer. ' . $msg . ' : ' . $t, 'Erreur telephone');
        return false;
      } else {
        return $user;
      }
    }
  }

  public function verifIfBeneficiaireNotAlreadyAssure($request, $assure_user_id)
  {
    $user = $this->getUserWithTelephone($request, "");

    if ($user) {
      if ($user->id == $assure_user_id) {
        return response()->json(['message' => 'Ce numero est celui de l\'assure. veuillez le changer.',],Response::HTTP_UNPROCESSABLE_ENTITY);
        //toastr()->error('Ce numero est celui de l\'assure. veuillez le changer. ' . $msg . ' : ' . $t, 'Erreur telephone');
        return false;
      } else {
        return response()->json(['data' => new UserResource($user),],Response::HTTP_OK);
        return $user;
      }
    }
    else{
    return response()->json(['message' => "",],Response::HTTP_OK);
      return response()->json(['message' => 'Nous ne parvenons pas à retrouver l\'utilisateur associé au numero de telephone fourni pour le '.$request["message"] .' Numero : '  . $request["telephone"],],Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }


  public function ajouterBeneficiaires(Request $request)
  {
    $remaining_taux = 100;
    $contrat = Contrat::where('reference', $request['reference'])->first();
    if ($contrat) {
      if ($contrat->beneficiaires->count() == 5) {
        return response()->json(['message' => 'Ce contrat possede déja 5 bénéficiaires.'],Response::HTTP_UNPROCESSABLE_ENTITY);
      } elseif ($contrat->beneficiaires->count() > 0 && $contrat->beneficiaires->count() < 5) {
        $taux = $contrat->beneficiaires->map(function ($item, $key) {
          return $item->taux;
        });
        $taux = array_sum($taux->all());
        if ($taux == 100) {
          return response()->json(['message' => 'Ce contrat possede déja un taux de 100%.'],Response::HTTP_UNPROCESSABLE_ENTITY);
        } elseif ($taux > 100) {
          return response()->json(['message' => 'Ce contrat possede déja un taux de plus de 100%.'],Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
          $remaining_taux = 100 - $taux;
            return response()->json(['message' => 'Il vous reste un taux de ' . $remaining_taux . '%. Attention à ne pas le depasser.'],Response::HTTP_OK);

        }
      }
      else{
        return response()->json(['message' => 'Ce contrat ne possede aucun bénéficiaire.'],Response::HTTP_OK);
      }
      //return response()->json(['message' => 'Un nouveau bénéficiaire vient d\'être à la liste'],Response::HTTP_OK);
    } else {
      return response()->json(['message' => 'Nous ne retouvons pas ce contrat. Référence: ' . $reference],Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }

  public function storeBeneficiaires(Request $request)
  {
    #dd($request->all());

    $contrat = Contrat::reference($request["reference"])->first();
    if ($contrat) {

      //faires les verificatins ici

      $password = "";
      if (config('app.use_generated_pass') == 1) {
        $password = (string) rand(1000, 9999);
      } else {
        $password = "1234";
      }

      for ($i=0; $i < count($request["beneficiaires"]); $i++) {

          $request_beneficiaire =  [
            //"ajaxTelephone" => $request->beneficiaire1ajaxTelephone,
            "type" =>  $request["beneficiaires"][$i]["user"]["type"],
            "nom" =>  $request["beneficiaires"][$i]["user"]["nom"],
            "prenom" =>  $request["beneficiaires"][$i]["user"]["prenom"],
            "date_naissance" => $request["beneficiaires"][$i]["user"]["date_naissance"],
            "sexe" => $request["beneficiaires"][$i]["user"]["sexe"],
            "situation_matrimoniale" => $request["beneficiaires"][$i]["user"]["situation_matrimoniale"],
            "telephone" => $request["beneficiaires"][$i]["user"]["telephone"],
            "email" => $request["beneficiaires"][$i]["user"]["email"],
            "adresse" => $request["beneficiaires"][$i]["user"]["adresse"],
            "ifu" => $request["beneficiaires"][$i]["user"]["ifu"],
            "profession" => $request["beneficiaires"][$i]["user"]["profession"],
            "employeur" => $request["beneficiaires"][$i]["user"]["employeur"],
            "taux" => $request["beneficiaires"][$i]["taux"],
          ];

          $user_client = $contrat->client->users->first();
          $assure = $contrat->assure;

          $beneficiaire_user = "";


          if ($request_beneficiaire['type'] == "beneficiaire". strval($i + 1) ."_clients") {

            $beneficiaire_user = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $user_client->telephone, "bénéficiaire n°". strval($i + 1));

            if ($beneficiaire_user == False) {
              return response()->json(['message' => 'Le numero de telephone fourni pour le beneficiaire n°'. strval($i + 1) .' est attribué à l\'assurer. veuillez le changer. Numero :'  . $user_client->telephone,],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $beneficiaire = Beneficiaire::create(['taux' => $request["beneficiaires"][$i]["taux"]]);
            $beneficiaire->users()->save($user_client)->assignRole('Beneficiaire');
            $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire->id]);
          }

          elseif ($request_beneficiaire['type'] == "beneficiaire". strval($i + 1) ."_newuser") {
            $this->checkTelephone($request_beneficiaire['telephone'], 'beneficiaire'. strval($i + 1));
            $this->checkEmail($request_beneficiaire['email'], 'beneficiaire'. strval($i + 1));

            //creer un nouvel utilisateur
            $beneficiaire_user = new User([

                "nom" =>  $request["beneficiaires"][$i]["user"]["nom"],
                "prenom" =>  $request["beneficiaires"][$i]["user"]["prenom"],
                "date_naissance" => $request["beneficiaires"][$i]["user"]["date_naissance"],
                "sexe" => $request["beneficiaires"][$i]["user"]["sexe"],
                "situation_matrimoniale" => $request["beneficiaires"][$i]["user"]["situation_matrimoniale"],
                "telephone" => $request["beneficiaires"][$i]["user"]["telephone"],
                "email" => $request["beneficiaires"][$i]["user"]["email"],
                "adresse" => $request["beneficiaires"][$i]["user"]["adresse"],
                "ifu" => $request["beneficiaires"][$i]["user"]["ifu"],
                "profession" => $request["beneficiaires"][$i]["user"]["profession"],
                "employeur" => $request["beneficiaires"][$i]["user"]["employeur"],
                'password'          => bcrypt($password),
                'commune_id'        => Auth::user()->commune->id,
            ]);
            $beneficiaire = Beneficiaire::create(['taux' => $request["beneficiaires"][$i]["taux"]]);
            $beneficiaire->users()->save($beneficiaire_user)->assignRole('Beneficiaire');
            $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire->id]);
          }

          elseif ($request_beneficiaire['type'] == "beneficiaire". strval($i + 1) ."_olduser") { // pour utiliser un ancien user
            //selectionner l'utilisateur et envoyer message en cas d'erreur
           $beneficiaire_user = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $request_beneficiaire['telephone'], "bénéficiaire n°". strval($i + 1));

            //return strval("$beneficiaire_user");#dd([$user_benef1, $r_benef1['ajaxTelephone'] ]);


            //dd($beneficiaire_user);
            if ($beneficiaire_user == False) {
              //return response()->json(['message' => 'Nous ne parvenons pas retrouver l\'utilisateur associé au numero de telephone fourni pour le '.$msg .' Numero : '  . $t,],Response::HTTP_INTERNAL_SERVER_ERROR);
              return response()->json(['message' => 'Le numero de telephone fourni pour le beneficiaire n°'. strval($i + 1) .' est attribué à l\'assurer. veuillez le changer. Numero : '  . $request_beneficiaire['telephone'],],Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $beneficiaire = Beneficiaire::create(['taux'    => $request["beneficiaires"][$i]["taux"]]);
            $beneficiaire->users()->save($beneficiaire_user)->assignRole('Beneficiaire');
            $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire->id]);

          }

      }

      $contrat = $contrat->reference;
      return response()->json(['message' => "La souscription au contrat d'assurance est terminé"], Response::HTTP_OK);
    }else{
      return response()->json(['message' => 'Veuillez entrer un contrat valide.',],Response::HTTP_INTERNAL_SERVER_ERROR);
    }


  }
}
