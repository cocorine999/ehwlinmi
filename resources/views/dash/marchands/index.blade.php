@extends('layouts.dash')
@section('pagetitle', "Mes Marchands")

@section('styles')

@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mes Marchands</h3>
            <div class="card-tools">
                <a href="{{route('utilisateurs.create')}}" type="button" class="btn btn-primary float-right" title="Ajouter un marchand">
                    <i class="fas fa-plus"></i> Ajouter un marchand</a>
            </div>
        </div>
        <div class="card-body">
            <div class="">


            <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nom Prenom</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Role(s)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($marchands as $marchand)
                    <tr>
                        <td>{{$marchand->users->first()->fullname}}</td>
                        <td>{{$marchand->users->first()->telephone}}</td>
                        <td>{{$marchand->users->first()->email}}</td>
                        <td>
                            @foreach($marchand->users->first()->getRoleNames() as $r)
                                <span class="badge badge-primary">{{$r}}</span>
                            @endforeach
                        </td>
                        <td class="d-none d-sm-table-cell text-center p-1">
                          <div class="mx-auto">
                              <a href="{{route('marchands.show', $marchand)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                                <i class="fa fa-fw fa-eye"></i>
                              </a>
                          </div>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>

              </div>
          </div>
        </div>
    </div>
@endsection

@section('js')

@endsection


