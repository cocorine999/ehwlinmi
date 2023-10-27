<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use \Carbon\Carbon;
use App\User;
use App\Models\Assure;
use App\Models\Client;
use App\Models\Beneficiaire;
use App\Models\Souscription;
use App\Models\Contrat;
use App\Models\StatutSouscription;
use App\Models\Fichier;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function mesclients()
    {
        $clients = Auth::user()->marchand->first()->clients;
        return view('dash.clients.index', compact(['clients']));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('dash.clients.index', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('dash.clients.create', compact(['users']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
