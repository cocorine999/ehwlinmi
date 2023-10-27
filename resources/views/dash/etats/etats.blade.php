@extends('layouts.dash')
@section('pagetitle', "Etats")
@section('styles')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card card-default">
         <div class="card-header">
            <h3 class="card-title">Etats</h3>
         </div>
         <div class="card-body">

            <form autocomplete="off" action="{{route('etats.prime')}}" method="POST" role="form" >
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
{{-- dd($results) --}}

             <hr>
      <div class="card-header">
            <h3 class="card-title">Resultats</h3>
            @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
          <form  action="{{route('export')}}" method="POST" role="form" >
               @csrf
            <input  value="{{$results}}"  class="form-control d-none"  name="data" >
            <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-excel"></i> Exporter en Excel</button>
         </form>
         @endhasanyrole
        <div class="card-tools mr-2">
        @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
        <form  action="{{route('exportPdfetat')}}" method="POST" role="form" >
             @csrf
            <input  value="{{$results}}"  class="form-control d-none"  name="data" >
            @if($results != null)
            <input  value="{{$debut}}" class="form-control d-none"  name="debut" >
            <input value="{{$fin}}"   class="form-control d-none"  name="fin" >
            @endif
            <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-pdf"></i> Exporter en PDF</button>
        </form>
        @endhasanyrole
        </div>
         </div>
              <table id="example1" class="table table-bordered table-hover data-table">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Souscripteur</th>
                    <th>Assuré</th>
                    <th>Numéro de police</th>
                    <th>Montant</th>
                    <th>Prime Totale Payée</th>
                    <th>Reste à payer</th>

                    @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.marchand'))
                    <th>Commission Marchand</th>
                    @endhasanyrole
                    @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.smarchand'))
                    <th>Commission Super-marchand</th>
                    @endhasanyrole
                    @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
                    <th>Commission GMMS</th>
                    <th>NSIA</th>
                    @endhasanyrole

                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if($results != null)
                     @foreach ($results as $key=>$prime)
                        <tr class="{{ App\Models\Primes::where('souscription_id',$prime->souscription_id)->get()->count() >= $moisactuel ? 'text-success':'text-danger' }} ">
                           <td>{{ ++$key}} </td>
                           <td>{{App\Models\Client::where('id',$prime->client_id)->first()->users->first()->getFullNameAttribute() }} </td>
                           <td>{{App\Models\Assure::where('id',$prime->id_assure)->first()->users->first()->getFullNameAttribute()}} </td>
                           <td>{{ $prime->reference}} </td>
                           <td>{{ $prime->montant}} </td>
                           <td>{{App\Models\Primes::where('souscription_id',$prime->souscription_id)->get()->count()}} </td>
                           <td>{{ 12 - App\Models\Primes::where('souscription_id',$prime->souscription_id)->get()->count()}} </td>

                           @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.marchand'))
                           <td>{{ $prime->c_marchand/10 }} </td>
                           @endhasanyrole

                           @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.smarchand'))
                           <td>{{ $prime->c_smarchand/10 ?? ''}} </td>
                           @endhasanyrole

                           @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
                           <td>{{ $prime->c_mms/10 ?? ''}} </td>
                           <td>{{ $prime->c_nsia/10 ?? ''}} </td>
                           @endhasanyrole

                           <td class="d-none d-sm-table-cell text-center p-1">
                           <div class="mx-auto">
                                 <a href="{{route('contrats.show', $prime->reference)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                                 <i class="fa fa-fw fa-eye"></i>
                                 </a>
                           </div>
                           </td>
                     </tr>
                     @endforeach
                  @endif
               </tbody>
              </table>
         </div>

      </div>
   </div>
</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('dashboard/customjs/x.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $('#datetimepicker4').datetimepicker({
      dateFormat: "yy-mm-dd",
      timeFormat:  "hh:mm:ss"
  });
</script>


<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
@endsection
