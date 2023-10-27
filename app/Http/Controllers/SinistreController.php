<?php

namespace App\Http\Controllers;

use App\Models\Sinistre;
use App\Models\Contrat;
use App\Models\StatutSouscription;
use App\Models\Souscription;
use App\User;
use Auth;
use Illuminate\Http\Request;

class SinistreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sinistres = Sinistre::all();
        return view('dash.sinistres.index',compact(['sinistres']));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function messinistres()
    {
        $sinistres =  Auth::user()->client()->first()->contrats->where('statut', '=', 'Sinistre');
        return view('dash.sinistres.index',compact(['sinistres']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dash.sinistres.create');
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
           'reference'        => 'required',
           'date_sinistre'        => 'required',
           'description'        => 'required',
        ]);
        
        $user = Auth::user();
        $contrat = Contrat::where('reference', $request->reference)->first();

        if($contrat && $contrat->client_id==$user->client->first()->id)
        {
            if($contrat->statut == "Attente de traitement"){
                toastr()->warning('Ce contrat est encore en attente de validation. Veuillez patienter', 'Erreur');
                return redirect()->route('sinistres.create');
            }
            elseif($contrat->statut == "Sinistre"){
              toastr()->warning('Un sinistre est déjà signalé sur ce contrat', 'Erreur');
              return redirect()->route('sinistres.create');
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

                toastr()->success('Nous vous prions de recevoir nos condoléances, les mesures seront enclenchées pour que les fonds vous soientt versés. Merci.', 'Succès');
                return redirect()->route('sinistres.messinistres');
            }
        }
        else
        {
            toastr()->warning('Ce contrat n\'existe pas. Veuillez bien verifier le numéro de police du contrat.', 'Erreur');
            return redirect()->route('sinistres.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sinistre  $sinistre
     * @return \Illuminate\Http\Response
     */
    public function show(Sinistre $sinistre)
    {
      return view('dash.sinistres.show',compact(['sinistre']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sinistre  $sinistre
     * @return \Illuminate\Http\Response
     */
    public function termiersinistre(Sinistre $sinistre)
    {
        Sinistre::where('id',$sinistre->id)->update(['statut' =>'Terminé']);
        toastr()->success('Sinistre terminé avec succès.', 'success');
        return redirect()->route('sinistres.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sinistre  $sinistre
     * @return \Illuminate\Http\Response
     */
    public function edit(Sinistre $sinistre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sinistre  $sinistre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sinistre $sinistre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sinistre  $sinistre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sinistre $sinistre)
    {
        //
    }
}
