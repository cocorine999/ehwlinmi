@extends('layouts.dash')
@section('pagetitle', "Primes")
@section('styles')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Ajout de Primes</h3>
      </div>
      <div class="card-body">
      {{--
        @role(config('custom.roles.marchand'))
        <div class="row">
          <div class="col-md-6">Solde commission : <b>{{ Auth::user()->getWallet('commission')->balance / config('custom.points.coefficient') }} FCFA</b></div>
        </div>
        @endrole
        --}}
        <hr>
        <form autocomplete="off" action="{{route('primes.store')}}" method="POST" role="form" >
          @csrf
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label for="ajaxInputTelephone">Numéro de télephone</label>
                <input required type="text" class="form-control" value='' id="ajaxInputTelephone" name="telephone" onchange=checkTelephone(this) placeholder="Numéro de télephone">
                <div id="ajaxInputTelephone-error"></div>
                <div id="ajaxInputTelephone-results"></div>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label>Contrat(s) *</label>
              <select required class="form-control select2bs4" name="reference">
                <option value="" selected disabled>Choisissez une option...</option>
              </select>
            </div>

            <div class="col-sm-6 col-md-3">
              <div class="form-group">
                <label for="prime">Prime</label>
                <input required type="number" min="1000" max="12000" step="1000" class="form-control" id="prime" name="prime" placeholder="Montant a payer">
              </div>
            </div>
          </div>
          @include('dash.components.paiementChoiceComponent')
          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
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
