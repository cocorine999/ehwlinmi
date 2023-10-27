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

class ContratController extends Controller
{

  use MobilePaiement, ServicesValidationTrait;

  public function store(Request $request)
  {

    try{

    dd($request->all());
    if (!$request["assure"]["type"]) {
      return response()->json(['message' => "Veuillez choisir un assure.",],Response::HTTP_INTERNAL_SERVER_ERROR);
      toastr()->error('Veuillez choisir un assure', 'Erreur assure');
      return redirect()->back();
    }

    $r_client = [
      //"ajaxTelephone" => $request->clientajaxTelephone,
        "type" =>  $request["client"]["type"],
        "nom" =>  $request["client"]["user"]["nom"],
        "prenom" =>  $request["client"]["user"]["prenom"],
        "date_naissance" => $request["client"]["user"]["date_naissance"],
        "sexe" => $request["client"]["user"]["sexe"],
        "situation_matrimoniale" => $request["client"]["user"]["situation_matrimoniale"],
        "telephone" => $request["client"]["user"]["telephone"],
        "email" => $request["client"]["user"]["email"],
        "adresse" => $request["client"]["user"]["adresse"],
        "ifu" => $request["client"]["user"]["ifu"],
        "profession" => $request["client"]["user"]["profession"],
        "employeur" => $request["client"]["user"]["employeur"],
    ];

    $r_assure = [
      "type" =>  $request["assure"]["type"],
      "nom" =>  $request["assure"]["user"]["nom"],
      "prenom" =>  $request["assure"]["user"]["prenom"],
      "date_naissance" => $request["assure"]["user"]["date_naissance"],
      "sexe" => $request["assure"]["user"]["sexe"],
      "situation_matrimoniale" => $request["assure"]["user"]["situation_matrimoniale"],
      "telephone" => $request["assure"]["user"]["telephone"],
      "email" => $request["assure"]["user"]["email"],
      "adresse" => $request["assure"]["user"]["adresse"],
      "ifu" => $request["assure"]["user"]["ifu"],
      "profession" => $request["assure"]["user"]["profession"],
      "employeur" => $request["assure"]["user"]["employeur"],
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

          "nom" =>  $request["client"]["user"]["nom"],
          "prenom" =>  $request["client"]["user"]["prenom"],
          "date_naissance" => $request["client"]["user"]["date_naissance"],
          "sexe" => $request["client"]["user"]["sexe"],
          "situation_matrimoniale" => $request["client"]["user"]["situation_matrimoniale"],
          "telephone" => $request["client"]["user"]["telephone"],
          "email" => $request["client"]["user"]["email"],
          "adresse" => $request["client"]["user"]["adresse"],
          "ifu" => $request["client"]["user"]["ifu"],
          "profession" => $request["client"]["user"]["profession"],
          "employeur" => $request["client"]["user"]["employeur"],
          'password'          => bcrypt($password_client),
          'commune_id'        => Auth::user()->commune->id,

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
        "nom" =>  $request["assure"]["user"]["nom"],
        "prenom" =>  $request["assure"]["user"]["prenom"],
        "date_naissance" => $request["assure"]["user"]["date_naissance"],
        "sexe" => $request["assure"]["user"]["sexe"],
        "situation_matrimoniale" => $request["assure"]["user"]["situation_matrimoniale"],
        "telephone" => $request["assure"]["user"]["telephone"],
        "email" => $request["assure"]["user"]["email"],
        "adresse" => $request["assure"]["user"]["adresse"],
        "ifu" => $request["assure"]["user"]["ifu"],
        "profession" => $request["assure"]["user"]["profession"],
        "employeur" => $request["assure"]["user"]["employeur"],
        'password'          => bcrypt($password_assure),
        'commune_id'        => Auth::user()->commune->id,
      ]);

      $client = $this->createClientProfil($user_client);
      // creer son compte assure
      $assure = Assure::create();
      $assure->users()->save($user_assure)->assignRole(['Assure']);
      //retourner le user et le user_assure
    }

