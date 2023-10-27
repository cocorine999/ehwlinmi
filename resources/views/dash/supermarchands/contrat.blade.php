@extends('layouts.dash')
@section('pagetitle', "Contrats")

@section('styles')

@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contrats</h3>
            @hasanyrole(config('custom.roles.client').'|'.config('custom.roles.marchand').'|'.config('custom.roles.assure'))
            <div class="card-tools">
                <a href="{{route('contrats.create')}}" type="button" class="btn btn-primary float-right" title="Ajouter un marchand">
                    <i class="fas fa-plus"></i> Ajouter un contrat</a>
            &nbsp;&nbsp;
            </div>

            @endhasanyrole
            
            @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
            <form  action="{{route('exportContrat')}}" method="POST" role="form" >
               @csrf
               <input  value="{{$data}}"  class="form-control d-none"  name="data" >
               <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-excel"></i> Exporter en Excel</button>
            </form>
            @endhasanyrole
         <div class="card-tools mr-2">
         @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
          <form  action="{{route('exportPdfContratM')}}" method="POST" role="form" >
               @csrf
            <input  value="{{$data}}"  class="form-control d-none"  name="data" >
            <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-pdf"></i> Exporter en PDF</button>
         </form>
         @endhasanyrole
        </div>
        </div>
        <div class="card-body">
            <div class="">

            <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Numéro de police</th>
                    <th>Souscripteur</th>
                    <th>Assuré</th>
                    <th>Statut</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @if($contrats)
                  @foreach ($contrats as $key=>$contrat)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$contrat->reference}}</td>
                       {{--   <td>{{ $contrat->marchand->users()->first()->getFullNameAttribute() }}</td>  --}}
                        <td>{{ $contrat->client->users()->first()->getFullNameAttribute() }}</td>
                        <td>{{ $contrat->assure->users()->first()->getFullNameAttribute() }}</td>
                        <td><span class="badge badge-primary">{{$contrat->statut}}</span></td>
                        <td class="d-none d-sm-table-cell text-center p-1">
                          <div class="mx-auto">
                              <a href="{{route('contrats.show', $contrat->reference)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                                <i class="fa fa-fw fa-eye"></i>
                              </a>
                          </div>
                        </td>
                    </tr>
                  @endforeach
                @else
                    <tr>
                      <td class="" colspan="5">Pas de contrats disponibles</td>
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


