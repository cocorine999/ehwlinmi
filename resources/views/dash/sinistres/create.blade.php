@extends('layouts.dash')
@section('pagetitle', "Sinistres")
@section('styles')

<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card card-default">
         <div class="card-header">
            <h3 class="card-title">Signaler un sinistre</h3>
         </div>
         <div class="card-body">

            <form autocomplete="off" action="{{route('sinistres.store')}}" method="POST" enctype="multipart/form-data" role="form" >
               @csrf
               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="ajaxInputReference" >Numéro de police</label>
                        <input required type="text" class="form-control" id="ajaxInputReference" name="reference"  placeholder="Numéro de police">
                        {{--  <input required type="text" class="form-control" id="ajaxInputReference" name="reference" onchange=checkReference(this) placeholder="Numéro de police">  --}}
                        {{--  <div id="ajaxInputReference-error"></div>
                        <div id="ajaxInputReference-sinistre-msg"></div>  --}}
                     </div>
                     </div>

                    <div class="col-sm-6">
                     <div class="form-group">
                        <label >Date du sinistre</label>
                        <input required type="date"  class="form-control"  name="date_sinistre" placeholder="Date du sinistre">
                     </div>
                     </div>
                     <div class="col-sm-6">
                     <div class="form-group">
                        <label>Cause/Description</label>
                        <textarea required type="text"  class="form-control" rows="3" name="description" placeholder="description"> </textarea>
                     </div>
                     </div>
                     </div>

              <div class="card-footer" id="ajaxInputReference-sinistre" >

                  <button type="submit"  class="btn btn-primary">Enregistrer</button>

               </div>
               </div>
            </form>

         </div>
      </div>

</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('dashboard/customjs/x.js')}}" type="text/javascript"></script>

<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
@endsection
