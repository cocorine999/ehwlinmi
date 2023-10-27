<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Session;
use App\User;
use App\Models\Commune;
use App\Models\Contrat;
use App\Models\Marchand;
use Illuminate\Http\Request;
use App\Models\SuperMarchand;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{
  public function index()
  {
    $users = User::all();
    $directions = User::role(config('custom.roles.direction_all_cs'))->get();
    $supermarchands = User::role(config('custom.roles.smarchand'))->get();
    $marchands = User::role(config('custom.roles.marchand'))->get();
    $clients = User::role(config('custom.roles.client'))->get();
    $assures = User::role(config('custom.roles.assure'))->get();
    $beneficiaires = User::role(config('custom.roles.beneficiaire'))->get();
    $nsia = User::role(config('custom.roles.nsia_all_cs'))->get();
    return view('dash.users.index', compact(['users', 'directions', 'supermarchands', 'marchands', 'clients', 'assures', 'beneficiaires', 'nsia']));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $communes = Auth::user()->commune->departement->communes;
    $roles = "";
    if (Auth::user()->hasRole(['Direction', 'Direction_ARH', 'Direction_C', 'Direction_FC', 'Direction_MAC', 'ITMMS'])) {
      $roles = Role::whereIn('name', ['SuperMarchand'])->get();
      $communes = Commune::all();
    } else if (Auth::user()->hasRole(config('custom.roles.smarchand'))) {
      $roles = Role::where('name', config('custom.roles.marchand'))->get();
    }
    return view('dash.users.create', compact(['roles', 'communes']));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'nom'        => 'required',
      'prenom'     => 'required',
      'telephone'    => 'required|unique:users',
      'email'    => 'nullable|unique:users',
      'adresse'    => 'required',
      'commune_id'    => 'required',
    ]);

    $password = "";
    if (config('app.use_generated_pass') == 1) {
      $password = (string) rand(1000, 9999);
    } else {
      $password = "1234";
    }

    $user = new User([
      'nom'                => $request->nom,
      'prenom'             => $request->prenom,
      'email'              => $request->email,
      'telephone'          => $request->telephone,
      'ifu'                => $request->ifu,
      'sexe'               => $request->sexe,
      'date_naissance'     => $request->date_naissance,
      'situation_matrimoniale'  => $request->situation_matrimoniale,
      'adresse'            => $request->adresse,
      'password'           => bcrypt($password),
      'commune_id'         => $request->commune_id,
      "profession"         => $request->profession,
      "employeur"          => $request->employeur,
    ]);

    $nextRoute = 'dash.index';

    $super_marchand_role_id = (string) Role::findByName(config('custom.roles.smarchand'))->id;
    $marchand_role_id = (string) Role::findByName(config('custom.roles.marchand'))->id;

    switch ($request->role_id) {
      case $super_marchand_role_id: //SuperMarchand

        $super_marchand = SuperMarchand::create([
          'entreprise'    => $request->entreprise,
          'registre'      => $request->registre,
          'personne'      => $request->typepersonne,
          'direction_id'  => Auth::user()->direction()->first()->id,
        ]);

        $super_marchand->users()->save($user)->assignRole(config('custom.roles.smarchand'));

        $ref = $super_marchand->id . "" . $super_marchand->users->first()->commune->departement->code;
        $super_marchand->update(['reference' => $ref]);

        $nextRoute = 'utilisateurs.index';
        $this->sendSMS('Votre compte SuperMarchand est cree. Login : votre numero, mot de passe : ' . $password, $super_marchand->users->first());
        break;

      case $marchand_role_id: //Marchand
        $marchand = Marchand::create([
          'entreprise'    => $request->entreprise,
          'registre'      => $request->registre,
          'personne'      => $request->typepersonne,
        ]);
        $marchand->users()->save($user)->assignRole(config('custom.roles.marchand'));
        $marchand->super_marchands()->attach([Auth::user()->super_marchand->first()->id]);

        $ref = $marchand->actual_super_marchands->first()->reference . "" . $marchand->id;
        $marchand->update(['reference' => $ref]);

        $nextRoute = 'marchands.mesmarchands';
        $this->sendSMS('Votre compte Marchand est cree. Login : votre numero, mot de passe : ' . $password, $marchand->users->first());
        break;

      default:
        toastr()->error('Veuillez choisir un role correct.');
        $nextRoute = 'utilisateurs.create';
        break;
    }

    $this->createUserWallets($user);
    toastr()->success('Utilisateur ' . $user->nom . ' créé avec succès.', 'Succès');
    return redirect()->route($nextRoute);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = Auth::user();
    return view('dash.users.profil', compact(['user']));
  }

  public function transferall($id)
  {
    $user = User::findOrFail($id);
    $marchands = User::role(config('custom.roles.marchand'))->get();
    return view('dash.users.transferall', compact(['user', 'marchands']));
  }

  public function applyTransfer(Request $request)
  {
    $actual_marchand = User::findOrFail($request->actual_marchand);
    $new_marchand = User::findOrFail($request->new_marchand)->marchand->first();

    // dump($actual_marchand->marchand->last()->active_contrats);
    // dump(User::findOrFail($request->new_marchand)->marchand->first());
    // dd($new_marchand->active_contrats);

    #$user->roles()->updateExistingPivot($roleId, $attributes);


    foreach ($actual_marchand->marchand->first()->active_contrats as $key => $c) {
      // Annule toutes les autres relations
      $c->marchands()
        ->newPivotStatement()
        ->where('contrat_id', '=', $c->id)
        ->update(['active' => 0]);

      // Ajoute la nouvelle relation
      $c->marchands()->attach(
        $new_marchand,
        #['active' => 1]
      );
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(User $utilisateur)
  {
    $roles = "";
    $communes = Commune::with('departement')->get();
    if (Auth::user()->hasRole(config('custom.roles.direction'))) {
      $roles = Role::where('name', config('custom.roles.smarchand'))->get();
    } else if (Auth::user()->hasRole(config('custom.roles.smarchand'))) {
      $roles = Role::where('name', config('custom.roles.marchand'))->get();
    }
    return view('dash.users.edit')->with(['user' => $utilisateur, 'roles' => $roles, 'communes' => $communes]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $user)
  {

    $user = User::find($user);

    $user->nom = $request->nom;
    $user->prenom = $request->prenom;
    $user->email = $request->email;
    $user->telephone = $request->telephone;
    $user->ifu = $request->ifu;
    $user->sexe = $request->sexe;
    $user->date_naissance = $request->date_naissance;
    $user->situation_matrimoniale = $request->situation_matrimoniale;
    $user->adresse = $request->adresse;
    $user->commune_id = $request->commune_id;

    $nextRoute = 'dash.index';
    switch ($request->role_id) {
      case '2': //SuperMarchand

        $super_marchand = SuperMarchand::find($user->id);
        $super_marchand->entreprise    = $request->entreprise;
        $super_marchand->registre      = $request->registre;
        $super_marchand->personne      = $request->typepersonne;
        $super_marchand->direction_id  = Auth::user()->direction()->first()->id;

        $super_marchand->users()->save($user)->assignRole('SuperMarchand');
        #$nextRoute = 'supermarchands.messupermarchands';
        $nextRoute = 'utilisateurs.index';
        //$this->sendSMS('Votre compte SuperMarchand est cree. Login : votre numero, mot de passe : '.$password, $request->telephone);
        break;

      case '3': //Marchand
        $marchand = Marchand::find($user->id);
        $marchand->entreprise    = $request->entreprise;
        $marchand->registre      = $request->registre;
        $marchand->personne      = $request->typepersonne;
        $marchand->super_marchand_id  = Auth::user()->super_marchand()->first()->id;

        $marchand->users()->save($user)->assignRole('Marchand');

        $nextRoute = 'marchands.mesmarchands';
        //$this->sendSMS('Votre compte Marchand est cree. Login : votre numero, mot de passe : '.$password, $request->telephone);
        break;

      default:
        $user->save();
        $role = Role::find($request->role_id);

        break;
    }
    toastr()->success('Utilisateur ' . $user->nom . ' modifié avec succès.', 'Succès');
    return redirect()->route($nextRoute);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    dd($user->super_marchand);
    $can_delete = false;

    foreach ($user->roles as $key => $r) {
      if (in_array($r, ['Direction_ARH', 'Direction_C', 'Direction_FC', 'Direction_MAC', 'ITMMS', 'Nsia', 'Nsia1', 'Nsia2', 'ITNSIA',])) {
        $user->roles()->detach();
        $can_delete = true;
      } elseif ($r === 'SuperMarchand') {
        if (condition) {
          $user->roles()->detach();
          $can_delete = true;
        }
      } elseif ($r === 'Marchand') {  // si il a des contrats ne pas supprimer
        if (condition) {
          $user->roles()->detach();
          $can_delete = true;
        }
      } elseif ($r === 'Client') {  // si il a un contrat ne pas supprimer
        if (condition) {
          $user->roles()->detach();
          $can_delete = true;
        }
      } elseif ($r === 'Assuré') {  // si il a un contrat ne pas supprimer
        if (condition) {
          $user->roles()->detach();
          $can_delete = true;
        }
      } elseif ($r === 'Bénéficiaire') {  // si il a un contrat ne pas supprimer
        if (condition) {
          $user->roles()->detach();
          $can_delete = true;
        }
      }
    }

    $can_delete = false;
    if ($can_delete) {
      $user->delete();
      Session::flash('sucess', 'Utilisateur supprimé.');
    } else {
      Session::flash('warning', 'Utilisateur non supprimé.');
    }

    return redirect()->route('users.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function profil(User $user)
  {
    $user = Auth::user();
    $marchands = "";

    $clientActif = User::where('actif', true)->get()->count();
    $supermarchand = User::role(config('custom.roles.smarchand'))->get()->count();
    $marchand = User::role(config('custom.roles.marchand'))->get()->count();
    //dd($user->getRoleNames()[0]);
    if ($user->getRoleNames()[0] == "SuperMarchand") {
      $marchands = $user->super_marchand->first()->marchands->count();
    }
    $contratsClient = $user->client->count();
    $contratsMarchand = $user->marchand->count();
    $contratsAssure = $user->assure->count();
    $nbreBeneficiaire = $user->beneficiaire->count();


    return view('dash.users.profil', compact([
      'user', 'clientActif', 'supermarchand', 'marchand', 'contratsClient',
      'contratsMarchand', 'contratsAssure', 'nbreBeneficiaire', 'marchands'
    ]));
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function profildirection(User $user)
  {
    //dd($user);
    //$user = Auth::user();
    $marchands = "";
    $clientActif = "";
    if ($user->getRoleNames()[0] == "Direction") {
      $clientActif = User::where('actif', true)->get()->count();
    }
    $supermarchand = User::role(config('custom.roles.smarchand'))->get()->count();
    $marchand = User::role(config('custom.roles.marchand'))->get()->count();
    //dd($user->getRoleNames()[0]);
    if ($user->getRoleNames()[0] == "SuperMarchand") {
      $marchands = $user->super_marchand->first()->marchands->count();
    }
    $contratsClient = $user->client->count();
    $contratsMarchand = $user->marchand->count();
    $contratsAssure = $user->assure->count();
    $nbreBeneficiaire = $user->beneficiaire->count();


    return view('dash.users.profil', compact([
      'user', 'clientActif', 'supermarchand', 'marchand', 'contratsClient',
      'contratsMarchand', 'contratsAssure', 'nbreBeneficiaire', 'marchands'
    ]));
  }
  public function changePass(Request $request)
  {

    $user = User::findOrFail(Auth::id());

    if (!Hash::check($request->oldPassword, $user->password)) {
      toastr()->success('Votre ancien mot de passe n\'est pas correct.', 'warning');

      return redirect()->route('utilisateurs.profil');
    } else

            if ($request->newPassword != $request->confirmPassword) {
      toastr()->success('Erreur de confirmation du nouveau mot de passe.', 'warning');
      return redirect()->route('utilisateurs.profil');
    } else {
      $user->password = bcrypt($request->newPassword);
      $user->update();
      toastr()->success('Votre mot de passe a été modifié avec succès.', 'success');
      return redirect()->route('utilisateurs.profil');
    }
  }

  public function status(Request $request)
  {
    $user = User::find($request->user_id);
    if ($user) {
      if ($user->banned_until) {
        $user->update(['banned_until' => null]);
        toastr()->success('Utilisateur activé.', 'Succès');
      } else {
        $user->update(['banned_until' => Carbon::now()->addYears(10)]);
        toastr()->success('Utilisateur désactivé.', 'Succès');
      }
    } else {
      toastr()->error('Utilisateur non trouvé', 'Erreur');
    }
    return back();
  }

  public function checkIfEmailExist(Request $request)
  {
    if ($request->ajax()) {
      $email = $request->email;
      $user = User::where('email', '=', $email)->first();
      if ($user) {
        if ($user->hasAnyRole([config('custom.roles.working_users_cs')])) {
          if ($request->include_working_user == true) {
            $user = False;
          }
        }
      }
      return response()->json(['user' => $user], 200);
    }
  }

  public function checkIfTelephoneExist(Request $request)
  {
    if ($request->ajax()) {
      $telephone = $request->telephone;
      $user = User::where('telephone', '=', $telephone)->first();
      if ($user) {
        if ($request->check_to_block == false) {
          $user = True;
        } else {
          if ($user->hasAnyRole([config('custom.roles.working_users_cs')])) {
            $user = False;
          }
        }
      }
      return response()->json(['user' => $user], 200);
    }
  }

  public function checkIfTelephoneExist2(Request $request)
  {
    if ($request->ajax()) {
      $telephone = $request->telephone;
      $user = User::where('telephone', '=', $telephone)->first();
      return response()->json(['user' => $user], 200);
    }
  }

  public function checkIfEmailExistEditPage(Request $request)
  {
    if ($request->ajax()) {
      $email = $request->email;
      $user = User::where('email', '=', $email)->where('id', '<>', $request->user_id)->first();
      if ($user) {
        $user = true;
      }
      return response()->json(['user' => $user], 200);
    }
  }
}
