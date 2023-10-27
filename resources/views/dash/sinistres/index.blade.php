@extends('layouts.dash')
@section('pagetitle', "Sinistres")

@section('styles')

@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sinistres</h3>
             @role(config('custom.roles.client'))
            <div class="card-tools">
                <a href="{{route('sinistres.create')}}" type="button" class="btn btn-primary float-right" title="Ajouter un marchand">
                    <i class="fas fa-plus"></i> Signaler un sinistre</a>
            </div>
            @endrole
        </div>
        <div class="card-body">
            <div class="">
              <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Client</th>
                      <th>Numéro de police</th>
                      <th>Date du sinistre</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($sinistres)
                    @foreach ($sinistres as $contrat)
                      <tr>
                          <td>{{$contrat->client->first()->users->first()->getFullNameAttribute()}}</td>
                          <td>{{ $contrat->reference }}</td>
                          <td>{{ $contrat->sinistre->date_sinistre }}</td>
                          <td class="d-none d-sm-table-cell text-center p-1">
                            <div class="mx-auto">
                                <a href="{{route('sinistres.show', $contrat)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                                  <i class="fa fa-fw fa-eye"></i>
                                </a>
                            </div>
                          </td>
                      </tr>
                    @endforeach
                  @else
                      <tr>
                        <td class="" colspan="5">Pas de sinistres disponibles</td>
                      </tr>
                  @endif
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


