@extends('layouts.dash')
@section('pagetitle', "Contrats")

@section('styles')

@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">

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
                <input  value="{{collect($contrats->items())}}"  class="form-control d-none"  name="data" >
                <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-excel"></i> Exporter en Excel</button>
            </form>
            @endhasanyrole
        <div class="card-tools mr-2">
        @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
          <form  action="{{route('exportPdfContrat')}}" method="POST" role="form" >
               @csrf
            <input  value="{{collect($contrats->items())}}"  class="form-control d-none"  name="data" >
            <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-pdf"></i> Exporter en PDF</button>
         </form>
         @endhasanyrole

         {{--  <a href="{{route('contrats.create')}}" type="button" class="btn btn-primary float-right" title="Exporter en PDF">
                    <i class="far fa-fw fa-file-pdf"></i> Exporter en PDF</a>  --}}
        </div>
         <form autocomplete="off" action="{{route('attente.recherche.contrat')}}" method="POST" role="form" >
               @csrf
               <div class="row">
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="prime">Date debut</label>
                        <input required type="date"  class="form-control" id='datetimepicker4' name="date_debut" placeholder="date debut">
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <label for="prime">Date fin</label>
                        <input required type="date"  class="form-control" id="dae_fin" name="date_fin" placeholder="Date fin">
                     </div>
                  </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                     </div>
                  </div>
            </form>
        </div>

            <div class="card-body">
                @include('dash.components.lc', ['contrats' => $contrats ])
                <hr>
                <div class="mx-auto">{{ $contrats->links() }}</div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('js')

@endsection


