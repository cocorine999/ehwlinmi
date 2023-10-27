<?php

namespace App\Http\Controllers;

use App\Jobs\Paiements\CheckPaiementStatusJob;
use App\Jobs\Paiements\PayerSouscriptionJob;
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
use App\Models\MobileMoney;
use App\Models\Ticket;
use App\Traits\MobilePaiement;
use App\Traits\ServicesValidationTrait;
use Illuminate\Http\Request;

class SouscriptionController extends Controller
{
  use MobilePaiement, ServicesValidationTrait;

  public function payer(Request $request)
  {
    $souscription = Souscription::find($request->souscription_id);
    $auth_id = Auth::id();
    $contrat = $souscription->contrat;
    if ($contrat) {
      if ($contrat->souscriptions->last()->statut == 'Attente de paiement') {
        $payingUser = $contrat->client->users->first();
        $paiement = $this->pay($payingUser, config('prices.' . config('app.env') . '.adhesion'), $request->paiementChoice, $contrat->reference . "S" . $contrat->souscriptions->count());
        # $paiement = true;
        if ($paiement['status'] == "SUCCESS") {
          $this->process_paiement_souscription($contrat, $auth_id);
          toastr()->success('Contrat payé avec succès.', 'success');
        } else {
          CheckPaiementStatusJob::dispatch($paiement['transref'], $contrat, $auth_id, "souscription")->delay(now()->addMinutes(10));
          toastr()->error('Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.', 'Erreur');
          Session::flash('errors', ['Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.']);
          $this->add_error('Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.');
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


  public function renouveller(Request $request)
  {
    $contrat = Contrat::findOrFail($request->contrat_id);

    $this->authorize('renouveller', $contrat);

    $auth_id = Auth::id();
    $payingUser = $contrat->client->users->first();
    $paiement = $this->pay($payingUser, config('prices.' . config('app.env') . '.adhesion'), $request->paiementChoice, $contrat->reference . "S" . ($contrat->souscriptions->count() + 1));
    # $paiement['status'] = "SUCCESS";
    if ($paiement['status'] == "SUCCESS") {
      $this->process_paiement_renouvellement($contrat, $auth_id);
      toastr()->success('Contrat renouvellé avec succès.', 'success');
    } else {
      CheckPaiementStatusJob::dispatch($paiement['transref'], $contrat, $auth_id, "renouvellement")->delay(now()->addMinutes(10));
      $error_message = "Aucune réponse obtenue. Assurez vous de valider le paiement et verifiez apres 10 min. Votre opération sera prise en compte automatiquement.";
      toastr()->error($error_message, 'Erreur');
      Session::flash('errors', [$error_message]);
      $this->add_error($error_message);
    }
    return redirect()->route('contrats.show', $contrat->reference);
  }



  /**
   * Correction IT - Valider un contrat
   *
   * @return \Illuminate\Http\Response
   */
  public function payer_adhesion($ticket, $transref)
  {
    $ticket = Ticket::find($ticket);
    $reference = $ticket->contrat->reference;
    $momo = MobileMoney::where('transref', '=', $transref)->first();

    $contrat = Contrat::where('reference', $reference)->first();
    $auth_id = $contrat->marchands->first()->users->first()->id;
    $contrat->souscriptions->last()->update(['statut' => "Attente de traitement"]);
    $statut = StatutSouscription::whereLabel('Attente de traitement')->get();
    $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Paiement éffectué"]);

    if ($contrat->q1 == 0 && $contrat->q2 == 0 && $contrat->q3 == 0 && $contrat->q4 == 0 && $contrat->q5 == 1) {
      $contrat->souscriptions->last()->update(['statut' => "Attente de validation"]);
      $statut = StatutSouscription::whereLabel('Attente de validation')->get();
      $contrat->souscriptions->last()->statut_souscriptions()->attach($statut, ['user_id' => $auth_id, 'motif' => "Attente de validation", "created_at" => $momo->created_at]);
      toastr()->success('Contrat mise en attente de validation avec succès.', 'success');
    }

    $direction = User::role(config('custom.roles.direction'))->first();
    $direction->getWallet('principal')->deposit(1000  * config('custom.points.coefficient'));

    dump('Contrat payé avec succès.', 'success');

    dump('Tickect Fermé. Redirection en cours', 'success');

    $ticket->status_id = 3;
    $ticket->transref = $transref;
    $ticket->corrected_by_user_id = Auth::id();
    $ticket->corrige_le = Carbon::now();
    $ticket->save();

    $momo->response_msg = $momo->response_msg . 'success VM';
    $momo->save();

    sleep(10);
    Session::flash('success', 'opération effectue');
    return redirect()->route('tickets.show', $ticket->id);
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
      toastr()->success('Contrat mise en attente de validation avec succès.', 'success');
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
