@extends('layouts.dash')
@section('pagetitle', "Ajouter un utilisateur")
@section('styles')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<style>
.select2{
  width: 100%;
}
</style>
@endsection
@section('content')

<div class="card">
  <div class="card-body">
    <form autocomplete="off" role="form" method='POST' action="{{route('directions.store')}}">
        @csrf
        <div class="row">
          <div class="form-group col-md-6">
            <label>Type d'utilsateur *</label>
            <select required class="form-control select2bs4" name="role_id">
              <option value="" selected disabled>Choisissez une option...</option>
              @foreach($roles as $r)
                <option value="{{$r->id}}">{{$r->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Departement - Commune *</label>
            <select required class="form-control select2bs4" name="commune_id">
              <option value="" selected disabled>Choisissez une option...</option>
              @foreach($communes as $c)
                <option value="{{$c->id}}">{{$c->departement->nom}} - {{$c->nom}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label for="InputNom">Nom *</label>
            <input required type="text" class="form-control" id="InputNom" name="nom" placeholder="Entrer nom">
          </div>
          <div class="form-group col-md-6">
            <label for="InputPrenom">Prenom *</label>
            <input required type="text" class="form-control" id="InputPrenom" name="prenom" placeholder="Entrer prenom">
          </div>
        </div>
        
        <div class="row">
          <div class="form-group col-md-6">
            <label for="InputTelephone">Telephone *</label>
            <input required type="number" class="form-control" id="InputTelephone" name="telephone" placeholder="Entrer telephone">
          </div>
          <div class="form-group col-md-6">
            <label for="InputEmail">Email</label>
            <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Entrer email">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-6">
            <label for="InputAdresse">Adresse *</label>
            <input required type="text" class="form-control" id="InputAdresse" name="adresse" placeholder="Entrer adresse">
          </div>

          <div class="form-group col-md-6">
            <label for="InputIFU">IFU</label>
            <input type="text" class="form-control" id="InputIFU" name="ifu" placeholder="Entrer IFU">
          </div>
        </div>
        <button type="submit" class="btn btn-primary float-right">Enregister</button>
    </form>
  </div>
</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
<script src="{{ asset('dashboard/customjs/checkIfUserExist.js')}}"></script>

<script>
document.getElementById('InputTelephone').addEventListener("change", function(event){
    event.preventDefault();
    checkTelephone2('#InputTelephone');
});
</script>
@endsection
