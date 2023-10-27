@extends('layouts.dash')
@section('pagetitle', "Historique")
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
            <h3 class="card-title">Historique des transferts</h3>
         </div>
         <div class="card-body">

            <form autocomplete="off" action="{{route('recherche.historique')}}" method="POST" role="form" >
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


          <div class="card-header">

            <form  action="{{route('exporttransfert')}}" method="POST" role="form" >
               @csrf

            <input  value="{{$data}}"  class="form-control d-none"  name="data" >

            <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-excel"></i> Exporter en Excel</button>
         </form>
        <div class="card-tools mr-2">
        <form  action="{{route('exportPdfTransfert')}}" method="POST" role="form" >
             @csrf
            <input  value="{{$data}}"  class="form-control d-none"  name="data" >
            <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-pdf"></i> Exporter en PDF</button>
         </form>
        </div>
         </div>

              <table id="example1" class="table table-bordered table-hover ">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Source</th>
                    <th>Rôle</th>
                    <th>Destination</th>
                    <th>Rôle</th>
                    <th>Points</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($historiques as $key=>$prime)
                      <tr>
                        <td> {{ ++$key}} </td>
                        <td> {{ $prime["source"] }} </td>
                        <td> <span class="badge badge-primary">{{$prime["roleS"]}}</span></td>
                        <td> {{$prime["destination"]}}</td>
                        <td> <span class="badge badge-primary">{{$prime["roleD"]}}</span></td>
                        <td> {{$prime["point"]}}</td>
                        <td> {{$prime["date"]}}</td>
                    </tr>
                  @endforeach

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
