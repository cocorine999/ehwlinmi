<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Sinistre;
use App\Models\Marchand;
use App\Models\Contrat;
use App\Models\SuperMarchand;
use Illuminate\Http\Request;

class MarchandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function mesmarchands()
    {
        $marchands = Auth::user()->super_marchand()->first()->marchands;
        return view('dash.marchands.index', compact(['marchands']));
    }

    public function messinistres()
    {
        $sinistres = Auth::user()->marchand->first()->contrats->where('statut', '=', 'Sinistre');
        return view('dash.sinistres.index', compact(['sinistres']));
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
     * @param  \App\Models\Marchand  $marchand
     * @return \Illuminate\Http\Response
     */
    public function show(Marchand $marchand)
    {
        return view('dash.marchands.show', compact(['marchand']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marchand  $marchand
     * @return \Illuminate\Http\Response
     */
    public function edit(Marchand $marchand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marchand  $marchand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marchand $marchand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marchand  $marchand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marchand $marchand)
    {
        //
    }
}
