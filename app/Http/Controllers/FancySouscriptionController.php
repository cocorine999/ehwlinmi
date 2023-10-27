<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Assure;
use App\Models\Beneficiaire;
use App\Models\Contrat;
use App\Models\Fichier;
use App\Models\Souscription;
use App\Models\StatutSouscription;
use Illuminate\Http\Request;

use App\Jobs\SouscriptionPayment;

class FancySouscriptionController extends Controller
{

  public function payer(Request $request)
  {
    $souscription = Souscription::find($request->souscription_id);
    $contrat = $souscription->contrat;
    if ($contrat) {
      if ($contrat->souscriptions->last()->statut == 'Attente de paiement') {
        $payingUser = $contrat->client->users->first();
        $paiement = $this->pay($payingUser, config('prices.' . config('app.env') . '.adhesion'), $request->paiementChoice, $contrat->reference . "S" . $contrat->souscriptions->count());
        #$paiement = true;
        if ($paiement) {

          $auth_id = Auth::id();
          #SouscriptionPayment::dispatch($contrat, $auth_id);

          $contrat->souscriptions->last()->update(['statut' => "Attente de traitement"]);
          $statut = StatutSouscription::whereLabel('Attente de traitement')->get();
          $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Paiement éffectué"]);

          if ($contrat->q1 == 0 && $contrat->q2 == 0 && $contrat->q3 == 0 && $contrat->q4 == 0 && $contrat->q5 == 1) {
            $contrat->souscriptions->last()->update(['statut' => "Attente de validation"]);
            $statut = StatutSouscription::whereLabel('Attente de validation')->get();
            $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Attente de validation"]);
            toastr()->success('Contrat valide avec succès.', 'success');
          }

          $direction = User::role(config('custom.roles.direction'))->first();
          $direction->getWallet('principal')->deposit(1000  * config('custom.points.coefficient'));

          toastr()->success('Contrat payé avec succès.', 'success');
        } else {
          toastr()->error('Paiement non effectué', 'Erreur');
          Session::flash('errors', ['Paiement non effectué']);
          $this->add_error('Paiement non effectué');
        }
      } else {
        toastr()->error('Votre contrat n\'est pas en attente de paiemnent.', 'Avertissement');
        Session::flash('errors', ['Votre contrat n\'est pas en attente de paiemnent.']);
        $this->add_error('Votre contrat n\'est pas en attente de paiemnent');
      }
    } else {
      toastr()->error('Contrat non trouvé', 'Erreur');
      Session::flash('errors', ['Contrat non trouvé']);
      $this->add_error('Contrat non trouvé');
      return redirect()->back();
    }

    return redirect()->route('contrats.show', $contrat->reference);
  }


  /**
   * Correction IT - Valider un contrat
   *
   * @return \Illuminate\Http\Response
   */
  public function payer_adhesion()
  {
    $l = [
      //  '19A123N2139', '28L11N27787'
    ];
    foreach ($l as $c) {

      $contrat = Contrat::where('reference', $c)->first();
      $auth_id = $contrat->marchands->first()->users->first()->id;
      $contrat->souscriptions->last()->update(['statut' => "Attente de traitement"]);
      $statut = StatutSouscription::whereLabel('Attente de traitement')->get();
      $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Paiement éffectué"]);

      if ($contrat->q1 == 0 && $contrat->q2 == 0 && $contrat->q3 == 0 && $contrat->q4 == 0 && $contrat->q5 == 1) {
        $contrat->souscriptions->last()->update(['statut' => "Attente de validation"]);
        $statut = StatutSouscription::whereLabel('Attente de validation')->get();
        $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Attente de validation"]);
        toastr()->success('Contrat valide avec succès.', 'success');
      }

      $direction = User::role(config('custom.roles.direction'))->first();
      $direction->getWallet('principal')->deposit(1000  * config('custom.points.coefficient'));

      dump('Contrat payé avec succès.', 'success');
    }
  }

  /**
   * Correction IT - Valider un contrat
   *
   * @return \Illuminate\Http\Response
   */
  public function valider_manuellement($reference)
  {
    $contrat = Contrat::where('reference', $reference)->first();
    # dd($contrat->souscriptions->last()->statut_souscriptions);

    $auth_id = $contrat->marchands->first()->users->first()->id;
    $contrat->souscriptions->last()->update(['statut' => "Attente de traitement"]);
    $statut = StatutSouscription::whereLabel('Attente de traitement')->get();
    $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Paiement éffectué"]);

    if ($contrat->q1 == 0 && $contrat->q2 == 0 && $contrat->q3 == 0 && $contrat->q4 == 0 && $contrat->q5 == 1) {
      $contrat->souscriptions->last()->update(['statut' => "Attente de validation"]);
      $statut = StatutSouscription::whereLabel('Attente de validation')->get();
      $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Attente de validation"]);
      toastr()->success('Contrat valide avec succès.', 'success');
    }

    $direction = User::role(config('custom.roles.direction'))->first();
    $direction->getWallet('principal')->deposit(1000  * config('custom.points.coefficient'));

    dump('Contrat payé avec succès.', 'success');
  }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
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
   * @param  \App\Models\Souscription  $souscription
   * @return \Illuminate\Http\Response
   */
  public function show(Souscription $souscription)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Souscription  $souscription
   * @return \Illuminate\Http\Response
   */
  public function edit(Souscription $souscription)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Souscription  $souscription
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Souscription $souscription)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Souscription  $souscription
   * @return \Illuminate\Http\Response
   */
  public function destroy(Souscription $souscription)
  {
    //
  }
}
