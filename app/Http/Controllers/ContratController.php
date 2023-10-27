<?php

namespace App\Http\Controllers;

use Notification;
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
use Illuminate\Support\Facades\Mail;

use App\Mail\ContratRejeteToAdminMail;
use App\Notifications\contrats\AnnulerContratNotificationAdmin;
use App\Notifications\contrats\AnnulerContratNotificationClient;
use App\Notifications\contrats\DemandeAnnulationNotificationAdmin;
use App\Notifications\contrats\DemandeAnnulationNotificationClient;
use App\Notifications\contrats\DemandeResiliationNotificationAdmin;
use App\Notifications\contrats\DemandeResiliationNotificationClient;
use App\Notifications\contrats\ResilierContratNotificationAdmin;
use App\Notifications\contrats\ResilierContratNotificationClient;

class ContratController extends Controller
{

  public function create()
  {
    return view('dash.contrats.create');
  }


  public function index(Request $request)
  {
    return view('dash.contrats.index', compact(['contrats', 'moisactuel']));
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
      toastr()->error('L\'assuré doit avoir entre ' . $min . ' et ' . $max . ' ans pour être inscrit.', 'Erreur Age');
      return redirect()->back();
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


  private function checkTelephone($t, $who)
  {
    $user = User::where('telephone', '=', $t)->get();
    if ($user->count() >= 1) {
      toastr()->error('Le téléphone: ' . $t . ' est déja utilisé sur la plateforme, veuillez le changer. (Telephone ' . $who . ')', 'Erreur telephone');
      return redirect()->back();
    }
  }

  private function checkEmail($email, $who)
  {
    if ($email != "") {
      $user = User::where('email', '=', $email)->get();
      if ($user->count() >= 1) {
        toastr()->error('L\'email: ' . $email . ' est déja utilisée sur la plateforme, veuillez le changer. (Email ' . $who . ').', 'Erreur email');
        return redirect()->back();
      }
    }
  }

  private function getUserWithTelephone($t, $msg)
  {
    $user = User::where('telephone', '=', $t)->first();
    if (!$user) {
      toastr()->error('Nous ne parvenons pas retrouver le numero de telephone fourni pour ' . $msg . ' : ' . $t, 'Erreur telephone');
      return False;
    } else {
      return $user;
    }
  }

  private function checkIfBeneficiaireNotAlreadyAssure($c, $t, $msg)
  {
    $user = $this->getUserWithTelephone($t, $msg);
    if ($user) {
      if ($user->id == $c->assure->users->first()->id) {
        toastr()->error('Ce numero est celui de l\'assure. veuillez le changer. ' . $msg . ' : ' . $t, 'Erreur telephone');
        return false;
      } else {
        return $user;
      }
    }
  }

  public function store(Request $request)
  {

    if (!$request->assure_type) {
      toastr()->error('Veuillez choisir un assure', 'Erreur assure');
      return redirect()->back();
    }

    // $telephonesBeneficiares = [
    //     $request->beneficiaire1_telephone,
    //     $request->beneficiaire2_telephone,
    //     $request->beneficiaire3_telephone,
    //     $request->beneficiaire4_telephone,
    //     $request->beneficiaire5_telephone,
    // ];

    // if(($request->client_telephone == $request->assure_telephoneb) && (in_array($request->assure_telephone, $telephonesBeneficiares , true))){
    //     toastr()->error('Le souscripteur ne peut être assuré et bénéficiaire à la fois.', 'Erreur Telephone');
    //     return redirect()->back();
    // }

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
    } elseif ($r_client['type'] == "client_olduser") { // pour utiliser un ancien user
      //selectionner l'utilisateur et envoyer message en cas d'erreur
      $user_client = $this->getUserWithTelephone($r_client['ajaxTelephone'], "le client");
      if ($user_client == False) {
        return redirect()->back();
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
      $assure = Assure::create();
      $assure->users()->save($user_assure)->assignRole(['Assure']);
      //retourner le user et le user_assure
    } elseif ($r_assure['type'] == "assure_clients") { // pour utiliser le precedent user
      // verifier la date de naissance de l'utlisateur precedent
      $this->checkAge($user_client->date_naissance, 'assure');
      // recuperer le precedent client
      // Verrifier si il a un compte client et creer son compte client
      $client = $this->createClientProfil($user_client);

      // Verrifier si il a un compte assure et creer son compte assure
      $assure = $this->createAssureProfil($user_client);

      // retourner le user et le user_assure
    } elseif ($r_assure['type'] == "assure_olduser") { // pour utiliser un ancien user
      //selectionner l'utilisateur
      $user_assure = $this->getUserWithTelephone($r_assure['ajaxTelephone'], "l'assure");

      if ($user_assure == False) {
        return redirect()->back();
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

      toastr()->success('Nouveau Souscripteur ajouté avec succès.', 'Succès');
      toastr()->success('Nouvel Assuré ajouté avec succès.', 'Succès');
      toastr()->success('Nouveau Contrat ajouté avec succès.', 'Succès');
      return redirect()->route('contrats.addBeneficiares', $contrat->reference);
    } else {
      toastr()->error('Contrat non créé. Veuillez corriger les erreurs.', 'Succès');
      return redirect()->route('contrats.create');
    }
  }


  public function ajouterBeneficiaires($contrat)
  {
    $remaining_taux = 100;
    $reference_fournie = $contrat;
    $contrat = Contrat::where('reference', $contrat)->first();
    if ($contrat) {
      if ($contrat->beneficiaires->count() == 5) {
        toastr()->warning('Ce contrat possede déja 5 bénéficiaires.', 'Avertissement');
        return redirect()->route('contrats.show', $contrat->reference);
      } elseif ($contrat->beneficiaires->count() > 0 && $contrat->beneficiaires->count() < 5) {
        $taux = $contrat->beneficiaires->map(function ($item, $key) {
          return $item->taux;
        });
        $taux = array_sum($taux->all());
        if ($taux == 100) {
          toastr()->warning('Ce contrat possede déja un taux de 100%.', 'Avertissement');
          return redirect()->route('contrats.show', $contrat->reference);
        } elseif ($taux > 100) {
          toastr()->warning('Ce contrat possede déja 5 bénéficiaires.', 'Avertissement');
          return redirect()->route('contrats.show', $contrat->reference);
        } else {
          $remaining_taux = 100 - $taux;
          toastr()->warning('Il vous reste un taux de ' . $remaining_taux . '%. Attention à ne pas le depasser.', 'Avertissement');
        }
      }
      return view('dash.contrats.addBeneficiaires', compact(['contrat', 'remaining_taux']));
    } else {
      toastr()->warning('Nous ne retouvons pas ce contrat. Référence: ' . $reference_fournie, 'Avertissement');
      return redirect()->route('dash.index');
    }
  }

  public function storeBeneficiaires(Request $request)
  {
    #dd($request->all());

    $contrat = Contrat::where('reference', $request->contrat)->first();
    if ($contrat) {

      //faires les verificatins ici

      $password = "";
      if (config('app.use_generated_pass') == 1) {
        $password = (string) rand(1000, 9999);
      } else {
        $password = "1234";
      }

      $r_benef1 = [
        "ajaxTelephone" => $request->beneficiaire1ajaxTelephone,
        "type" =>  $request->beneficiaire1_type,
        "nom" =>  $request->beneficiaire1_nom,
        "prenom" =>  $request->beneficiaire1_prenom,
        "date_naissance" =>  $request->beneficiaire1_date_naissance,
        "sexe" =>  $request->beneficiaire1_sexe,
        "situation_matrimoniale" =>  $request->beneficiaire1_situation_matrimoniale,
        "telephone" =>  $request->beneficiaire1_telephone,
        "email" =>  $request->beneficiaire1_email,
        "adresse" =>  $request->beneficiaire1_adresse,
        "ifu" =>  $request->beneficiaire1_ifu,
        "profession" =>  $request->beneficiaire1_profession,
        "employeur" =>  $request->beneficiaire1_employeur,
        "taux" =>  $request->beneficiaire1_taux,
      ];

      $r_benef2 = [
        "ajaxTelephone" => $request->beneficiaire2ajaxTelephone,
        "type" =>  $request->beneficiaire2_type,
        "nom" =>  $request->beneficiaire2_nom,
        "prenom" =>  $request->beneficiaire2_prenom,
        "date_naissance" =>  $request->beneficiaire2_date_naissance,
        "sexe" =>  $request->beneficiaire2_sexe,
        "situation_matrimoniale" =>  $request->beneficiaire2_situation_matrimoniale,
        "telephone" =>  $request->beneficiaire2_telephone,
        "email" =>  $request->beneficiaire2_email,
        "adresse" =>  $request->beneficiaire2_adresse,
        "ifu" =>  $request->beneficiaire2_ifu,
        "profession" =>  $request->beneficiaire2_profession,
        "employeur" =>  $request->beneficiaire2_employeur,
        "taux" =>  $request->beneficiaire2_taux,
      ];

      $r_benef3 = [
        "ajaxTelephone" => $request->beneficiaire3ajaxTelephone,
        "type" =>  $request->beneficiaire3_type,
        "nom" =>  $request->beneficiaire3_nom,
        "prenom" =>  $request->beneficiaire3_prenom,
        "date_naissance" =>  $request->beneficiaire3_date_naissance,
        "sexe" =>  $request->beneficiaire3_sexe,
        "situation_matrimoniale" =>  $request->beneficiaire3_situation_matrimoniale,
        "telephone" =>  $request->beneficiaire3_telephone,
        "email" =>  $request->beneficiaire3_email,
        "adresse" =>  $request->beneficiaire3_adresse,
        "ifu" =>  $request->beneficiaire3_ifu,
        "profession" =>  $request->beneficiaire3_profession,
        "employeur" =>  $request->beneficiaire3_employeur,
        "taux" =>  $request->beneficiaire3_taux,
      ];

      $r_benef4 = [
        "ajaxTelephone" => $request->beneficiaire4ajaxTelephone,
        "type" =>  $request->beneficiaire4_type,
        "nom" =>  $request->beneficiaire4_nom,
        "prenom" =>  $request->beneficiaire4_prenom,
        "date_naissance" =>  $request->beneficiaire4_date_naissance,
        "sexe" =>  $request->beneficiaire4_sexe,
        "situation_matrimoniale" =>  $request->beneficiaire4_situation_matrimoniale,
        "telephone" =>  $request->beneficiaire4_telephone,
        "email" =>  $request->beneficiaire4_email,
        "adresse" =>  $request->beneficiaire4_adresse,
        "ifu" =>  $request->beneficiaire4_ifu,
        "profession" =>  $request->beneficiaire4_profession,
        "employeur" =>  $request->beneficiaire4_employeur,
        "taux" =>  $request->beneficiaire4_taux,
      ];

      $r_benef5 = [
        "ajaxTelephone" => $request->beneficiaire5ajaxTelephone,
        "type" =>  $request->beneficiaire5_type,
        "nom" =>  $request->beneficiaire5_nom,
        "prenom" =>  $request->beneficiaire5_prenom,
        "date_naissance" =>  $request->beneficiaire5_date_naissance,
        "sexe" =>  $request->beneficiaire5_sexe,
        "situation_matrimoniale" =>  $request->beneficiaire5_situation_matrimoniale,
        "telephone" =>  $request->beneficiaire5_telephone,
        "email" =>  $request->beneficiaire5_email,
        "adresse" =>  $request->beneficiaire5_adresse,
        "ifu" =>  $request->beneficiaire5_ifu,
        "profession" =>  $request->beneficiaire5_profession,
        "employeur" =>  $request->beneficiaire5_employeur,
        "taux" =>  $request->beneficiaire5_taux,
      ];

      $user_client = $contrat->client->users->first();
      $assure = $contrat->assure;

      $user_benef1 = "";
      if ($r_benef1['type'] == "beneficiaire1_clients") {
        $user_benef1 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $user_client->telephone, "Bénéficiaire 1");
        $beneficiaire1 = Beneficiaire::create(['taux' => $request->beneficiaire1_taux]);
        $beneficiaire1->users()->save($user_client)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire1->id]);
      } elseif ($r_benef1['type'] == "beneficiaire1_newuser") {
        $this->checkTelephone($r_benef1['telephone'], 'beneficiaire1');
        $this->checkEmail($r_benef1['email'], 'beneficiaire1');

        //creer un nouvel utilisateur
        $user_benef1 = new User([
          "nom"               => $request->beneficiaire1_nom,
          "prenom"            => $request->beneficiaire1_prenom,
          "date_naissance"    => $request->beneficiaire1_date_naissance,
          "sexe"              => $request->beneficiaire1_sexe,
          "situation_matrimoniale"   => $request->beneficiaire1_situation_matrimoniale,
          "telephone"         => $request->beneficiaire1_telephone,
          "email"             => $request->beneficiaire1_email,
          "adresse"           => $request->beneficiaire1_adresse,
          "ifu"               => $request->beneficiaire1_ifu,
          'password'          => bcrypt($password),
          'commune_id'        => Auth::user()->commune->id,
          'profession'        => $request->beneficiaire1_profession,
          'employeur'         => $request->beneficiaire1_employeur,
        ]);
        $beneficiaire1 = Beneficiaire::create(['taux' => $request->beneficiaire1_taux]);
        $beneficiaire1->users()->save($user_benef1)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire1->id]);
      } elseif ($r_benef1['type'] == "beneficiaire1_olduser") { // pour utiliser un ancien user
        //selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef1 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef1['ajaxTelephone'], "Bénéficiaire 1");
        #dd([$user_benef1, $r_benef1['ajaxTelephone'] ]);
        if ($user_benef1 == False) {
          return redirect()->back();
        }
        $beneficiaire1 = Beneficiaire::create(['taux'    => $request->beneficiaire1_taux]);
        $beneficiaire1->users()->save($user_benef1)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire1->id]);
      }


      $user_benef2 = "";
      if ($r_benef2['type'] == "beneficiaire2_newuser") {

        $this->checkTelephone($r_benef2['telephone'], 'beneficiaire2');
        $this->checkEmail($r_benef2['email'], 'beneficiaire2');

        //creer un nouvel utilisateur
        $user_benef2 = new User([
          "nom"               => $request->beneficiaire2_nom,
          "prenom"            => $request->beneficiaire2_prenom,
          "date_naissance"    => $request->beneficiaire2_date_naissance,
          "sexe"              => $request->beneficiaire2_sexe,
          "situation_matrimoniale"   => $request->beneficiaire2_situation_matrimoniale,
          "telephone"         => $request->beneficiaire2_telephone,
          "email"             => $request->beneficiaire2_email,
          "adresse"           => $request->beneficiaire2_adresse,
          "ifu"               => $request->beneficiaire2_ifu,
          'password'          => bcrypt($password),
          'commune_id'        => Auth::user()->commune->id,
          'profession'        => $request->beneficiaire2_profession,
          'employeur'         => $request->beneficiaire2_employeur,
        ]);
        $beneficiaire2 = Beneficiaire::create(['taux'    => $request->beneficiaire2_taux]);
        $beneficiaire2->users()->save($user_benef2)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire2->id]);
      } elseif ($r_benef2['type'] == "beneficiaire2_olduser") { // pour utiliser un ancien user
        // selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef2 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef2['ajaxTelephone'], "Bénéficiaire 2");
        if ($user_benef2 == False) {
          return redirect()->back();
        }
        $beneficiaire2 = Beneficiaire::create(['taux'    => $request->beneficiaire2_taux]);
        $beneficiaire2->users()->save($user_benef2)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire2->id]);
      }

      $user_benef3 = "";
      if ($r_benef3['type'] == "beneficiaire3_newuser") {

        $this->checkTelephone($r_benef3['telephone'], 'beneficiaire3');
        $this->checkEmail($r_benef3['email'], 'beneficiaire3');

        //creer un nouvel utilisateur
        $user_benef3 = new User([
          "nom"               => $request->beneficiaire3_nom,
          "prenom"            => $request->beneficiaire3_prenom,
          "date_naissance"    => $request->beneficiaire3_date_naissance,
          "sexe"              => $request->beneficiaire3_sexe,
          "situation_matrimoniale"   => $request->beneficiaire3_situation_matrimoniale,
          "telephone"         => $request->beneficiaire3_telephone,
          "email"             => $request->beneficiaire3_email,
          "adresse"           => $request->beneficiaire3_adresse,
          "ifu"               => $request->beneficiaire3_ifu,
          'password'          => bcrypt($password),
          'commune_id'        => Auth::user()->commune->id,
          'profession'        => $request->beneficiaire3_profession,
          'employeur'         => $request->beneficiaire3_employeur,
        ]);
        $beneficiaire3 = Beneficiaire::create(['taux'    => $request->beneficiaire3_taux]);
        $beneficiaire3->users()->save($user_benef3)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire3->id]);
      } elseif ($r_benef3['type'] == "beneficiaire3_olduser") { // pour utiliser un ancien user
        //selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef3 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef3['ajaxTelephone'], "Bénéficiaire 3");
        if ($user_benef3 == False) {
          return redirect()->back();
        }
        $beneficiaire3 = Beneficiaire::create(['taux'    => $request->beneficiaire3_taux]);
        $beneficiaire3->users()->save($user_benef3)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire3->id]);
      }

      $user_benef4 = "";
      if ($r_benef4['type'] == "beneficiaire4_newuser") {

        $this->checkTelephone($r_benef4['telephone'], 'beneficiaire4');
        $this->checkEmail($r_benef4['email'], 'beneficiaire4');

        //creer un nouvel utilisateur
        $user_benef4 = new User([
          "nom"               => $request->beneficiaire4_nom,
          "prenom"            => $request->beneficiaire4_prenom,
          "date_naissance"    => $request->beneficiaire4_date_naissance,
          "sexe"              => $request->beneficiaire4_sexe,
          "situation_matrimoniale"   => $request->beneficiaire4_situation_matrimoniale,
          "telephone"         => $request->beneficiaire4_telephone,
          "email"             => $request->beneficiaire4_email,
          "adresse"           => $request->beneficiaire4_adresse,
          "ifu"               => $request->beneficiaire4_ifu,
          'password'          => bcrypt($password),
          'commune_id'        => Auth::user()->commune->id,
          'profession'        => $request->beneficiaire4_profession,
          'employeur'         => $request->beneficiaire4_employeur,
        ]);
        $beneficiaire4 = Beneficiaire::create(['taux'    => $request->beneficiaire4_taux]);
        $beneficiaire4->users()->save($user_benef4)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire4->id]);
      } elseif ($r_benef4['type'] == "beneficiaire4_olduser") { // pour utiliser un ancien user
        //selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef4 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef4['ajaxTelephone'], "Bénéficiaire 4");
        if ($user_benef4 == False) {
          return redirect()->back();
        }
        $beneficiaire4 = Beneficiaire::create(['taux'    => $request->beneficiaire4_taux]);
        $beneficiaire4->users()->save($user_benef4)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire4->id]);
      }

      $user_benef5 = "";
      if ($r_benef5['type'] == "beneficiaire5_newuser") {

        $this->checkTelephone($r_benef5['telephone'], 'beneficiaire5');
        $this->checkEmail($r_benef5['email'], 'beneficiaire5');

        //creer un nouvel utilisateur
        $user_benef5 = new User([
          "nom"               => $request->beneficiaire5_nom,
          "prenom"            => $request->beneficiaire5_prenom,
          "date_naissance"    => $request->beneficiaire5_date_naissance,
          "sexe"              => $request->beneficiaire5_sexe,
          "situation_matrimoniale"   => $request->beneficiaire5_situation_matrimoniale,
          "telephone"         => $request->beneficiaire5_telephone,
          "email"             => $request->beneficiaire5_email,
          "adresse"           => $request->beneficiaire5_adresse,
          "ifu"               => $request->beneficiaire5_ifu,
          'password'          => bcrypt($password),
          'commune_id'        => Auth::user()->commune->id,
          'profession'        => $request->beneficiaire5_profession,
          'employeur'         => $request->beneficiaire5_employeur,
        ]);
        $beneficiaire5 = Beneficiaire::create(['taux'    => $request->beneficiaire5_taux]);
        $beneficiaire5->users()->save($user_benef5)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire5->id]);
      } elseif ($r_benef5['type'] == "beneficiaire5_olduser") { // pour utiliser un ancien user
        //selectionner l'utilisateur et envoyer message en cas d'erreur
        $user_benef5 = $this->checkIfBeneficiaireNotAlreadyAssure($contrat, $r_benef5['ajaxTelephone'], "Bénéficiaire 5");
        if ($user_benef5 == False) {
          return redirect()->back();
        }
        $beneficiaire5 = Beneficiaire::create(['taux'    => $request->beneficiaire5_taux]);
        $beneficiaire5->users()->save($user_benef5)->assignRole('Beneficiaire');
        $contrat->beneficiaires()->syncWithoutDetaching([$beneficiaire5->id]);
      }
    }
    $contrat = $contrat->reference;
    return redirect()->route('contrats.show', compact(['contrat']));
  }


  public function all()
  {
    $contrats = Contrat::with('souscriptions', 'souscriptions.primes', 'client', 'assure', 'client.users', 'assure.users', 'marchands.users')->get();
    $statuts = StatutSouscription::all();
    return view('dash.contrats.all2', compact([
      'contrats', 'statuts'
    ]));
  }

  // public function all()
  // {
  //   $moisactuel = Carbon::now()->month;
  //   $contratstous = Contrat::paginate(100);
  //   $contratsAttente = Contrat::all()->load('souscriptions')->where('statut', "Attente de traitement");
  //   $contratsPaiement = Contrat::all()->load('souscriptions')->where('statut', "Attente de paiement");
  //   $contratsValide = Contrat::all()->load('souscriptions')->where('statut', "Valide");
  //   $contratsRejete = Contrat::all()->load('souscriptions')->where('statut', "Rejeté");
  //   $contratsSinistre = Contrat::all()->load('souscriptions')->where('statut', "Sinistre");
  //   $contratsTermine = Contrat::all()->load('souscriptions')->where('statut', "Terminé");
  //   //     dd(Contrat::with('souscriptions', 'souscriptions.primes', 'client', 'assure', 'marchands')->get());

  //   // $c = contrat::where('reference', '46L6N8671')->first();
  //   // $data = [
  //   //     'contrat_id' => $c->id,
  //   //     'assure_id' => $c->assure->users->first()->id,
  //   //     'client_id' => $c->client->users->first(),
  //   //     'marchand_id' => $c->marchands->first()->users->first(),
  //   // ];
  //   // dd($data);
  //   // //46L6N8671 reference posant probleme

  //   // foreach($contratstous as $c){
  //   //     if($c->assure->users->first()){
  //   //         #dump($c->assure->users->first()->full_name);
  //   //         #sleep(1);
  //   //     }else{
  //   //         echo $c->reference;
  //   //         $data = [
  //   //             'contrat_id' => $c->id,
  //   //             'assure_id' => $c->assure,
  //   //             'client_id' => $c->client->users->first(),
  //   //             'marchand_id' => $c->marchands->first()->users->first(),
  //   //         ];
  //   //         dd($data);
  //   //     }
  //   // }

  //   //$contratsAttente = $contratsPaiement = $contratsValide = $contratsRejete = $contratsSinistre = $contratsTermine = collect([]);

  //   //dd($contratstous , $contratsAttente , $contratsPaiement , $contratsValide , $contratsRejete , $contratsSinistre , $contratsTermine);

  //   return view('dash.contrats.all', compact([
  //     'contratsAttente', 'contratsValide', 'contratsRejete', 'contratsPaiement',
  //     'contratsSinistre', 'contratsTermine', 'moisactuel', 'contratstous'
  //   ]));
  // }

  public function etatContrat()
  {
    $contrats = $this->custom_paginate(Contrat::all()->load('souscriptions')->where('statut', "Valide"));
    return view('dash.contrats.contrat', compact(['contrats']));
  }

  public function mescontrats()
  {
    $user = Auth::user();
    $contrats = "";
    $moisactuel = Carbon::now()->month;

    if ($user->hasAnyRole([config('custom.roles.marchand')])) {
      $contrats = $user->marchand->first()->contrats;
    } elseif ($user->hasAnyRole([config('custom.roles.client')])) {
      $contrats = $user->client->first()->contrats;
      foreach ($contrats as $c) {
        if ($c->souscriptions->last()->retardEnJours) {
          toastr()->warning('Payer vos primes, ne perdez pas votre souscription', 'Notification de retard');
          break;
        }
      }
    }
    return view('dash.contrats.index', compact(['contrats', 'moisactuel']));
  }

  public function enattente()
  {
    $moisactuel = Carbon::now()->month;
    $contrats = Contrat::all()->load('souscriptions')->where('statut', 'Attente de traitement');
    return view('dash.contrats.enattente', compact(['contrats', 'moisactuel']));
  }


  public function enattentepaiement()
  {
    $moisactuel = Carbon::now()->month;
    $contrats = Contrat::all()->load('souscriptions')->where('statut', "Attente de paiement");
    return view('dash.contrats.enattente', compact(['contrats', 'moisactuel']));
  }


  public function show($contrat)
  {
    $reference_fournie = $contrat;
    $contrat = Contrat::where('reference', $contrat)->first();
    if ($contrat) {
      #dd($contrat->souscriptions->last()->statut_souscriptions);
      if ($contrat->beneficiaires->count() == 0) {
        toastr()->warning('Veuillez <b>ajouter des bénéficiaires</b> à ce contrat pour continuer.', 'Avertissement');
      }
      return view('dash.contrats.show', compact(['contrat']));
    } else {
      toastr()->warning('Nous ne retouvons pas ce contrat. Référence: ' . $reference_fournie, 'Avertissement');
      return redirect()->route('dash.index');
    }
  }

  public function validerContrat(Contrat $contrat)
  {
    $contrat->souscriptions->last()->update(['statut' => "Valide", 'date_effet' => Carbon::now()->format('Y-m-d')]);
    $statut = StatutSouscription::whereLabel('Valide')->get();
    $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => Auth::id(), 'motif' => ""]);
    toastr()->success('Contrat valide avec succès.', 'success');
    $contrat_client = $contrat->client->users()->first();
    $this->sendSMS('Votre contrat:' . $contrat->reference . ' a bien été valide dans EHWLINMI ASSURANCE. Vous pouvez desormais payer vos primes. EHWHLINMI Vous remercie.', $contrat_client);
    return back();
  }

  public function rejeterContrat(Contrat $contrat)
  {
    $contrat->souscriptions->last()->update(['statut' => "Rejeté"]);
    $statut = StatutSouscription::whereLabel('Rejeté')->get();
    $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => Auth::id(), 'motif' => ""]);
    $contrat_client_user = $contrat->client->users()->first();
    $this->sendSMS('Votre contrat:' . $contrat->reference . ' a été rejeté dans EHWLINMI ASSURANCE.', $contrat_client_user);

    $data = [
      "reference"     => $contrat->reference,
      "id"            => $contrat->id,
      "client"        => $contrat->client->users()->first()->fullName,
      "assure"        => $contrat->assure->users()->first()->fullName,
      "marchand"      => $contrat->marchand->users()->first()->fullName,
      "rejete_par"   => auth()->user()->fullName,
    ];

    Mail::to("contact.ehwhlinmi@legroupemms.com")->send(new ContratRejeteToAdminMail($data));

    toastr()->success('Contrat rejeté avec succès.', 'success');
    return back();
  }

  public function mescontrats2()
  {
    $user = Auth::user();
    foreach ($user->client as $value) {
      $contrats = Contrat::where('client_id', $value->id)->get();
    }
    return view('dash.contrats.index', compact(['contrats']));
  }

  public function checkIfReferenceExist(Request $request)
  {
    if ($request->ajax()) {
      $assure = "";
      $reference = $request->reference;
      $contrat = Contrat::where('reference', '=', $reference)->first();
      if ($contrat) {
        $assure = $contrat->assure->users()->first()->fullname;
      }
      return response()->json(['contrat' => $contrat, 'assure' => $assure], 200);
    }
  }

  public function getContratByTelephone2($telephone)
  {
    $contrats = [];
    $telephone = "none";
    $user = User::where('telephone', '=', $telephone)->first();
    if ($user) {
      $client = $user->client->first();
      if ($user->hasAnyRole([config('custom.roles.direction')])) {
        $user = False;
      } elseif ($client) {
        foreach ($client->contrats as $c) {
          if (!in_array($c->souscriptions->last()->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Résilié', 'Supprimé', 'Annulé', 'Terminé'], true)) {
            array_push($contrats, [
              "reference" => $c->reference,
              "assure" => $c->assure->users->first()->shortFullName,
              "primes" => 12 - $c->souscriptions->last()->primes->count()
            ]);
          }
        }
      }
    }
    return response()->json(['contrats' => $contrats], 200);
  }


  public function getContratByTelephone(Request $request)
  {
    #return response()->json(['user' => true, 'contrats' => true], 200);
    if ($request->ajax()) {
      $contrats = [];
      $telephone = $request->telephone;
      $user = User::where('telephone', '=', $telephone)->first();
      if ($user) {
        $client = $user->client->first();
        if ($user->hasAnyRole([config('custom.roles.direction')])) {
          $user = False;
        } elseif ($client) {
          foreach ($client->contrats as $c) {
            if (!in_array($c->souscriptions->last()->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Résilié', 'Supprimé', 'Annulé', 'Terminé'], true)) {
              array_push($contrats, [
                "reference" => $c->reference,
                "assure" => $c->assure->users->first()->shortFullName,
                "primes" => 12 - $c->souscriptions->last()->primes->count()
              ]);
            }
          }
        }
      }
      return response()->json(['user' => $user, 'contrats' => $contrats], 200);
    }
  }

  public function resilier(Request $request)
  {
    $contrat = Contrat::findOrFail($request->contrat_id);
    $user = Auth::user();
    $data = [
      "contrat_id" => $contrat->id,
      "reference" => $contrat->reference,
      "user" => $user->full_name . " - " . $user->telephone,
      "motif" => $request->motif,
    ];
    $clients = Collect([$contrat->marchands->last()->users()->first(), $contrat->client->users()->first()])->filter(function ($value, $key) {
      return $value->email != null;
    })->pluck('email');
    $admins = User::role([config('custom.roles.direction_FC'), config('custom.roles.direction_C'), config('custom.roles.direction_ARH')])->get()->filter(function ($value, $key) {
      return $value->email != null;
    })->pluck('email');

    if ($user->hasAnyRole([config('custom.roles.direction') . '|' . config('custom.roles.direction_C') . '|' . config('custom.roles.ITMMS')])) {
      // $date = null;
      // if ($contrat->premiere_prime) {
      //   $date = $contrat->created_at;
      // } else {
      //   $date = $contrat->created_at;
      // }
      // $created_at = Carbon::parse($date);
      // $now = Carbon::now();
      // $diff_jours = $created_at->diffInDays($now);

      // $sauter_restriction = true;
      // if ($diff_jours >= 30 || $sauter_restriction == true) {
      if ($contrat->statut !== "Résilié") {
        $statut = StatutSouscription::whereLabel('Résilié')->first();
        $contrat->souscriptions->last()->update(['statut' => $statut->label]);
        $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $user->id, 'motif' => $request->motif]);
        toastr()->success('Contrat résilié avec succès.', 'success');
      } else {
        toastr()->success('Contrat non résilié.', 'success');
      }

      // recuperation des sous
      // $recolted = 0;
      // if ($this->primes->count() >= 3) {
      //   foreach ($this->primes as $key => $p) {
      //     # recuperer toutes les commissions et les transferer vers ...
      //     # recuperer les utilisateurs concernés par la prime
      //     # $first->forceTransfer($last, 500);
      //   }
      // } else {
      //   return null;
      // }

      Notification::route('mail', $clients)->notify(new ResilierContratNotificationClient($data));
      Notification::route('mail', $admins)->notify(new ResilierContratNotificationAdmin($data));
    } elseif ($user->hasAnyRole([config('custom.roles.client') . '|' . config('custom.roles.marchand') . '|' . config('custom.roles.smarchand')])) {
      Notification::route('mail', $clients)->notify(new DemandeResiliationNotificationClient($data));
      Notification::route('mail', $admins)->notify(new DemandeResiliationNotificationAdmin($data));
    }
    return back();
  }


  public function annuler(Request $request)
  {
    $contrat = Contrat::findOrFail($request->contrat_id);
    $user = Auth::user();
    $data = [
      "contrat_id" => $contrat->id,
      "reference" => $contrat->reference,
      "user" => $user->full_name . " - " . $user->telephone,
      "motif" => $request->motif,
    ];
    $clients = Collect([$contrat->marchands->last()->users()->first(), $contrat->client->users()->first()])->filter(function ($value, $key) {
      return $value->email != null;
    })->pluck('email');
    $admins = User::role([config('custom.roles.direction_FC'), config('custom.roles.direction_C'), config('custom.roles.direction_ARH')])->get()->filter(function ($value, $key) {
      return $value->email != null;
    })->pluck('email');

    if ($user->hasAnyRole([config('custom.roles.direction') . '|' . config('custom.roles.direction_C') . '|' . config('custom.roles.ITMMS')])) {

      if ($contrat->statut !== "Annulé") {
        $statut = StatutSouscription::whereLabel('Annulé')->first();
        $contrat->souscriptions->last()->update(['statut' => $statut->label]);
        $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $user->id, 'motif' => $request->motif]);
        toastr()->success('Contrat Annulé avec succès.', 'success');
      } else {
        toastr()->success('Contrat non Annulé.', 'success');
      }

      Notification::route('mail', $clients)->notify(new AnnulerContratNotificationClient($data));
      Notification::route('mail', $admins)->notify(new AnnulerContratNotificationAdmin($data));
    } elseif ($user->hasAnyRole([config('custom.roles.marchand') . '|' . config('custom.roles.smarchand')])) {
      Notification::route('mail', $clients)->notify(new DemandeAnnulationNotificationClient($data));
      Notification::route('mail', $admins)->notify(new DemandeAnnulationNotificationAdmin($data));
    }
    return back();
  }

  public function destroy(Contrat $contrat)
  {
    if ($contrat->delectable) {
      // related data
      // // assures Si le user n'a qu'un profil (assuré), les supprimer aussi
      if ($contrat->assure->users->first()->roles->count() == 1 && $contrat->assure->users->first()->roles->first()->name == "Assuré") {
        $contrat->assure->users()->delete();
        $contrat->assure->delete();
      }

      // contrat_marchand détacher tous les marchands de ce contrat
      // marchands //ignorer le marchand
      // $contrat->marchands()->detach()

      // contrat_beneficiaire  détacher tous les marchands de ce contrat
      // beneficiaires supprimer les beneficiaire qui sont liés uniquement a ce contrat
      // tickets supprimer tous les tickets
      // souscriptions supprimer laz sousctiptntion relative a ce contrat
      // primes //supprimer les primes relatives a la souscription

      // dd($contrat);
      $contrat->delete();

      Session::flash('sucess', 'Contrat supprimé.');
    } else {
      Session::flash('warning', 'Contrat non supprimé.');
    }
    return redirect()->route('dash.index');
  }
}
