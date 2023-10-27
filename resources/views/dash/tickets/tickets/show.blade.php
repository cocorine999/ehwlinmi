@extends('layouts.dash')
@section('pagetitle', "Systeme de tickets")
@section('content')

<div class="card">
  <div class="card-body">
    @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
    @endif
    <div>
      @if($ticket->status->id != 3 || Auth::user()->hasRole(config('custom.roles.direction_C')))
      <a href="{{route('tickets.edit', $ticket->id)}}" class="btn btn-primary">Modifier</a>
      @endif
    </div>
    <div class="mb-2">
      <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <th>Contrat</th>
            <td> <a href="{{route('contrats.show', $ticket->contrat ? $ticket->contrat->reference : '' )}}"
                target="_blank">
                {{$ticket->contrat ? $ticket->contrat->reference : ''}} </a></td>
          </tr>
          <tr>
            <th>Utilisateur concerné</th>
            <td>
              {{$ticket->related_user ? $ticket->related_user->full_name .' - '. $ticket->related_user->telephone : ''}}
            </td>
          </tr>
          <tr>
            <th>Titre</th>
            <td>{{ $ticket->title }}</td>
          </tr>
          <tr>
            <th>Description</th>
            <td>{!! $ticket->content !!}</td>
          </tr>
          <tr>
            <th>Créé par</th>
            <td>{{ $ticket->created_by_user->full_name }} | {{ $ticket->created_at }}</td>
          </tr>

          <tr>
            <th>Status</th>
            <td>{{ $ticket->status->name ?? '' }}</td>
          </tr>
          <tr>
            <th>Priorité</th>
            <td>{{ $ticket->priority->name ?? '' }}</td>
          </tr>
          <tr>
            <th>Categorie</th>
            <td>{{ $ticket->category->name ?? '' }}</td>
          </tr>

          {{-- <tr><th>Assigné a</th><td>{{ $ticket->assigned_to_user->full_name ?? '' }}</td>
          </tr> --}}
          <tr>
            <th>Commentaires</th>
            <td>

              @forelse ($ticket->comments as $comment)<div class="row">
                <div class="col">
                  <p class="p-0 m-0 font-weight-bold">{{ $comment->comment_text }}</p>
                  <small class="">Par {{ $comment->user->full_name }} à {{ $comment->created_at }}</small>
                </div>
              </div>
              <hr />
              @empty
              <div class="row">
                <div class="col">
                  <p>Pas de commentaires disponibles.</p>
                </div>
              </div>
              <hr />
              @endforelse

              <form action="{{ route('tickets.storeComment', $ticket->id) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="comment_text">Laisser un commentaire</label>
                  <textarea class="form-control" id="comment_text" name="comment_text" rows="1" cols="2"
                    required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enregister</button>
              </form>
            </td>
          </tr>

          @if ($ticket->category->name == "Paiement adhesion" | $ticket->category->name == "Paiement prime" )
          <tr>
            <th>Corriger</th>
            <td>

              @if ($ticket->comments->count())

              @if (!$ticket->corrected_by_user_id && $ticket->status->name == "Ouvert")

              <form action="{{ route('tickets.storeCorrection', $ticket->id) }}" method="POST">
                @csrf
                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                <div class="form-group">
                  <label for="comment_text">Entrer le transref</label>
                  <input required type="text" class="form-control" id="transref" name="transref" placeholder="Transref">
                </div>
                <button type="submit" class="btn btn-primary">Enregister</button>
              </form>
              @else
              <div class="row">
                <div class="col">
                  Transref: {{ $ticket->transref }} | Corrigé par : {{ $ticket->corrected_by_user->full_name }} | le :
                  {{ $ticket->corrige_le }}
                </div>
              </div>
              @endif
              @else
              <div class="row">
                <div class="col">
                  <p>Effectuez un commentaire avant la correction.</p>
                </div>
              </div>
              @endif

            </td>
          </tr>
          @endif

        </tbody>
      </table>
    </div>
    <a class="btn btn-default my-2" href="{{ route('tickets.index') }}">Retour</a>
    {{-- <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary">Editer</a> --}}
    <nav class="mb-3">
      <div class="nav nav-tabs">

      </div>
    </nav>
  </div>
</div>
@endsection
