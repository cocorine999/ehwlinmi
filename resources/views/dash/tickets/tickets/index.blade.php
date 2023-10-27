@extends('layouts.dash')
@section('pagetitle', "Tickets")

@section('content')

<div class="card">
    <div class="card-body">
        @hasanyrole(config('custom.roles.direction_C').'|'.config('custom.roles.ITMMS'))
        <div class="row"><a href="{{route('tickets.create')}}" class="btn btn-primary mb-3 float-right">Ajouter un ticket</a></div>
        @endhasanyrole
        <table class="table table-bordered table-hover col-12">
            <thead>
              <tr>
                <th>Objet</th>
                <th>reference</th>
                <th>Utilisateur</th>
                <th>Créé par</th>
                <th>Comments</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Category</th>
              </tr>
            </thead>
            <tbody>
                  @foreach ($tickets as $t)
                  <tr>
                    <td> <a href="{{ route('tickets.show', $t)}}">{{$t->title}}</a></td>
                    <td>{{$t->contrat ? $t->contrat->reference : ''}}</td>
                    <td>{{$t->related_user ? $t->related_user->full_name : ''}}</td>
                    <td>{{$t->created_by_user->full_name}}</td>
                    <td>{{$t->comments->count()}}</td>
                    <td>{{$t->status->name}}</td>
                    <td>{{$t->priority->name}}</td>
                    <td>{{$t->category->name}}</td>
                  </tr>
                  @endforeach
            </tbody>
          </table>
          <hr>
          <div>{{ $tickets->links() }}</div>
          
      </div>
</div>

@endsection