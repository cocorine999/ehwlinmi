<?php

namespace App\Http\Controllers;

use App\Models\Retrait;
use App\Notifications\Retrait\NewRetraitNotificationAdmin;
use App\Notifications\Retrait\NewRetraitNotificationClient;
use App\Notifications\Retrait\StatusChangedNotificationAdmin;
use App\Notifications\Retrait\StatusChangedNotificationClient;
use App\User;
use Auth;
use Session;
use Notification;
use Illuminate\Http\Request;

class RetraitController extends Controller
{

  public function index()
  {
    $retraits = Retrait::where('created_by_user_id', '=', Auth::id())->orderBy('created_at', 'desc')->paginate(100);
    if (Auth::user()->hasAnyRole(config('custom.roles.direction_all'))) {
      $retraits = Retrait::orderBy('created_at', 'desc')->paginate(100);
    }
    return view('dash.retrait.index', compact('retraits'));
  }

  public function create()
  {
    return view('dash.retrait.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'montant' => 'required|integer',
      'motif' => 'required',
    ]);

    $montant_a_retirer = $request->montant;
    $user = Auth::user();
    $solde_actuel = $user->getWallet('commission');
    #dd($user, $solde_actuel, $montant_a_retirer, $solde_actuel->balance, $solde_actuel && $montant_a_retirer <= $solde_actuel->balance);
    if ($solde_actuel && $montant_a_retirer <= $solde_actuel->balance) {
      $demande_retrait = Retrait::create([
        'montant' => $montant_a_retirer,
        'motif' => $request->motif,
        'created_by_user_id'  => $user->id,
      ]);

      $data = [
        "id" => $demande_retrait->id,
        "user" => $demande_retrait->created_by->full_name . " - " . $demande_retrait->created_by->telephone,
        "montant" => $demande_retrait->montant,
        "motif" => $demande_retrait->motif,
      ];

      $user->notify(new NewRetraitNotificationClient($data));

      $admins = User::role([config('custom.roles.direction_FC'), config('custom.roles.direction_C'), config('custom.roles.direction_ARH')])->get()->filter(function ($value, $key) {
        return $value->email != null;
      })->pluck('email');
      Notification::route('mail', $admins)->notify(new NewRetraitNotificationAdmin($data));

      Session::flash('success', 'Votre demande de retrait sera prise en compte.');
    } else {
      Session::flash('errors', collect(['Votre demande ne peut être effectuée. Veuillez vérifier votre solde']));
    }
    return redirect()->route('retraits.index');
  }

  private function save_retrait($retrait, $status, $observation)
  {
    $retrait->handled_by_user_id = Auth::id();
    $retrait->status = $status;
    $retrait->observation = $observation;
    $retrait->active = 0;
    $retrait->save();

    $data = [
      "id" => $retrait->id,
      "user" => $retrait->created_by->full_name . " - " . $retrait->created_by->telephone,
      "montant" => $retrait->montant,
      "motif" => $retrait->motif,
      "status" => $retrait->status,
      "observation" => $retrait->observation,
    ];
    $retrait->created_by->notify(new StatusChangedNotificationClient($data));

    $admins = User::role([config('custom.roles.direction_FC'), config('custom.roles.direction_C'), config('custom.roles.direction_ARH')])->get()->filter(function ($value, $key) {
      return $value->email != null;
    })->pluck('email');
    Notification::route('mail', $admins)->notify(new StatusChangedNotificationAdmin($data));
  }

  public function handle(Request $request)
  {
    $retrait = Retrait::find($request->retrait_id);
    if ($request->has('valider')) {
      $user = $retrait->created_by;
      $solde_actuel = $user->getWallet('commission');
      if ($solde_actuel->balance >= $retrait->montant) {
        if (!$user->getWallet('retrait')) {
          $user->createWallet(['name' => 'Solde Retrait', 'slug' => 'retrait']);
        }
        $user->getWallet('commission')->transfer($user->getWallet('retrait'), $retrait->montant);

        $this->save_retrait($retrait, 'Valide', $request->observation);

        return redirect()->route('retraits.index')->with('success', 'Demande Validee!');
      } else {
        return redirect()->route('retraits.index')->with('errors', 'Le client ne dispose plus d\'assez de fond!');
      }
    } elseif ($request->has('rejeter')) {
      $this->save_retrait($retrait, 'Rejeté', $request->observation);
      return redirect()->route('retraits.index')->with('success', 'Demande Réjetée!');
    }
  }


  public function show(Retrait $retrait)
  {
    return view('dash.retrait.show', compact('retrait'));
  }
}
