@extends('layouts.dash')
@section('pagetitle', 'Utilisateurs')
@section('content')
      <div class="row">
      <div class="col-12">
      <section class="content">
      <div class="container-fluid">

         <div class="row">
                <div class="col-12">
                <div class="card card-body card-outline">
                  <h4>Super-Marchand</h4>

                    <div class="post">
                      <div class="user-block row">
                        <div class="col-md-6">
                        <ul class="list-group  mb-3">
                        <li class="list-group-item">
                          <b>Nom</b> <a class="float-right">{{$superMarchand->users->first()->fullname}}</a>
                        </li>
                        <li class="list-group-item d-none">
                          <b>Etat</b> <a class="float-right">{{$superMarchand->users->first()->actif ? 'Actif':"Non Actif"}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Adresse</b> <a class="float-right">{{$superMarchand->users->first()->adresse}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Téléphone</b> <a class="float-right">{{$superMarchand->users->first()->telephone}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Email</b> <a class="float-right">{{$superMarchand->users->first()->email}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Sexe</b> <a class="float-right">{{$superMarchand->users->first()->sexe}}</a>
                        </li>
                        </ul>
                      </div>
                      <div class="col-md-6">
                      <ul class="list-group  mb-3">
                        <li class="list-group-item">
                          <b>IFU</b> <a class="float-right">{{$superMarchand->users->first()->ifu}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Date de naissance</b> <a class="float-right">{{$superMarchand->users->first()->date_naissance}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Situation matrimoniale</b> <a class="float-right">{{$superMarchand->users->first()->situation_matrimoniale}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Employeur</b> <a class="float-right">{{$superMarchand->users->first()->employeur}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Rôle(s)</b> <a class="float-right">
                        <span class="badge badge-primary">{{ $superMarchand->users->first()->getRoleNames()[0]}}</span>
                    </a>
                  </li>
                  <li class="list-group-item">
                    <b>Commune</b> <a class="float-right">
                      {{ $superMarchand->users->first()->commune->nom }}
                    </a>
                  </li>
                    </ul>
                      </div>
                      </div>

                    </div>



                </div>
              </div>


        <!-- /.row -->

    </section>

    </div>
@endsection

@section('js')
<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('dashboard/dist/js/adminlte.min.js')}}"></script>
<script> $(function () { $("#example1").DataTable(); }); </script>
@endsection
