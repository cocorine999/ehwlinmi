@extends('layouts.dash')
@section('pagetitle', "Prospects")

@section('styles')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Modification de Prospect</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form autocomplete="off" action="{{route('prospects.update',$prospect)}}" method="PUT" role="form" >
                  @csrf
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input value="{{ $prospect->attr }}" -->
                      <div class="form-group">
		                   <label for="forNom">Nom</label>
		                   <input value="{{ $prospect->nom }}" type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
		              </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
		                   <label for="forPrenom">Prénom</label>
		                   <input value="{{ $prospect->prenom }}" type="text"  class="form-control" id="prenom" name="prenom" placeholder="Prenom">
		               </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input value="{{ $prospect->attr }}" -->
                      <div class="form-group">
	                    <label for="forTelephone">Téléphone</label>
	                    <input value="{{ $prospect->telephone }}" type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone">
	                  </div>
                    </div>
                    <div class="form-group col-md-6">
			            <label>Departement - Commune *</label>
			            <select required class="form-control select2bs4" name="commune_id">
			              <option value="" disabled>Choisissez une option...</option>
			              @foreach($communes as $c)
			                <option value="{{$c->id}}" {{$c->id == $prospect->commune->id ? "selected" : "" }} >{{$c->departement->nom}} - {{$c->nom}}</option>
			              @endforeach
			            </select>
			          </div>
                  </div>

                  <div class="card-footer">
                  	<button type="submit" class="btn btn-primary">Modifier</button>
                  </div>
                 
                </form>
              </div>
              

              
              
              
            </div>
            <!-- /.card -->
</div>
 
</div>
@endsection

@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
@endsection


