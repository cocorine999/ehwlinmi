@extends('layouts.dash')
@section('pagetitle', "Détail du Sinistre")
@section('styles')

<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="row">
  <div class="col-12">
                <div class="card card-body card-outline">
                  <h4>Sinistres</h4>

                    <div class="post">
                      <div class="user-block row">
                        <div class="col-md-8">
                        <ul class="list-group  mb-3">
                        <li class="list-group-item">
                          <b>Numéro de police</b> <a class="float-right">{{$sinistre->contrat->first()->reference}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Client </b> <a class="float-right">{{$sinistre->client->first()->users->first()->getFullNameAttribute()}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Adresse</b> <a class="float-right">{{$sinistre->client->first()->users->first()->adresse}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Téléphone</b> <a class="float-right">{{$sinistre->client->first()->users->first()->telephone}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Email</b> <a class="float-right">{{$sinistre->client->first()->users->first()->email}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Date de création</b> <a class="float-right">{{$sinistre->date_sinistre}}</a>
                        </li>

                         <li class="list-group-item">
                          <b>Description</b> <a class="float-right">{{$sinistre->description}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Statut</b> <span class="badge badge-primary float-right">{{$sinistre->statut}}</span>
                        </li>
                        </ul>
                        @if($sinistre->statut != 'Terminé' && Auth::user()->getRoleNames()[0] == "Direction" )

                        <a href="{{ route('sinistres.terminer', $sinistre->id) }}" class="btn btn-primary btn-block" ><b>Terminer le sinistre</b></a>

                        @endif

                <!-- /.modal-dialog -->
              </div>

</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('dashboard/customjs/x.js')}}" type="text/javascript"></script>

<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
@endsection
