<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Models\Solde;
use Illuminate\Http\Request;
use Bavix\Wallet\Models\Transfer;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SoldeController extends Controller
{
  public function transfert(Request $request)
  {
    $destination = User::find($request->user_id);
    if ($destination->id == Auth::id() && $request->source == 'principal') {
      toastr()->error('Si vous avez besoin de recharger votre compte, veuillez déposer une caution.', 'Transfert non éffectué');
      return redirect()->back();
    }
    $actualBalance = Auth::user()->getWallet($request->source)->balance / config('custom.points.coefficient');
    if ($actualBalance >= $request->points) {
      Auth::user()->getWallet($request->source)->transfer($destination->getWallet('principal'), $request->points * config('custom.points.coefficient'));

      $this->sendSMS('Vous avez envoye ' . $request->points . ' points a : ' . $destination->shortFullname, Auth::user());
      $this->sendSMS('Vous avez recu ' . $request->points . ' points sur votre compte principal depuis ' . Auth::user()->shortFullname, $destination);

      toastr()->success('Vous venez de transferer ' . $request->points . ' vers ' . $destination->shortFullname, 'Transfert éffectué');
      return redirect()->route('transactions.index');
    } else {
      toastr()->error('Vous ne disposez pas d\'autant de points dans votre compte', 'Transfert non éffectué');
      return redirect()->back();
    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $actual_balance = Auth::user()->getWallet('principal')->balance / config('custom.points.coefficient');
    if ($actual_balance < 1000) {
      toastr()->warning('Vous ne disposez pas d\'assez de points pour effecter un transfert', 'Erreur');
      # return redirect()->back();
    }
    $destination = User::role([config('custom.roles.direction'), config('custom.roles.smarchand'), config('custom.roles.marchand')])->get();
    return view('dash.comptes.index', compact(['destination']));
  }

  public function historiqueTransfert()
  {
    $historiques = [];
    $user = Auth::user();
    if ($user->hasAnyRole([config('custom.roles.direction') . '|' . config('custom.roles.nsia')])) {
      $data = DB::table('transfers')
        ->join('transactions', 'transfers.deposit_id', '=', 'transactions.id')
        ->select('from_id', 'to_id', 'transfers.created_at', 'amount')
        ->get();

      foreach ($data as $key => $prime) {
        if ($prime->from_id != null && $prime->to_id != null) {
          array_push($historiques, [
            'source' => User::where('id', $prime->from_id)->first()["nom"] . ' ' . User::where('id', $prime->from_id)->first()["prenom"],
            'roleS' => User::where('id', $prime->from_id)->first() ? User::where('id', $prime->from_id)->first()->getRoleNames()[0] : '',
            'destination' => User::where('id', $prime->to_id)->first()["nom"] . ' ' . User::where('id', $prime->to_id)->first()["prenom"],
            'roleD' => User::where('id', $prime->to_id)->first() ? User::where('id', $prime->to_id)->first()->getRoleNames()[0] : '',
            'point' => $prime->amount,
            'date' => $prime->created_at,

          ]);
        }
        # code...
      }
    } elseif ($user->hasAnyRole([config('custom.roles.smarchand') . '|' . config('custom.roles.marchand')])) {

      $data = DB::table('transfers')
        ->join('transactions', 'transfers.deposit_id', '=', 'transactions.id')
        ->where('transfers.from_id', $user->id)
        ->select('from_id', 'to_id', 'transfers.created_at', 'amount')
        ->get();
      // dd($data);
      foreach ($data as $key => $prime) {
        if ($prime->from_id != null && $prime->to_id != null) {
          array_push($historiques, [
            'source' => User::where('id', $prime->from_id)->first()["nom"] . ' ' . User::where('id', $prime->from_id)->first()["prenom"],
            'roleS' => User::where('id', $prime->from_id)->first() ? User::where('id', $prime->from_id)->first()->getRoleNames()[0] : '',
            'destination' => User::where('id', $prime->to_id)->first()["nom"] . ' ' . User::where('id', $prime->to_id)->first()["prenom"],
            'roleD' => User::where('id', $prime->to_id)->first() ? User::where('id', $prime->to_id)->first()->getRoleNames()[0] : '',
            'point' => $prime->amount,
            'date' => $prime->created_at,

          ]);
        }
        # code...
      }
    }
    //dd($historiques);
    return view('dash.comptes.historique', compact(['historiques', 'data']));
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
   * @param  \App\Models\Solde  $solde
   * @return \Illuminate\Http\Response
   */
  public function show(Solde $solde)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Solde  $solde
   * @return \Illuminate\Http\Response
   */
  public function edit(Solde $solde)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Solde  $solde
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Solde $solde)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Solde  $solde
   * @return \Illuminate\Http\Response
   */
  public function destroy(Solde $solde)
  {
    //
  }
}
