@extends('layouts.dash')
@section('pagetitle', "Marchands")

@section('styles')

@endsection

@section('content')
      <div class="row">
        <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Marchands</h3>
        </div>
        <div class="card-body">
            <div class="">


            <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nom Prenom</th>
                    <th>Telephone</th>
                    <th>Reference</th>
                    <th>Commune</th>
                    <th>Contrats</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($marchands as $m)
                      <tr>
                          <td>{{$m->users->first()->fullname}}</td>
                          <td>{{$m->users->first()->telephone}}</td>
                          <td>{{$m->reference}}</td>
                          <td>{{$m->users->first()->commune->nom}}</td>
                          <td class="d-none d-sm-table-cell text-center p-1">
                            <div class="mx-auto">
                                <a href="{{route('directions.point_contrats', $m->reference) }}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                                {{ $m->contrats->count() }}
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


