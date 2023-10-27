@extends('layouts.dash')
@section('pagetitle', "Générer un état")
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card card-default">
         <div class="card-body">
            <form autocomplete="off" action="{{ route('etats.generate') }}" method="POST" role="form" >
               @csrf
               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="prime">Date de debut</label>
                        <input required type="date" class="form-control" id='datetimepicker4' name="debut" placeholder="date de debut">
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="prime">Date de fin</label>
                        <input required type="date" class="form-control" id="fin" name="fin" placeholder="Date de fin">
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="form-group">
                        <select name="etat" id="etat" class="form-control" required>
                          <option value="" selected disabled>Selectionnez votre etat</option>
                          <option value="global">Production Globale</option>
                           <option value="production_nsia">Production NSIA</option>
                           <option value="utilisateur">Utilisateurs</option>
                           <option value="productionmetsm">Production Marchand et SuperMarchand </option>
                           <option value="primes">Primes</option>
                        </select>
                     </div>
                  </div>
                  <input type="submit" value="Générer état" class=" mx-auto btn btn-info btn-lg">
               </div>
            </form>
            <hr>
         </div>
      </div>
   </div>
</div>
@endsection
