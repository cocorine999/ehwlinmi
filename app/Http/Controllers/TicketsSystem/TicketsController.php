<?php

namespace App\Http\Controllers\TicketsSystem;

use App\Http\Controllers\Controller;

use App\Models\TicketCategory;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\Ticket;
use App\Models\Contrat;
use App\Models\MobileMoney;
use App\Models\StatutSouscription;
use App\Traits\ServicesValidationTrait;
use Auth;
use Session;
use App\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TicketsController extends Controller
{
  use ServicesValidationTrait;

  public function index(Request $request)
  {
    $tickets = Ticket::with('contrat', 'related_user', 'created_by_user', 'comments', 'status', 'priority', 'category')->orderBy('created_at', 'DESC')->paginate(1000);
    return view('dash.tickets.tickets.index', compact('tickets'));
  }

  public function create()
  {
    $statuses = TicketStatus::all()->pluck('name', 'id')->prepend("Choississez un élément", '');
    $priorities = TicketPriority::all()->pluck('name', 'id')->prepend("Choississez un élément", '');
    $categories = TicketCategory::all()->pluck('name', 'id')->prepend("Choississez un élément", '');

    return view('dash.tickets.tickets.create', compact('statuses', 'priorities', 'categories'));
  }

  public function store(Request $request)
  {
    //dd($request->all());
    $contrat = Contrat::where('reference', '=', $request->reference)->first();
    $user = null;
    if ($request->telephone) {
      $user = User::where('telephone', '=', $request->telephone)->first();
      if (!$user) {
        return redirect()->back()->withErrors(['Vérifier le numero de telephone']);
      }
    }
    if (!$contrat) {
      return redirect()->back()->withErrors(['Vérifier la reference du contrat']);
    }

    $ticket = new Ticket;

    $ticket->title = $request->title;
    $ticket->content = $request->content;

    $ticket->contrat_id =  $contrat ? $contrat->id : null;
    $ticket->related_user_id = $user ? $user->id : null;
    $ticket->created_by_user_id = Auth::id();
    # $ticket->assigned_to_user_id = $request->ticket_assigned_to_user_id;

    $ticket->status_id = 1;
    $ticket->priority_id = $request->priority_id;
    $ticket->category_id = $request->category_id;

    $ticket->save();

    Session::flash("success", "Ticket ajouté avec succes.");

    return redirect()->route('tickets.index');
  }

  public function edit(Ticket $ticket)
  {
    # abort_if(Gate::denies('ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $statuses = TicketStatus::all()->pluck('name', 'id');

    $priorities = TicketPriority::all()->pluck('name', 'id');

    $categories = TicketCategory::all()->pluck('name', 'id');

    // $assigned_to_users = User::whereHas('roles', function($query) {
    //         $query->whereId(2);
    //     })
    //     ->pluck('name', 'id')
    //     ->prepend(trans('global.pleaseSelect'), '');

    $assigned_to_users = [];


    $ticket->load('status', 'priority', 'category', 'assigned_to_user');

    return view('dash.tickets.tickets.edit', compact('statuses', 'priorities', 'categories', 'assigned_to_users', 'ticket'));
  }

  public function update(Request $request, Ticket $ticket)
  {
    $contrat = Contrat::where('reference', '=', $request->reference)->first();
    $user = null;
    if ($request->telephone) {
      $user = User::where('telephone', '=', $request->telephone)->first();
      if (!$user) {
        return redirect()->back()->withErrors(['Vérifier le numero de telephone']);
      }
    }
    if (!$contrat) {
      return redirect()->back()->withErrors(['Vérifier la reference du contrat']);
    }

    $ticket->title = $request->title;
    $ticket->content = $request->content;

    $ticket->contrat_id =  $contrat ? $contrat->id : null;
    $ticket->related_user_id = $user ? $user->id : null;
    # $ticket->created_by_user_id = Auth::id();
    # $ticket->assigned_to_user_id = $request->ticket_assigned_to_user_id;

    $ticket->status_id = $request->status_id;
    $ticket->priority_id = $request->priority_id;
    $ticket->category_id = $request->category_id;

    $ticket->save();

    Session::flash("success", "Ticket mis a jour avec succes.");


    return redirect()->route('tickets.index');
  }

  public function show(Ticket $ticket)
  {
    # $ticket->load('status', 'priority', 'category', 'assigned_to_user', 'comments');
    $ticket->load('status', 'priority', 'category');
    // $ticket->status_id = 1;
    // $ticket->save();

    return view('dash.tickets.tickets.show', compact('ticket'));
  }

  public function destroy(Ticket $ticket)
  {
    # abort_if(Gate::denies('ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $ticket->delete();

    return back();
  }

  public function massDestroy(Request $request)
  {
    Ticket::whereIn('id', request('ids'))->delete();

    return null;
  }

  public function storeComment(Request $request, Ticket $ticket)
  {
    $request->validate([
      'comment_text' => 'required'
    ]);
    $user = auth()->user();
    $comment = $ticket->comments()->create([
      'user_id'       => $user->id,
      'comment_text'  => $request->comment_text
    ]);

    //$ticket->sendCommentNotification($comment);

    return redirect()->back()->withStatus('Commentaire ajouté avec succes.');
  }

  public function correction(Request $request)
  {
    $ticket = Ticket::where('id', '=', $request->ticket_id)->firstOrFail();
    $contrat = $ticket->contrat;
    $momo = MobileMoney::where('transref', '=', $request->transref)->first();
    if (!$momo) {
      return back()->withErrors(['Transaction non retrouvée']);
    }
    // if (!Str::contains($momo->narration, $contrat->reference)) {
    //   return back()->withErrors(['Cette transaction ne concerne pas ce contrat']);
    // }
    $montant = 0;
    if ($ticket->category->name == "Paiement adhesion") {
      $montant = 1000;
      //dd($contrat, 'ok');
      // return Redirect::route('souscriptions.payer_adhesion', ['ticket' =>  $ticket->id, 'transref' =>  $momo->transref]);

      $auth_id = $contrat->marchands->first()->users->first()->id;

      $this->process_paiement_souscription($contrat, $auth_id);

      $update_date = $contrat->souscriptions->last()->statut_souscriptions()->where('user_id',  $auth_id)->where('motif', "Attente de validation")
        ->update(["statut_souscriptions.created_at" => $momo->created_at]);

      toastr()->success('Contrat mise en attente de validation avec succès.', 'success');

      dump('Contrat payé avec succès.', 'success');

      dump('Tickect Fermé. Redirection en cours', 'success');

      $ticket->status_id = 3;
      $ticket->transref = $momo->transref;
      $ticket->corrected_by_user_id = Auth::id();
      $ticket->corrige_le = Carbon::now();
      $ticket->save();

      $momo->response_msg = $momo->response_msg . ' success VM';
      $momo->save();

      sleep(10);
      Session::flash('success', 'opération effectue');
      return redirect()->route('tickets.show', $ticket->id);
    } else if ($ticket->category->name == "Paiement prime") {
      //dd($contrat, 'ok2');
      // return Redirect::route('primes.store_correction_maintenance', ['ticket' =>  $ticket->id, 'transref' =>  $momo->transref]);

      $prime = $momo->amount;
      $reference = $ticket->contrat->reference;
      $error = '';
      $reste = 0;
      $contrat = Contrat::where('reference', '=', $reference)->first();


      if ($contrat) {
        // si le statut du contrat est dans la liste suivante (pas bon)
        if (in_array($contrat->statut, ['Attente de paiement', 'Attente de traitement', 'Rejeté', 'Terminé'], true)) {
          dump('Vous ne pouvez pas enregistrer de primes sur ce contrat. Contrat ' . $contrat->statut, 'Erreur');
          $error .= ' Vous ne pouvez pas enregistrer de primes sur ce contrat. Contrat ' . $contrat->statut;
        } else { // si le statut est bon
          if ($contrat->souscriptions->last()->primes->count() > 0) { // et que le contrat dispose deja de primes
            // calcul du reste ici
            $reste = (12 - $contrat->souscriptions->last()->primes->count()) * 1000; // primes restantes
            if ($reste == 0) {
              dump('Ce client est déja à jour pour ce contrat.', 'Erreur');
              $error .= ' Ce client est déja à jour pour ce contrat.';
            } else {
              if ($prime > $reste) {
                dump('Ce client doit payer: ' . $reste . ' F. La prime fournie ne peut être supérieure à ce montant.', 'Erreur');
                $error .= ' Ce client doit payer: ' . $reste . ' F. La prime fournie ne peut être supérieure à ce montant.';
              }
            }
          }
        }
      } else {
        dump('Veuillez entrer un contrat valide.', 'Erreur');
        $error = 'Veuillez entrer un contrat valide.';
      }

      if ($error) {
        sleep(10);
        return back()->withErrors([$error]);
      } // breakIfErrors

      if ($contrat) {
        $auth_id = $contrat->marchands->first()->users->first()->id;
        $this->process_paiement_prime($contrat, $prime, $auth_id);
      } else {
        dump('Veuillez entrer un contrat valide.', 'Erreur');
      }

      dump('Tickect Fermé. Redirection en cours', 'success');

      //$ticket->status_id = 3;
      // $ticket->transref = $momo->transref;
      // $ticket->corrected_by_user_id = Auth::id();
      // $ticket->corrige_le = Carbon::now();
      // $ticket->save();

      $momo->response_msg = $momo->response_msg . ' success VM';
      $momo->save();

      sleep(10);
      Session::flash('success', 'opération effectue');
      return redirect()->route('tickets.show', $ticket->id);
    }
  }
}
