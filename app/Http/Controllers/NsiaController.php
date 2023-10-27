<?php

namespace App\Http\Controllers;

use App\Models\Nsia;
use App\User;
use App\Models\Commune;
use Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class NsiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nsias = User::role(config('custom.roles.nsia_all_cs'))->get();
        return view('dash.nsia.index', compact(['nsias']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communes = Commune::all();
        $roles = Role::whereIn('name',  ['Nsia1', 'Nsia2', 'ITNSIA'])->get();
        return view('dash.nsia.create', compact(['roles', 'communes']));
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
            'ifu'    => 'nullable',
            'adresse'    => 'required',
            #'commune_id'    => 'required',
        ]);
        $nsia = "";
        $password = "";
        if(config('app.use_generated_pass') == 1){ $password = (string) rand(1000,9999); }
        else{ $password = "1234";}

        $user = new User([
            'nom'                => $request->nom,
            'prenom'             => $request->prenom,
            'email'              => $request->email,
            'telephone'          => $request->telephone,
            'ifu'                => $request->ifu,
            'adresse'            => $request->adresse,
            'password'           => bcrypt($password),
            'commune_id'         => Auth::user()->commune->id,
        ]);
        $Nsia1 = (string) Role::findByName(config('custom.roles.nsia1'))->id;
        $Nsia2 = (string) Role::findByName(config('custom.roles.nsia2'))->id;
        $ITNSIA = (string) Role::findByName(config('custom.roles.ITNSIA'))->id;

        switch ($request->role_id) {
            case $Nsia1 : //Nsia1
                $nsia = Nsia::create([ 'user_id'  => Auth::user()->id ]);
                $nsia->users()->save($user)->assignRole(config('custom.roles.nsia1'));
                break;
            
            case $Nsia2 : //Nsia2
                $nsia = Nsia::create([ 'user_id'  => Auth::user()->id ]);
                $nsia->users()->save($user)->assignRole(config('custom.roles.nsia2'));
                break;
        
            case $ITNSIA : //ITNSIA
                $nsia = Nsia::create([ 'user_id'  => Auth::user()->id ]);
                $nsia->users()->save($user)->assignRole(config('custom.roles.ITNSIA'));
                break;
                        
            default:
                toastr()->success('Utilisateur non créé.', 'Utilisateur non créé');
                break;
        }
        if ($nsia) {
            toastr()->success('Utilisateur '.$user->nom.' créé avec succès.', 'Succès');
            $this->sendSMS('Votre compte Nsia est cree. Login : votre numero, mot de passe : '.$password, $nsia->users->first());
        }
        return redirect()->route('nsia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nsia  $nsia
     * @return \Illuminate\Http\Response
     */
    public function show(Nsia $nsia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nsia  $nsia
     * @return \Illuminate\Http\Response
     */
    public function edit(Nsia $nsia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nsia  $nsia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nsia $nsia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nsia  $nsia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nsia $nsia)
    {
        //
    }
}
