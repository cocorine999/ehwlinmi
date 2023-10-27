@extends('layouts.dash')
@section('pagetitle', "Retraits")

@section('styles')

@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Retraits</h3>
      </div>
      <div class="card-body">
        <div class="row"><a href="{{route('retraits.create')}}" class="btn btn-primary mb-3 float-right">Ajouter un
            retrait</a></div>

        <div class="">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                {{-- <th>id</th> --}}
                <th>Nom Prenom</th>
                <th>Telephone</th>
                <th>Montant</th>
                <th>Motif</th>
                <th>Ajouté le</th>
                <th>Status</th>
                <th>Traité par</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($retraits as $retrait)
              <tr>
                {{-- <td>{{ $retrait->id }}</td> --}}
                <td>{{ $retrait->created_by->full_name }}</td>
                <td>{{ $retrait->created_by->telephone }}</td>
                <td>{{ $retrait->montant}}</td>
                <td>{{ $retrait->motif }}</td>
                <td>{{ $retrait->created_at }}</td>
                <td>{{ $retrait->status ?? "Non traité" }}</td>
                <td>{{ optional($retrait->handled_by)->full_name }}</td>
                <td>
                  <a href="{{ route('retraits.show', $retrait->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                </td>
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
