@extends('layouts.dash')
@section('pagetitle', "Versements")

@section('styles')

@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Versements</h3></div>
        <div class="card-body">
        <div class="row"><a href="{{route('versements.create')}}" class="btn btn-primary mb-3 float-right">Ajouter un versement</a></div>

          <div class="">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Nom Prenom</th>
                    <th>Telephone</th>
                    <th>Motif</th>
                    <th>Montant</th>
                    <th>Créé par</th>
                    <th>le</th>
                    <th>Valide par</th>
                    <th>le</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($versements as $versement)
                      <tr>
                        <td>{{ $versement->id }}</td>
                        <td>{{ $versement->user->nom }} {{ $versement->user->prenom }}</td>
                        <td>{{ $versement->user->telephone }}</td>
                        <td>{{ $versement->motif }}</td>
                        <td>{{ $versement->montant }}</td>
                        <td>{{ $versement->created_by->nom }}</td>
                        <td>{{ $versement->created_at }}</td>
                        <td>{{ $versement->validated_by }}</td>
                        <td>{{ $versement->updated_at }}</td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')

@endsection


