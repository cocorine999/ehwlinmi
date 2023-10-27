<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Carbon\Carbon;
use App\Models\Direction;
use App\Models\Souscription;
use App\Models\Marchand;
use App\Models\SuperMarchand;
use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Models\Commune;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directions = User::role(config('custom.roles.direction_all_cs'))->get();
        return view('dash.directions.index', compact(['directions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communes = Commune::all();
        $roles = Role::whereIn('name', ['Direction_ARH', 'Direction_FC', 'Direction_MAC'])->get();
        return view('dash.directions.create', compact(['roles', 'communes']));
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
        ]);

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
        $direction = "";
        $Direction_ARH   = (string) Role::findByName(config('custom.roles.direction_ARH'))->id;
        $Direction_FC   = (string) Role::findByName(config('custom.roles.direction_FC'))->id;
        $Direction_MAC    = (string) Role::findByName(config('custom.roles.direction_MAC'))->id;
        // $Direction_C    = (string) Role::findByName(config('custom.roles.direction_C'))->id;
        // $ITMMS          = (string) Role::findByName(config('custom.roles.ITMMS'))->id;
        
        switch ($request->role_id) {
            case $Direction_ARH : //Direction_ARH
                $direction = Direction::create();
                $direction->users()->save($user)->assignRole(config('custom.roles.direction_ARH'));
                break;
      
            case $Direction_FC : //Direction_FC
                $direction = Direction::create();
                $direction->users()->save($user)->assignRole(config('custom.roles.direction_FC'));
                break;
                
            case $Direction_MAC : //Direction_MAC
                $direction = Direction::create();
                $direction->users()->save($user)->assignRole(config('custom.roles.direction_MAC'));
                break;
                
            // case $Direction_C : //Direction_C
            //     $direction = Direction::create();
            //     $direction->users()->save($user)->assignRole(config('custom.roles.direction_C'));
            //     break;
                                
            // case $ITMMS : //ITMMS
            //     $direction = Direction::create();
            //     $direction->users()->save($user)->assignRole(config('custom.roles.ITMMS'));
            //     break;
                        
            default:
                toastr()->success('Utilisateur non créé.', 'Utilisateur non créé');
                break;
        }
        if($direction){
            toastr()->success('Utilisateur '.$user->nom.' créé avec succès.', 'Succès');
            $this->sendSMS('Votre compte Direction est cree. Login : votre numero, mot de passe : '.$password, $direction->users->first());
        }
        return redirect()->route('directions.index');      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function show(Direction $direction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function edit(Direction $direction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Direction $direction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Direction $direction)
    {
        //
    }
    
    public function point_commission()
    {
        $supermarchands = User::role(config('custom.roles.smarchand'))->get();
        return view('dash.directions.point.commission', compact('supermarchands'));
    }

    public function point_super_marchands()
    {
        $supermarchands = User::role(config('custom.roles.smarchand'))->get();
        return view('dash.directions.point.supermarchands', compact('supermarchands'));
    }

    public function point_marchands($refsm)
    {
        $marchands = SuperMarchand::where('reference', '=', $refsm)->first()->marchands;
        return view('dash.directions.point.marchands', compact('marchands'));
    }

    public function point_contrats($refm)
    {
        $contrats = Marchand::where('reference', '=', $refm)->first()->contrats;
        return view('dash.contrats.index', compact('contrats'));
    }

}