    elseif ($r_assure['type'] == "assure_clients") { // pour utiliser le precedent user
      // verifier la date de naissance de l'utlisateur precedent
      $this->checkAge($user_client->date_naissance, 'assure');
      // recuperer le precedent client
      // Verrifier si il a un compte client et creer son compte client
      $client = $this->createClientProfil($user_client);

      // Verrifier si il a un compte assure et creer son compte assure
      $assure = $this->createAssureProfil($user_client);

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
      $assure = $this->createAssureProfil($user_assure);
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
      if ($new_client) {
        $this->sendSMS('Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:' . $contrat->reference . '. Login: votre numero, mot de passe: ' . $password_client . '. Ne perdez pas votre couverture, payez votre prime a temps.', $user_client);
      } else {
        $this->sendSMS('Bienvenue chez EHWLINMI ASSURANCE. Ref Contrat:' . $contrat->reference . '. Ne perdez pas votre couverture, payez votre prime a temps.', $user_client);
      }

      return response()->json(['message' => 'Enregistrement du contrat terminé.','data' => new UserContratResource($contrat)],Response::HTTP_OK);
      toastr()->success('Nouveau Souscripteur ajouté avec succès.', 'Succès');
      toastr()->success('Nouvel Assuré ajouté avec succès.', 'Succès');
      toastr()->success('Nouveau Contrat ajouté avec succès.', 'Succès');
      return redirect()->route('contrats.addBeneficiares', $contrat->reference);
    } else {
      return response()->json(['message' => 'Contrat non créé. Veuillez corriger les erreurs.'],Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
  catch(\Exception $e){
      $message = $e->getMessage();
      return response()->json(['message' => $message,],Response::HTTP_INTERNAL_SERVER_ERROR);
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
  private function createAssureProfil($user)
  {
    //Verrifier si il a un compte client
    $assure = $user->assure->first();
    if (!$assure) {
      $assure = Assure::create();
      $assure->users()->save($user)->assignRole(['Assure']);
    }
    return $assure;
  }

  // OK

  public function getContratByTelephone($telephone)
  {
    $contrats = [];
    $user = User::where('telephone', '=', $telephone)->first();
    if ($user) {
      $client = $user->client->first();
      if ($user->hasAnyRole([config('custom.roles.direction')])) {
        $user = False;
      } elseif ($client) {



            return response()->json(['data' => UserContratResource::collection($client->contrats->load('souscriptions')->where('statut',"Valide")) ],Response::HTTP_OK);

        foreach ($client->contrats as $c) {
          if (!in_array($c->souscriptions->last()->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Résilié', 'Supprimé', 'Annulé', 'Terminé'], true)) {
            $contrats = [
              "reference" => $c->reference,
              "assure" => $c->assure->users->first()->shortFullName,
              "primes" => 12 - $c->souscriptions->last()->primes->count()
            ];

            $contrats = ["data" => $contrats];
            $contrats["data"]["user"] = $user;

          }
        }
      return response()->json($contrats, Response::HTTP_OK);
      }
    }
    else{
      return response()->json(["message" => "Aucun contrat lié à ce numero de téléphone : ".$telephone],Response::HTTP_UNPROCESSABLE_ENTITY);

    }
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

  public function verifAge($date, $usertype)
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
    else {
      return response()->json(['message' => true,],Response::HTTP_OK);
    }
  }

  private function checkTelephone($t, $who)
  {
    $user = User::where('telephone', '=', $t)->get();
    if ($user->count() >= 1) {
      return response()->json(['message' => 'Le téléphone: ' . $t . ' est déja utilisé sur la plateforme, veuillez le changer. (Telephone ' . $who . ')',],Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }

  public function verifTelephone($telephone, $who)
  {
    $user = User::where('telephone', '=', $telephone)->get();
    if ($user->count() >= 1) {
      return response()->json(['message' => 'Le téléphone: ' . $telephone . ' est déja utilisé sur la plateforme, veuillez le changer. (Telephone ' . $who . ')',],Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    else {
      return response()->json(['message' => true,],Response::HTTP_OK);
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

  public function verifEmail($email, $who)
  {
    if ($email != "") {
      $user = User::where('email', '=', $email)->get();
      if ($user->count() >= 1) {
        return response()->json(['message' => 'L\'email: ' . $email . ' est déja utilisée sur la plateforme, veuillez le changer. (Email ' . $who . ').',],Response::HTTP_UNPROCESSABLE_ENTITY);
      }
      else {
        return response()->json(['message' => true,],Response::HTTP_OK);
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
      return response()->json(['message' => 'Nous ne parvenons pas retrouver le numero de telephone fourni pour ' . $message . ' : ' . $telephone,'errors' => ['message' => False]],Response::HTTP_UNPROCESSABLE_ENTITY);
    } else {
      return $user;
      return response()->json(['data' => $user,],Response::HTTP_OK);
    }
  }

  public function getUserByTelephone($telephone, $message)
  {
    $user = User::where('telephone', '=', $telephone)->first();
    if (!$user) {
      return response()->json(['message' => 'Nous ne parvenons pas retrouver le numero de telephone fourni pour ' . $message . ' : ' . $telephone,'errors' => ['message' => False]],Response::HTTP_UNPROCESSABLE_ENTITY);
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

  public function verifIfBeneficiaireNotAlreadyAssure($id, $t, $msg)
  {
    $user = $this->getUserWithTelephone($t, $msg);
    if ($user) {
      if ($user->id == $id) {
        return response()->json(['message' => 'Ce numero est celui de l\'assure. veuillez le changer. ' . $request["message"] . ' : ' . $request["telephone"],],Response::HTTP_UNPROCESSABLE_ENTITY);
        //toastr()->error('Ce numero est celui de l\'assure. veuillez le changer. ' . $msg . ' : ' . $t, 'Erreur telephone');
        return false;
      } else {
        return response()->json(['data' => new UserResource($user),],Response::HTTP_OK);
        return $user;
      }
    }
  }


  public function ajouterBeneficiaires($reference)
  {
    $remaining_taux = 100;
    $contrat = Contrat::where('reference', $reference)->first();
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
            return response()->json(['message' => 'Il vous reste un taux de ' . $remaining_taux . '%. Attention à ne pas le depasser.'],Response::HTTP_UNPROCESSABLE_ENTITY);

        }
      }
      return response()->json(['message' => 'Un nouveau bénéficiaire vient d\'être à la liste'],Response::HTTP_OK);
    } else {
      return response()->json(['message' => 'Nous ne retouvons pas ce contrat. Référence: ' . $reference],Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }

  public function checkIfReferenceExist($reference)
  {
      $assure = "";
      $contrat = Contrat::where('reference', '=', $reference)->first();
      if ($contrat) {
        $assure = $contrat->assure->users()->first()->fullname;
        return response()->json(['data' => UserContratResource::collection($contrat),], Response::HTTP_OK);
      }
      else{
        return response()->json(['message' => 'Nous ne retouvons pas ce contrat. Référence: ' . $reference],Response::HTTP_UNPROCESSABLE_ENTITY);
      }

  }

  public function storeBeneficiaires(Request $request)
  {
    #dd($request->all());

    $contrat = Contrat::where('reference', $request["contrat"])->first();
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
            "type" =>  $request["beneficiaires"][$i]["type"],
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
            $beneficiaire_user = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $user_client->telephone, "Bénéficiaire ". strval($i + 1));
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
            $beneficiaire_user = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $request_beneficiaire['telephone'], "Bénéficiaire ". strval($i + 1));
            #dd([$user_benef1, $r_benef1['ajaxTelephone'] ]);
            if ($beneficiaire_user == False) {
              return response()->json(['message' => 'Ce numero est celui de l\'assure. veuillez le changer. Bénéficiaire'. strval($i + 1) .' : ' . $request_beneficiaire['telephone'],],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $beneficiaire = Beneficiaire::create(['taux'    => $request["beneficiaires"][$i]["taux"]]);
            $beneficiaire->users()->save($beneficiaire_user)->assignRole('Beneficiaire');
            $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire->id]);
          }

      }

      $contrat = $contrat->reference;
      return response()->json(['message' => "Souscription de contrat d'assurance terminé"], Response::HTTP_OK);

      /* $r_benef1 = [
        //"ajaxTelephone" => $request->beneficiaire1ajaxTelephone,
        "type" =>  $request["beneficiaires"][0]["type"],
        "nom" =>  $request["beneficiaires"][0]["user"]["nom"],
        "prenom" =>  $request["beneficiaires"][0]["user"]["prenom"],
        "date_naissance" => $request["beneficiaires"][0]["user"]["date_naissance"],
        "sexe" => $request["beneficiaires"][0]["user"]["sexe"],
        "situation_matrimoniale" => $request["beneficiaires"][0]["user"]["situation_matrimoniale"],
        "telephone" => $request["beneficiaires"][0]["user"]["telephone"],
        "email" => $request["beneficiaires"][0]["user"]["email"],
        "adresse" => $request["beneficiaires"][0]["user"]["adresse"],
        "ifu" => $request["beneficiaires"][0]["user"]["ifu"],
        "profession" => $request["beneficiaires"][0]["user"]["profession"],
        "employeur" => $request["beneficiaires"][0]["user"]["employeur"],
        "taux" => $request["beneficiaires"][0]["taux"],
      ];

      $r_benef2 = [
        //"ajaxTelephone" => $request->beneficiaire1ajaxTelephone,
        "type" =>  $request["beneficiaires"][1]["type"],
        "nom" =>  $request["beneficiaires"][1]["user"]["nom"],
        "prenom" =>  $request["beneficiaires"][1]["user"]["prenom"],
        "date_naissance" => $request["beneficiaires"][1]["user"]["date_naissance"],
        "sexe" => $request["beneficiaires"][1]["user"]["sexe"],
        "situation_matrimoniale" => $request["beneficiaires"][1]["user"]["situation_matrimoniale"],
        "telephone" => $request["beneficiaires"][1]["user"]["telephone"],
        "email" => $request["beneficiaires"][1]["user"]["email"],
        "adresse" => $request["beneficiaires"][1]["user"]["adresse"],
        "ifu" => $request["beneficiaires"][1]["user"]["ifu"],
        "profession" => $request["beneficiaires"][1]["user"]["profession"],
        "employeur" => $request["beneficiaires"][1]["user"]["employeur"],
        "taux" => $request["beneficiaires"][1]["taux"],
      ];

      $r_benef3 = [
        //"ajaxTelephone" => $request->beneficiaire1ajaxTelephone,
        "type" =>  $request["beneficiaires"][2]["type"],
        "nom" =>  $request["beneficiaires"][2]["user"]["nom"],
        "prenom" =>  $request["beneficiaires"][2]["user"]["prenom"],
        "date_naissance" => $request["beneficiaires"][2]["user"]["date_naissance"],
        "sexe" => $request["beneficiaires"][2]["user"]["sexe"],
        "situation_matrimoniale" => $request["beneficiaires"][2]["user"]["situation_matrimoniale"],
        "telephone" => $request["beneficiaires"][2]["user"]["telephone"],
        "email" => $request["beneficiaires"][2]["user"]["email"],
        "adresse" => $request["beneficiaires"][2]["user"]["adresse"],
        "ifu" => $request["beneficiaires"][2]["user"]["ifu"],
        "profession" => $request["beneficiaires"][2]["user"]["profession"],
        "employeur" => $request["beneficiaires"][2]["user"]["employeur"],
        "taux" => $request["beneficiaires"][2]["taux"],
      ];

      $r_benef4 = [
        //"ajaxTelephone" => $request->beneficiaire1ajaxTelephone,
        "type" =>  $request["beneficiaires"][3]["type"],
        "nom" =>  $request["beneficiaires"][3]["user"]["nom"],
        "prenom" =>  $request["beneficiaires"][3]["user"]["prenom"],
        "date_naissance" => $request["beneficiaires"][3]["user"]["date_naissance"],
        "sexe" => $request["beneficiaires"][3]["user"]["sexe"],
        "situation_matrimoniale" => $request["beneficiaires"][3]["user"]["situation_matrimoniale"],
        "telephone" => $request["beneficiaires"][3]["user"]["telephone"],
        "email" => $request["beneficiaires"][3]["user"]["email"],
        "adresse" => $request["beneficiaires"][3]["user"]["adresse"],
        "ifu" => $request["beneficiaires"][3]["user"]["ifu"],
        "profession" => $request["beneficiaires"][3]["user"]["profession"],
        "employeur" => $request["beneficiaires"][3]["user"]["employeur"],
        "taux" => $request["beneficiaires"][3]["taux"],
      ];

      $r_benef5 = [
        //"ajaxTelephone" => $request->beneficiaire1ajaxTelephone,
        "type" =>  $request["beneficiaires"][4]["type"],
        "nom" =>  $request["beneficiaires"][4]["user"]["nom"],
        "prenom" =>  $request["beneficiaires"][4]["user"]["prenom"],
        "date_naissance" => $request["beneficiaires"][4]["user"]["date_naissance"],
        "sexe" => $request["beneficiaires"][4]["user"]["sexe"],
        "situation_matrimoniale" => $request["beneficiaires"][4]["user"]["situation_matrimoniale"],
        "telephone" => $request["beneficiaires"][4]["user"]["telephone"],
        "email" => $request["beneficiaires"][4]["user"]["email"],
        "adresse" => $request["beneficiaires"][4]["user"]["adresse"],
        "ifu" => $request["beneficiaires"][4]["user"]["ifu"],
        "profession" => $request["beneficiaires"][4]["user"]["profession"],
        "employeur" => $request["beneficiaires"][4]["user"]["employeur"],
        "taux" => $request["beneficiaires"][4]["taux"],
      ];

      $user_client = $contrat->client->users->first();
      $assure = $contrat->assure;

      $user_benef1 = "";
      if ($r_benef1['type'] == "beneficiaire1_clients") {
        $user_benef1 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $user_client->telephone, "Bénéficiaire 1");
        $beneficiaire1 = Beneficiaire::create(['taux' => $request["beneficiaires"][0]["taux"]]);
        $beneficiaire1->users()->save($user_client)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire1->id]);
      }

      elseif ($r_benef1['type'] == "beneficiaire1_newuser") {
        $this->checkTelephone($r_benef1['telephone'], 'beneficiaire1');
        $this->checkEmail($r_benef1['email'], 'beneficiaire1');

        //creer un nouvel utilisateur
        $user_benef1 = new User([

            "nom" =>  $request["beneficiaires"][0]["user"]["nom"],
            "prenom" =>  $request["beneficiaires"][0]["user"]["prenom"],
            "date_naissance" => $request["beneficiaires"][0]["user"]["date_naissance"],
            "sexe" => $request["beneficiaires"][0]["user"]["sexe"],
            "situation_matrimoniale" => $request["beneficiaires"][0]["user"]["situation_matrimoniale"],
            "telephone" => $request["beneficiaires"][0]["user"]["telephone"],
            "email" => $request["beneficiaires"][0]["user"]["email"],
            "adresse" => $request["beneficiaires"][0]["user"]["adresse"],
            "ifu" => $request["beneficiaires"][0]["user"]["ifu"],
            "profession" => $request["beneficiaires"][0]["user"]["profession"],
            "employeur" => $request["beneficiaires"][0]["user"]["employeur"],
            'password'          => bcrypt($password),
            'commune_id'        => Auth::user()->commune->id,
        ]);
        $beneficiaire1 = Beneficiaire::create(['taux' => $request["beneficiaires"][0]["taux"]]);
        $beneficiaire1->users()->save($user_benef1)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire1->id]);
      }

      elseif ($r_benef1['type'] == "beneficiaire1_olduser") { // pour utiliser un ancien user
        //selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef1 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef1['telephone'], "Bénéficiaire 1");
        #dd([$user_benef1, $r_benef1['ajaxTelephone'] ]);
        if ($user_benef1 == False) {
          return response()->json(['message' => 'Ce numero est celui de l\'assure. veuillez le changer. Bénéficiaire 1 : ' . $r_benef1['telephone'],'errors' => ['message' => false]],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $beneficiaire1 = Beneficiaire::create(['taux'    => $request["beneficiaires"][0]["taux"]]);
        $beneficiaire1->users()->save($user_benef1)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire1->id]);
      }


      $user_benef2 = "";
      if ($r_benef2['type'] == "beneficiaire2_newuser") {

        $this->checkTelephone($r_benef2['telephone'], 'beneficiaire2');
        $this->checkEmail($r_benef2['email'], 'beneficiaire2');

        //creer un nouvel utilisateur
        $user_benef2 = new User([

          "nom" =>  $request["beneficiaires"][1]["user"]["nom"],
          "prenom" =>  $request["beneficiaires"][1]["user"]["prenom"],
          "date_naissance" => $request["beneficiaires"][1]["user"]["date_naissance"],
          "sexe" => $request["beneficiaires"][1]["user"]["sexe"],
          "situation_matrimoniale" => $request["beneficiaires"][1]["user"]["situation_matrimoniale"],
          "telephone" => $request["beneficiaires"][1]["user"]["telephone"],
          "email" => $request["beneficiaires"][1]["user"]["email"],
          "adresse" => $request["beneficiaires"][1]["user"]["adresse"],
          "ifu" => $request["beneficiaires"][1]["user"]["ifu"],
          "profession" => $request["beneficiaires"][1]["user"]["profession"],
          "employeur" => $request["beneficiaires"][1]["user"]["employeur"],
          'password'          => bcrypt($password),
          'commune_id'        => Auth::user()->commune->id,

        ]);
        $beneficiaire2 = Beneficiaire::create(['taux'    => $request["beneficiaires"][1]["taux"]]);
        $beneficiaire2->users()->save($user_benef2)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire2->id]);
      }

      elseif ($r_benef2['type'] == "beneficiaire2_olduser") { // pour utiliser un ancien user
        // selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef2 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef2['telephone'], "Bénéficiaire 2");
        if ($user_benef2 == False) {
          return response()->json(['message' => 'Ce numero est celui de l\'assure. veuillez le changer. Bénéficiaire 2 : ' . $r_benef2['telephone'],'errors' => ['message' => false]],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $beneficiaire2 = Beneficiaire::create(['taux'    => $request["beneficiaires"][1]["taux"]]);
        $beneficiaire2->users()->save($user_benef2)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire2->id]);
      }

      $user_benef3 = "";
      if ($r_benef3['type'] == "beneficiaire3_newuser") {

        $this->checkTelephone($r_benef3['telephone'], 'beneficiaire3');
        $this->checkEmail($r_benef3['email'], 'beneficiaire3');

        //creer un nouvel utilisateur
        $user_benef3 = new User([
          "nom" =>  $request["beneficiaires"][2]["user"]["nom"],
          "prenom" =>  $request["beneficiaires"][2]["user"]["prenom"],
          "date_naissance" => $request["beneficiaires"][2]["user"]["date_naissance"],
          "sexe" => $request["beneficiaires"][2]["user"]["sexe"],
          "situation_matrimoniale" => $request["beneficiaires"][2]["user"]["situation_matrimoniale"],
          "telephone" => $request["beneficiaires"][2]["user"]["telephone"],
          "email" => $request["beneficiaires"][2]["user"]["email"],
          "adresse" => $request["beneficiaires"][2]["user"]["adresse"],
          "ifu" => $request["beneficiaires"][2]["user"]["ifu"],
          "profession" => $request["beneficiaires"][2]["user"]["profession"],
          "employeur" => $request["beneficiaires"][2]["user"]["employeur"],
          'password'          => bcrypt($password),
          'commune_id'        => Auth::user()->commune->id,
        ]);
        $beneficiaire3 = Beneficiaire::create(['taux'    =>  $request["beneficiaires"][2]["taux"]]);
        $beneficiaire3->users()->save($user_benef3)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire3->id]);
      }

      elseif ($r_benef3['type'] == "beneficiaire3_olduser") { // pour utiliser un ancien user
        //selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef3 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef3['telephone'], "Bénéficiaire 3");
        if ($user_benef3 == False) {
          return response()->json(['message' => 'Ce numero est celui de l\'assure. veuillez le changer. Bénéficiaire 3 : ' . $r_benef3['telephone'],'errors' => ['message' => false]],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $beneficiaire3 = Beneficiaire::create(['taux'    =>  $request["beneficiaires"][2]["taux"]]);
        $beneficiaire3->users()->save($user_benef3)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire3->id]);
      }

      $user_benef4 = "";
      if ($r_benef4['type'] == "beneficiaire4_newuser") {

        $this->checkTelephone($r_benef4['telephone'], 'beneficiaire4');
        $this->checkEmail($r_benef4['email'], 'beneficiaire4');

        //creer un nouvel utilisateur
        $user_benef4 = new User([
            "nom" =>  $request["beneficiaires"][3]["user"]["nom"],
            "prenom" =>  $request["beneficiaires"][3]["user"]["prenom"],
            "date_naissance" => $request["beneficiaires"][3]["user"]["date_naissance"],
            "sexe" => $request["beneficiaires"][3]["user"]["sexe"],
            "situation_matrimoniale" => $request["beneficiaires"][3]["user"]["situation_matrimoniale"],
            "telephone" => $request["beneficiaires"][3]["user"]["telephone"],
            "email" => $request["beneficiaires"][3]["user"]["email"],
            "adresse" => $request["beneficiaires"][3]["user"]["adresse"],
            "ifu" => $request["beneficiaires"][3]["user"]["ifu"],
            "profession" => $request["beneficiaires"][3]["user"]["profession"],
            "employeur" => $request["beneficiaires"][3]["user"]["employeur"],
            'password'          => bcrypt($password),
            'commune_id'        => Auth::user()->commune->id,
        ]);
        $beneficiaire4 = Beneficiaire::create(['taux'    => $request["beneficiaires"][3]["taux"]]);
        $beneficiaire4->users()->save($user_benef4)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire4->id]);
      }

      elseif ($r_benef4['type'] == "beneficiaire4_olduser") { // pour utiliser un ancien user
        //selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef4 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef4['telephone'], "Bénéficiaire 4");
        if ($user_benef4 == False) {
          return response()->json(['message' => 'Ce numero est celui de l\'assure. veuillez le changer. Bénéficiaire 4 : ' . $r_benef4['telephone'],'errors' => ['message' => false]],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $beneficiaire4 = Beneficiaire::create(['taux'    => $request["beneficiaires"][3]["taux"]]);
        $beneficiaire4->users()->save($user_benef4)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire4->id]);
      }

      $user_benef5 = "";
      if ($r_benef5['type'] == "beneficiaire5_newuser") {

        $this->checkTelephone($r_benef5['telephone'], 'beneficiaire5');
        $this->checkEmail($r_benef5['email'], 'beneficiaire5');

        //creer un nouvel utilisateur
        $user_benef5 = new User([

            "nom" =>  $request["beneficiaires"][4]["user"]["nom"],
            "prenom" =>  $request["beneficiaires"][4]["user"]["prenom"],
            "date_naissance" => $request["beneficiaires"][4]["user"]["date_naissance"],
            "sexe" => $request["beneficiaires"][4]["user"]["sexe"],
            "situation_matrimoniale" => $request["beneficiaires"][4]["user"]["situation_matrimoniale"],
            "telephone" => $request["beneficiaires"][4]["user"]["telephone"],
            "email" => $request["beneficiaires"][4]["user"]["email"],
            "adresse" => $request["beneficiaires"][4]["user"]["adresse"],
            "ifu" => $request["beneficiaires"][4]["user"]["ifu"],
            "profession" => $request["beneficiaires"][4]["user"]["profession"],
            "employeur" => $request["beneficiaires"][4]["user"]["employeur"],
            'password'          => bcrypt($password),
            'commune_id'        => Auth::user()->commune->id,

        ]);
        $beneficiaire5 = Beneficiaire::create(['taux'    => $request["beneficiaires"][4]["taux"]]);
        $beneficiaire5->users()->save($user_benef5)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire5->id]);
      }

      elseif ($r_benef5['type'] == "beneficiaire5_olduser") { // pour utiliser un ancien user
        //selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef5 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef5['telephone'], "Bénéficiaire 5");
        if ($user_benef5 == False) {
          return response()->json(['message' => 'Ce numero est celui de l\'assure. veuillez le changer. Bénéficiaire 5 : ' . $r_benef5['telephone'],'errors' => ['message' => false]],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $beneficiaire5 = Beneficiaire::create(['taux'    => $request["beneficiaires"][4]["taux"]]);
        $beneficiaire5->users()->save($user_benef5)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire5->id]);
      } */
    }

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
      $paiement = $this->pay($payingUser, $prime, $request->paiementChoice, $contrat->reference . "S" . $contrat->souscriptions->count() . "P" . $final_primes);
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

}
