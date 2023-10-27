@extends('layouts.dash')
@section('pagetitle', "Liste Globale des contrats")
@section('styles')
@endsection
@section('content')
<div class="card">
   <div class="card-body">
      <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
         @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
         <li class="nav-item"><a class="nav-link" id="custom-content-above-alls-tab" data-toggle="pill" href="#custom-content-above-alls" role="tab" aria-controls="custom-content-above-alls" aria-selected="true">Tous</a></li>
         <li class="nav-item"><a class="nav-link" id="custom-content-above-all-tab" data-toggle="pill" href="#custom-content-above-all" role="tab" aria-controls="custom-content-above-all" aria-selected="true">Attentes</a></li>
         <li class="nav-item"><a class="nav-link" id="custom-content-above-all-tab" data-toggle="pill" href="#custom-content-above-attent" role="tab" aria-controls="custom-content-attent-all" aria-selected="true">Attentes de paiement</a></li>
         <li class="nav-item"><a class="nav-link" id="custom-content-above-direction-tab" data-toggle="pill" href="#custom-content-above-direction" role="tab" aria-controls="custom-content-above-direction" aria-selected="false">Valides</a></li>
         <li class="nav-item"><a class="nav-link" id="custom-content-above-smarchand-tab" data-toggle="pill" href="#custom-content-above-smarchand" role="tab" aria-controls="custom-content-above-smarchand" aria-selected="false">Rejetés</a></li>
         <li class="nav-item"><a class="nav-link" id="custom-content-above-marchand-tab" data-toggle="pill" href="#custom-content-above-marchand" role="tab" aria-controls="custom-content-above-marchand" aria-selected="false">Sinistrés</a></li>
         <li class="nav-item"><a class="nav-link" id="custom-content-above-client-tab" data-toggle="pill" href="#custom-content-above-client" role="tab" aria-controls="custom-content-above-client" aria-selected="false">Terminés</a></li>
         @endhasanyrole
      </ul>
      <div class="tab-content" id="custom-content-above-tabContent">
         <div class="tab-pane fade show" id="custom-content-above-alls" role="tabpanel" aria-labelledby="custom-content-above-alls-tab">
            <div class="card-header">
               <form  action="{{route('export')}}" method="POST" role="form" >
                  @csrf
                  <input  value="{{collect($contratstous->items())}}"  class="form-control d-none"  name="data" >
                  <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-excel"></i> Exporter en Excel</button>
               </form>
               <div class="card-tools mr-2">
                  <form  action="{{route('exportPdfContrat')}}" method="POST" role="form" >
                     @csrf
                     <input  value="tous"  class="form-control d-none"  name="data1" ><input  value="{{collect($contratstous->items())}}"  class="form-control d-none"  name="data" >
                     <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-pdf"></i> Exporter en PDF</button>
                  </form>
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
            @include('dash.components.lc', ['contrats' => $contratstous ])
            <hr>
            <div class="mx-auto">{{ $contratstous->links() }}</div>
         </div>
         <div class="tab-pane fade show" id="custom-content-above-all" role="tabpanel" aria-labelledby="custom-content-above-all-tab">
            <p class="lead mb-0">Liste des contrats en attente</p>
            <div class="card-header">
               <form  action="{{route('export')}}" method="POST" role="form" >
                  @csrf
                  <input  value="{{$contratsAttente}}"  class="form-control d-none"  name="data" >
                  <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-excel"></i> Exporter en Excel</button>
               </form>
               <div class="card-tools mr-2">
                  <form  action="{{route('exportPdfContrat')}}" method="POST" role="form" >
                     @csrf
                     <input  value="{{$contratsAttente}}"  class="form-control d-none"  name="data" >
                     <input  value="En attente"  class="form-control d-none"  name="data2" >
                     <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-pdf"></i> Exporter en PDF</button>
                  </form>
               </div>
            </div>
            @include('dash.components.lc', ['contrats' => $contratsAttente ])
         </div>
         <div class="tab-pane fade show" id="custom-content-above-attent" role="tabpanel" aria-labelledby="custom-content-above-attent-tab">
            <p class="lead mb-0">Liste des contrats en attente de paiement</p>
            <div class="card-header">
               <form  action="{{route('export')}}" method="POST" role="form" >
                  @csrf
                  <input  value="{{$contratsPaiement}}"  class="form-control d-none"  name="data" >
                  <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-excel"></i> Exporter en Excel</button>
               </form>
               <div class="card-tools mr-2">
                  <form  action="{{route('exportPdfContrat')}}" method="POST" role="form" >
                     @csrf
                     <input  value="{{$contratsPaiement}}"  class="form-control d-none"  name="data" >
                     <input  value="En attente"  class="form-control d-none"  name="data2" >
                     <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-pdf"></i> Exporter en PDF</button>
                  </form>
               </div>
            </div>
            @include('dash.components.lc', ['contrats' => $contratsPaiement ])
         </div>
         <div class="tab-pane fade" id="custom-content-above-direction" role="tabpanel" aria-labelledby="custom-content-above-direction-tab">
            <div class="tab-custom-content">
               <p class="lead mb-0">Liste des contrats valides</p>
            </div>
            {{--
            <form autocomplete="off" action="{{route('etats.recherche')}}" method="POST" role="form" >
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
            --}}
            <hr>
            @include('dash.components.lc', ['contrats' => $contratsValide ])
         </div>
         <div class="tab-pane fade" id="custom-content-above-smarchand" role="tabpanel" aria-labelledby="custom-content-above-smarchand-tab">
            <div class="tab-custom-content">
               <p class="lead mb-0">Liste des contrats rejetés
               </p>
            </div>
            {{--
            <form autocomplete="off" action="{{route('etats.recherche')}}" method="POST" role="form" >
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
            --}}
            <hr>
            @include('dash.components.lc', ['contrats' => $contratsRejete ])
         </div>
         <div class="tab-pane fade" id="custom-content-above-marchand" role="tabpanel" aria-labelledby="custom-content-above-marchand-tab">
            <div class="tab-custom-content">
               <p class="lead mb-0">Liste des contrats sinistrés</p>
            </div>
            {{--
            <form autocomplete="off" action="{{route('etats.recherche')}}" method="POST" role="form" >
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
            --}}
            <hr>

            @include('dash.components.lc', ['contrats' => $contratsSinistre ])

         </div>
         <div class="tab-pane fade" id="custom-content-above-client" role="tabpanel" aria-labelledby="custom-content-above-client-tab">
            <div class="tab-custom-content">
               <p class="lead mb-0">Liste des contrats terminés</p>
            </div>
            {{--
            <form autocomplete="off" action="{{route('etats.recherche')}}" method="POST" role="form" >
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
            --}}
            <hr>

            @include('dash.components.lc', ['contrats' => $contratsTermine ])

         </div>
      </div>
   </div>
</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
@endsection
