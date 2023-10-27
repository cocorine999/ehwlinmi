@extends('layouts.dash')
@section('pagetitle', "Prospects")

@section('styles')

@endsection

@section('content')


      <div class="row">
        <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Prospects</h3>
            <div class="card-tools">
                <a href="{{route('prospects.create')}}" type="button" class="btn btn-primary float-right" title="Ajouter un utilisateur">
                    <i class="fas fa-plus"></i> Ajouter un prospect</a>
            </div>
        </div>
        <div class="card-body">
            <div class="">


            <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nom Prenom</th>
                    <th>Telephone</th>
                    <th>Commune</th>

                    <th>Créé le</th>
                    <th>Description</th>
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  @foreach ($prospects as $prospect)
                      <tr>
                          <td>{{$prospect->nom}} {{$prospect->prenom}}</td>
                          <td>{{$prospect->telephone}}</td>
                          <td>{{$prospect->commune->nom}}</td>
                          <td>{{$prospect->created_at}}</td>
                          <td>{{$prospect->description}}</td>

                          <!-- <td class="d-none d-sm-table-cell text-center p-1">
                            <div class="mx-auto">
                                <a href="{{route('prospects.edit', $prospect)}}" class="mx-0 btn btn-sm btn-warning" data-toggle="tooltip" title="Modifier">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                            </div>
                          </td> -->
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


