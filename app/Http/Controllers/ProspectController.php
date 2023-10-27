<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Prospect;
use App\Models\Commune;
use Illuminate\Http\Request;

class ProspectController extends Controller
{

    public function index()
    {
        $prospects = Auth::user()->marchand->first()->prospects;
        return view('dash.prospects.index',compact(['prospects']));
    }

 
    public function create()
    {
        $communes = Commune::all();
        $prospects = Auth::user()->marchand->first()->prospects;
        return view('dash.prospects.create',compact(['communes', 'prospects']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'        => 'required',
            'prenom'     => 'required',
            'telephone'    => 'required|unique:users',
            'commune_id'    => 'required',
        ]);

        $prospect = Prospect::create([
            "nom"          => $request->nom,
            "prenom"       => $request->prenom,
            "telephone"    => $request->telephone,
            "description"  => $request->description,
            "commune_id"   => $request->commune_id,
            "marchand_id"  => Auth::user()->marchand->first()->id
        ]);
        
        toastr()->success('Prospect enregistré avec succes.', 'Prospect Enregistré');
        return redirect()->route('prospects.create');
    }

    public function show(Prospect $prospect)
    {
        return view('dash.prospects.show',compact(['prospect']));
    }


    public function edit(Prospect $prospect)
    {
        if(Auth::id() == $prospect->marchand_id){
            $communes = Commune::all();
            dd('ok');
            return view('dash.prospects.edit', compact(['prospect', 'communes']));
        }
        else{
            redirect('prospects');
        }
    }

    
    public function update(Request $request, Prospect $prospect)
    {
        $request->validate([
            'nom'        => 'required',
            'prenom'     => 'required',
            'telephone'    => 'required',
            'commune_id'    => 'required',
        ]);

        $prospect = Prospect::update([
            "nom"          => $request->nom,
            "prenom"       => $request->prenom,
            "telephone"    => $request->telephone,
            "description"  => $request->description,
            "commune_id"   => $request->commune_id,
        ]);

        return redirect()->route('prospects.index');
    }

    
    public function destroy(Prospect $prospect)
    {
        //
    }
}
