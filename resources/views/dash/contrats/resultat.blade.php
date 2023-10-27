@extends('layouts.dash')
@section('pagetitle', "Resultat")

@section('styles')

@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Résultat</h3>
            @hasanyrole(config('custom.roles.marchand'))
            <div class="card-tools">
                <a href="{{route('contrats.create')}}" type="button" class="btn btn-primary float-right" title="Ajouter un marchand">
                    <i class="fas fa-plus"></i> Ajouter un contrat</a>
            &nbsp;&nbsp;
            </div>
            @endhasanyrole

            @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
            <form  action="{{route('exportContrat')}}" method="POST" role="form" >
               @csrf
                <input  value="{{$contrats}}"  class="form-control d-none"  name="data" >
                <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-excel"></i> Exporter en Excel</button>
            </form>
            @endhasanyrole
        <div class="card-tools mr-2">
        @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
          <form  action="{{route('exportPdfContrat')}}" method="POST" role="form" >
               @csrf
            <input  value="{{$contrats}}"  class="form-control d-none"  name="data" >
            <input  value="{{$debut}}"  class="form-control d-none"  name="debut" >
            <input  value="{{$fin}}"  class="form-control d-none"  name="fin" >
            <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-pdf"></i> Exporter en PDF</button>
         </form>
          @endhasanyrole
        </div>
        </div>

            <div class="card-body">
                <div class="">
                  @include('dash.components.listcontrats')
                </div>
              </div>
          </div>
        </div>
    </div>
@endsection

@section('js')

@endsection


