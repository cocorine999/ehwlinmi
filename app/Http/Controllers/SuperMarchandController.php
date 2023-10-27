<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Models\Sinistre;
use App\Models\Contrat;
use App\Models\SuperMarchand;
use Illuminate\Http\Request;

class SuperMarchandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supermarchands = SuperMarchand::all();
        return view('dash.supermarchands.index',compact('supermarchands'));

        //lien important je vous prie de ne pas l'effacer
        //https://stackoverflow.com/questions/57349787/laravel-object-property-is-null-when-looping-but-has-value-when-json-encode
    }

    public function mes_supermarchands()
    {
        $users = [];
        $supermarchands = SuperMarchand::where('direction_id', '=', Auth::user()->direction()->first()->id)->with('users')->get();
        return view('dash.supermarchands.index', compact(['supermarchands', 'users']));
    }

    public function mes_sinistres()
    {
        $user = Auth::user();
        $sinistres = "";
        foreach ($user->super_marchand->first()->actual_marchands as $marchands)
        {
            foreach ($marchands->contrats as $contrats)
            {
                foreach ($contrats as $c)
                {
                    $sinistres= Sinistre::where('contrat_id',$c->id)->get();
                }
            }
        }
        return view('dash.supermarchands.sinistre', compact(['sinistres']));
    }

    public function mes_contrats()
    {
        $user = Auth::user();
        $contrats = [];
        foreach ($user->super_marchand->first()->actual_marchands as $marchand)
        {
            foreach ($marchand->contrats as $c)
            {
                array_push($contrats, $c);
            }
        }
        $data =json_encode($contrats);
        //dd(json_encode($contrats));
        return view('dash.supermarchands.contrat', compact(['contrats','data']));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuperMarchand  $superMarchand
     * @return \Illuminate\Http\Response
     */
    public function show(SuperMarchand $superMarchand)
    {
      return view('dash.supermarchands.show', compact(['superMarchand']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuperMarchand  $superMarchand
     * @return \Illuminate\Http\Response
     */
    public function edit(SuperMarchand $superMarchand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuperMarchand  $superMarchand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuperMarchand $superMarchand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuperMarchand  $superMarchand
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuperMarchand $superMarchand)
    {
        //
    }
}
