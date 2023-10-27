@extends('layouts.dash')
@section('pagetitle', "Super-Marchands")

@section('styles')

@endsection

@section('content')
      <div class="row">
        <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Super-Marchands</h3>
        </div>
        <div class="card-body">
            <div class="">


            <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nom Prenom</th>
                    <th>Telephone</th>
                    <th>Reference</th>
                    <th>Departement</th>
                    <th>Marchands</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($supermarchands as $u)
                      <tr>
                          <td>{{$u->fullname}}</td>
                          <td>{{$u->telephone}}</td>
                          <td>{{$u->super_marchand->first()->reference}}</td>
                          <td>{{$u->commune->departement->nom}}</td>
                          <td class="d-none d-sm-table-cell text-center p-1">
                            <div class="mx-auto">
                                <a href="{{route('directions.point_marchands', $u->super_marchand->first()->reference)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                                {{$u->super_marchand->first()->marchands->count() }}
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


