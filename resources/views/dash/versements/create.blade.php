@extends('layouts.dash')
@section('pagetitle', "Effectuer un versement")

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-body">
        <form autocomplete="off" action="{{route('versements.store')}}" method="POST" role="form" >
          @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="ajaxInputTelephone">Numéro de télephone</label>
                <input required type="text" class="form-control" value='' id="ajaxInputTelephone" name="telephone" onchange=checkTelephone(this) placeholder="Numéro de télephone">
                <div id="ajaxInputTelephone-error"></div>
                <div id="ajaxInputTelephone-results"></div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="montant">Montant</label>
                <input required type="number" min="0" class="form-control" id="montant" name="montant" placeholder="Montant a verser">
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label for="motif">Motif</label>
                <input required type="text" class="form-control" id="motif" name="motif" placeholder="Motif">
              </div>
            </div>
            
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right col-sm-12 col-md-4">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('dashboard/customjs/getContratByTelephone.js')}}" type="text/javascript"></script>
<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
@endsection
