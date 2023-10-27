@extends('layouts.dash')
@section('pagetitle', "Liste Globale")

@section('styles')

@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
      @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))
      <li class="nav-item"><a class="nav-link" id="custom-content-above-all-tab" data-toggle="pill" href="#custom-content-above-all" role="tab" aria-controls="custom-content-above-all" aria-selected="true">Tous</a></li>
      <li class="nav-item"><a class="nav-link" id="custom-content-above-direction-tab" data-toggle="pill" href="#custom-content-above-direction" role="tab" aria-controls="custom-content-above-direction" aria-selected="false">Direction</a></li>
      @endhasanyrole
      @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all').'|'.config('custom.roles.smarchand'))
      <li class="nav-item"><a class="nav-link" id="custom-content-above-smarchand-tab" data-toggle="pill" href="#custom-content-above-smarchand" role="tab" aria-controls="custom-content-above-smarchand" aria-selected="false">Super-Marchands</a></li>
      @endhasanyrole
      @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all').'|'.config('custom.roles.smarchand').'|'.config('custom.roles.marchand'))
      <li class="nav-item"><a class="nav-link" id="custom-content-above-marchand-tab" data-toggle="pill" href="#custom-content-above-marchand" role="tab" aria-controls="custom-content-above-marchand" aria-selected="false">Marchands</a></li>
      <li class="nav-item"><a class="nav-link" id="custom-content-above-client-tab" data-toggle="pill" href="#custom-content-above-client" role="tab" aria-controls="custom-content-above-client" aria-selected="false">Clients</a></li>
      <li class="nav-item"><a class="nav-link" id="custom-content-above-assure-tab" data-toggle="pill" href="#custom-content-above-assure" role="tab" aria-controls="custom-content-above-assure" aria-selected="false">Assurés</a></li>
      <li class="nav-item"><a class="nav-link" id="custom-content-above-beneficiaire-tab" data-toggle="pill" href="#custom-content-above-beneficiaire" role="tab" aria-controls="custom-content-above-beneficiaire" aria-selected="false">Bénéficiaires</a></li>
      <li class="nav-item"><a class="nav-link" id="custom-content-above-nsia-tab" data-toggle="pill" href="#custom-content-above-nsia" role="tab" aria-controls="custom-content-above-nsia" aria-selected="false">NSIA Vie</a></li>
      @endhasanyrole
    </ul>
    <div class="tab-content" id="custom-content-above-tabContent">
      <div class="tab-pane fade show" id="custom-content-above-all" role="tabpanel" aria-labelledby="custom-content-above-all-tab">
        <div class="tab-custom-content">
          <p class="lead mb-0">Liste de tous les utilisateurs</p>
        </div>
        <hr>
        <table id="exampleall" class="table table-bordered table-hover data-table">
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
            @foreach ($users as $user)
            <tr>
              <td>{{$user->fullname}}</td>
              <td>{{$user->telephone}}</td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </td>
              <td class="d-none d-sm-table-cell text-center p-all">
                <div class="mx-auto">
                  <a href="{{route('direction.utilisateurs.profil', $user)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                    <i class="fa fa-fw fa-eye"></i>
                  </a>
                @hasanyrole(config('custom.roles.direction'))
                  <a href="{{route('utilisateurs.edit', $user)}}" class="mx-0 btn btn-sm btn-success" data-toggle="tooltip" title="Modifier">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                @endhasanyrole
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="custom-content-above-direction" role="tabpanel" aria-labelledby="custom-content-above-direction-tab">
        <div class="tab-custom-content">
          <p class="lead mb-0">Liste des utilisateurs de la Direction</p>
        </div>
        <hr>
        <table id="direction" class="table table-bordered table-hover data-table">
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
            @foreach ($directions as $user)
            <tr>
              <td>{{$user->fullname}}</td>
              <td>{{$user->telephone}}</td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </td>
              <td class="d-none d-sm-table-cell text-center p-all">
                <div class="mx-auto">
                  <a href="{{route('direction.utilisateurs.profil', $user)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                    <i class="fa fa-fw fa-eye"></i>
                  </a>
                  @hasanyrole(config('custom.roles.direction'))
                  <a href="{{route('utilisateurs.edit', $user)}}" class="mx-0 btn btn-sm btn-success" data-toggle="tooltip" title="Modifier">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                @endhasanyrole
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="custom-content-above-smarchand" role="tabpanel" aria-labelledby="custom-content-above-smarchand-tab">
        <div class="tab-custom-content">
          <p class="lead mb-0">Liste des Super-Marchands
          </p>
        </div>
        <hr>
        <table id="smarchand" class="table table-bordered table-hover data-table">
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
            @foreach ($supermarchands as $user)
            <tr>
              <td>{{$user->fullname}}</td>
              <td>{{$user->telephone}}</td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </td>
              <td class="d-none d-sm-table-cell text-center p-all">
                <div class="mx-auto">
                  <a href="{{route('direction.utilisateurs.profil', $user)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                    <i class="fa fa-fw fa-eye"></i>
                  </a>
                  @hasanyrole(config('custom.roles.direction'))
                  <a href="{{route('utilisateurs.edit', $user)}}" class="mx-0 btn btn-sm btn-success" data-toggle="tooltip" title="Modifier">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                @endhasanyrole
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="custom-content-above-marchand" role="tabpanel" aria-labelledby="custom-content-above-marchand-tab">
        <div class="tab-custom-content">
          <p class="lead mb-0">Liste des Marchands</p>
        </div>
        <hr>
        <table id="marchand" class="table table-bordered table-hover data-table">
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
            @foreach ($marchands as $user)
            <tr>
              <td>{{$user->fullname}}</td>
              <td>{{$user->telephone}}</td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </td>
              <td class="d-none d-sm-table-cell text-center p-all">
                <div class="mx-auto">
                  <a href="{{route('direction.utilisateurs.profil', $user)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                    <i class="fa fa-fw fa-eye"></i>
                  </a>
                  @hasanyrole(config('custom.roles.direction'))
                  <a href="{{route('utilisateurs.edit', $user)}}" class="mx-0 btn btn-sm btn-success" data-toggle="tooltip" title="Modifier">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                @endhasanyrole
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="custom-content-above-client" role="tabpanel" aria-labelledby="custom-content-above-client-tab">
        <div class="tab-custom-content">
          <p class="lead mb-0">Liste des Clients</p>
        </div>
        <hr>
        <table id="exampleall" class="table table-bordered table-hover data-table">
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
            @foreach ($clients as $user)
            <tr>
              <td>{{$user->fullname}}</td>
              <td>{{$user->telephone}}</td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </td>
              <td class="d-none d-sm-table-cell text-center p-all">
                <div class="mx-auto">
                  <a href="{{route('direction.utilisateurs.profil', $user)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                  <i class="fa fa-fw fa-eye"></i>
                  </a>
                  @hasanyrole(config('custom.roles.direction'))
                  <a href="{{route('utilisateurs.edit', $user)}}" class="mx-0 btn btn-sm btn-success" data-toggle="tooltip" title="Modifier">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                  @endhasanyrole
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="custom-content-above-assure" role="tabpanel" aria-labelledby="custom-content-above-assure-tab">
        <div class="tab-custom-content">
          <p class="lead mb-0">Liste des Assurés</p>
        </div>
        <hr>
        <table id="assures" class="table table-bordered table-hover data-table">
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
            @foreach ($assures as $user)
            <tr>
              <td>{{$user->fullname}}</td>
              <td>{{$user->telephone}}</td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </td>
              <td class="d-none d-sm-table-cell text-center p-all">
                <div class="mx-auto">
                  <a href="{{route('direction.utilisateurs.profil', $user)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                    <i class="fa fa-fw fa-eye"></i>
                  </a>
                  @hasanyrole(config('custom.roles.direction'))
                  <a href="{{route('utilisateurs.edit', $user)}}" class="mx-0 btn btn-sm btn-success" data-toggle="tooltip" title="Modifier">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                @endhasanyrole
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="custom-content-above-beneficiaire" role="tabpanel" aria-labelledby="custom-content-above-beneficiaire-tab">
        <div class="tab-custom-content">
          <p class="lead mb-0">Liste des Bénéficiaires</p>
        </div>
        <hr>
        <table id="beneficiaires" class="table table-bordered table-hover data-table">
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
            @foreach ($beneficiaires as $user)
            <tr>
              <td>{{$user->fullname}}</td>
              <td>{{$user->telephone}}</td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </td>
              <td class="d-none d-sm-table-cell text-center p-all">
                <div class="mx-auto">
                  <a href="{{route('direction.utilisateurs.profil', $user)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                    <i class="fa fa-fw fa-eye"></i>
                  </a>
                  @hasanyrole(config('custom.roles.direction'))
                  <a href="{{route('utilisateurs.edit', $user)}}" class="mx-0 btn btn-sm btn-success" data-toggle="tooltip" title="Modifier">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                @endhasanyrole
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="custom-content-above-nsia" role="tabpanel" aria-labelledby="custom-content-above-nsia-tab">
        <div class="tab-custom-content">
          <p class="lead mb-0">Liste des utilisateurs de NSIA Vie</p>
        </div>
        <hr>
        <table id="nsia" class="table table-bordered table-hover data-table">
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
            @foreach ($nsia as $user)
            <tr>
              <td>{{$user->fullname}}</td>
              <td>{{$user->telephone}}</td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </td>
              <td class="d-none d-sm-table-cell text-center p-all">
                <div class="mx-auto">
                  <a href="{{route('direction.utilisateurs.profil', $user)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                    <i class="fa fa-fw fa-eye"></i>
                  </a>
                  @hasanyrole(config('custom.roles.direction'))
                  <a href="{{route('utilisateurs.edit', $user)}}" class="mx-0 btn btn-sm btn-success" data-toggle="tooltip" title="Modifier">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                @endhasanyrole
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="custom-content-above-visiteur" role="tabpanel" aria-labelledby="custom-content-above-visiteur-tab">
        <div class="tab-custom-content">
          <p class="lead mb-0">Liste des visiteurs</p>
        </div>
        <hr>
        <table id="exampleall" class="table table-bordered table-hover data-table">
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
            @foreach ($users as $user)
            <tr>
              <td>{{$user->fullname}}</td>
              <td>{{$user->telephone}}</td>
              <td>{{$user->email}}</td>
              <td>
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </td>
              <td class="d-none d-sm-table-cell text-center p-all">
                <div class="mx-auto">
                  <a href="{{route('direction.utilisateurs.profil', $user)}}" class="mx-0 btn btn-sm btn-primary" data-toggle="tooltip" title="Voir">
                    <i class="fa fa-fw fa-eye"></i>
                  </a>
                  @hasanyrole(config('custom.roles.direction'))
                  <a href="{{route('utilisateurs.edit', $user)}}" class="mx-0 btn btn-sm btn-success" data-toggle="tooltip" title="Modifier">
                    <i class="fa fa-fw fa-edit"></i>
                  </a>
                @endhasanyrole
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
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
@endsection
