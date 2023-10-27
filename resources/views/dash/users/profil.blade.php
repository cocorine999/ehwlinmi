@extends('layouts.dash')
@section('pagetitle', "Profil")
@section('styles')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="row">
  <div class="col-md-8 float-center">
    <div class="col-md-8 float-right">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <div class="image">
              <img src="{{ asset('dashboard/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
          </div>
          <h3 class="profile-username text-center">{{ $user->getFullNameAttribute()}}</h3>
          <p class="text-muted text-center"> {{$user->profession}}</p>
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item d-none">
              <b>Etat</b> <a class="float-right">{{$user->actif ? 'Actif':"Non Actif"}}</a>
            </li>
            <li class="list-group-item">
              <b>Référence</b> <a class="float-right">{{$user->reference}}</a>
            </li>
            <li class="list-group-item">
              <b>Adresse</b> <a class="float-right">{{$user->adresse}}</a>
            </li>
            <li class="list-group-item">
              <b>Téléphone</b> <a class="float-right">{{$user->telephone}}</a>
            </li>
            <li class="list-group-item">
              <b>Email</b> <a class="float-right">{{$user->email}}</a>
            </li>
            <li class="list-group-item">
              <b>Sexe</b> <a class="float-right">{{$user->sexe}}</a>
            </li>
            <li class="list-group-item">
              <b>IFU</b> <a class="float-right">{{$user->ifu}}</a>
            </li>
            <li class="list-group-item">
              <b>Date de naissance</b> <a class="float-right">{{$user->date_naissance}}</a>
            </li>
            <li class="list-group-item">
              <b>Situation matrimoniale</b> <a class="float-right">{{$user->situation_matrimoniale}}</a>
            </li>
            <li class="list-group-item">
              <b>Employeur</b> <a class="float-right">{{$user->employeur}}</a>
            </li>
            <li class="list-group-item">
              <b>Rôle(s)</b> <a class="float-right">
                @foreach($user->getRoleNames() as $r)
                <span class="badge badge-primary">{{$r}}</span>
                @endforeach
              </a>
            </li>
            <li class="list-group-item">
              <b>Commune</b> <a class="float-right">
                {{$user->commune->nom}}
              </a>
            </li>
            <li class="list-group-item">
              <b>Créé le</b> <a class="float-right">
                {{$user->created_at}}
              </a>
            </li>
            {{--  @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.smarchand').'|'.config('custom.roles.marchand'))
        @if($user->direction->first() != null )
        @elseif($user->marchand->first()->personne == "morale")
        <li class="list-group-item">
          <b>Entreprise </b> <a class="float-right">
          {{$user->marchand->first()->entreprise }}
            </a>
            </li>
            <li class="list-group-item">
              <b>Registre </b> <a class="float-right">
                {{$user->marchand->first()->registre }}
              </a>
            </li>
            <li class="list-group-item">
              <b>Reference </b> <a class="float-right">
                {{$user->marchand->first()->reference }}
              </a>
            </li>
            @elseif($user->super_marchand->first()->personne == "morale")
            <li class="list-group-item">
              <b>Entreprise </b> <a class="float-right">
                {{$user->super_marchand->first()->entreprise }}
              </a>
            </li>
            <li class="list-group-item">
              <b>Registre </b> <a class="float-right">
                {{$user->super_marchand->first()->registre }}
              </a>
            </li>
            <li class="list-group-item">
              <b>Reference </b> <a class="float-right">
                {{$user->super_marchand->first()->reference }}
              </a>
            </li>
            @endif
            @endhasanyrole --}}
          </ul>
          @hasanyrole(config('custom.roles.direction')."|".config('custom.roles.direction_C')."|".config('custom.roles.ITMMS'))
          <a href="{{route('utilisateurs.edit', $user->id)}}" class="btn btn-info btn-block"><b>Modifier</b></a>
          <a href="{{route('utilisateurs.transferall', $user->id)}}" class="btn btn-warning btn-block my-2">Transférer
            contrats</a>
          @if(Auth::id() != $user->id)
          <form action="{{route('utilisateurs.status')}}" method="POST" role="form">
            @csrf
            <input value="{{$user->id}}" class="form-control d-none" name="user_id">
            <button type="submit"
              class="btn btn-danger btn-block float-right">{{ $user->banned_until ? "Activer le compte" : "Désactiver le compte" }}
            </button>
          </form>
          @endif
          @endhasanyrole
          @if(Auth::id() == $user->id)
          <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-default"><b>Changer mot
              de
              passe</b></a>
          @endif
        </div>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Changer mot de passe</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form autocomplete="off" action="{{route('utilisateurs.changePassword')}}" method="POST"
                  enctype="multipart/form-data" role="form">
                  @csrf
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>Ancien mot de passe</label>
                        <input required type="password" class="form-control" name="oldPassword"
                          placeholder="Ancien mot de passe">
                      </div>
                      <div class="form-group">
                        <label>Nouveau mot de passe</label>
                        <input required type="password" class="form-control" name="newPassword"
                          placeholder="Nouveau mot de passe">
                      </div>
                      <div class="form-group">
                        <label>Confirmer mot de passe</label>
                        <input required type="password" class="form-control" name="confirmPassword"
                          placeholder="Confirmer mot de passe">
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Enregister</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <!-- About Me Box -->
      <!-- /.card -->
    </div>
    <div class="col-md-9 d-none">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            @foreach($user->getRoleNames() as $r)
            <li class="nav-item">
              <a class="nav-link" id="pills-{{$r}}-tab" data-toggle="pill" href="#pills-{{$r}}" role="tab"
                aria-controls="pills-{{$r}}" aria-selected="false">{{$r}}</a>
            </li>
            @endforeach
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-Direction" role="tabpanel" aria-labelledby="pills-Direction-tab">
              <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-user-plus"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Clients Actifs</span>
                      <span class="info-box-number">{{ $clientActif }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-user-plus"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">SuperMarchands</span>
                      <span class="info-box-number">{{ $supermarchand }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-user-plus"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Marchands</span>
                      <span class="info-box-number">{{ $marchand }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-purple"><i class="fa fa-wallet"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Solde principal</span>
                      <span class="info-box-number">0{{-- Auth::user()->getWallet('principal')->balance --}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-teal"><i class="fa fa-wallet"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Solde commission</span>
                      <span class="info-box-number">0{{-- Auth::user()->getWallet('commission') --}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
              </div>
            </div>
            <div class="tab-pane fade" id="pills-SuperMarchand" role="tabpanel"
              aria-labelledby="pills-SuperMarchand-tab">
              <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-user-plus"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Marchands</span>
                      @if($user->getRoleNames()[0]== "SuperMarchand")
                      <span class="info-box-number">{{ $marchands }}</span>
                      @endif
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-wallet"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Solde principal</span>
                      <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-wallet"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Solde commission</span>
                      <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <div class="tab-pane fade" id="pills-Marchand" role="tabpanel" aria-labelledby="pills-Marchand-tab">
              <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fab fa-buffer"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Contrats</span>
                      <span class="info-box-number">{{ $contratsMarchand }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-wallet"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Solde principal</span>
                      <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa fa-wallet"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Solde commission </span>
                      <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
              </div>
            </div>
            <div class="tab-pane fade" id="pills-Client" role="tabpanel" aria-labelledby="pills-Client-tab">
              <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fab fa-buffer"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Contrats</span>
                      <span class="info-box-number">{{ $contratsClient }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Mois soldé</span>
                      <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Mois restant</span>
                      <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <div class="tab-pane fade" id="pills-Assuré" role="tabpanel" aria-labelledby="pills-Assuré-tab">
              <div class="col-md-8">
                <ul class="list-group  mb-3">
                  <li class="list-group-item">
                    {{-- dd() --}}
                    @if($user->hasRole(config('custom.roles.assure')))
                    <b>Date de début de contrats</b>
                    <a class="float-right">{{ $user->assure->first()->contrats->first()->created_at }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Date de fin de contrats</b>
                    <a
                      class="float-right">{{ $user->assure->first()->contrats->first()->date_fin ? $user->assure->first()->contrats->first()->date_fin:'Non définie' }}</a>
                  </li>
                  {{--
          <li class="list-group-item">
            <b>Photo de la pièce</b> <a class="float-right"></a>
          </li>
          --}}
                  <li class="list-group-item">
                    <b>Nombre de bénéficiaire</b> <a class="float-right">{{$nbreBeneficiaire}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Date de naissance</b> <a class="float-right">{{$user->date_naissance}}</a>
                  </li>
                  @endif
                </ul>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-Beneficiaire" role="tabpanel" aria-labelledby="pills-Beneficiaire-tab">
              <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fab fa-buffer"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Contrats</span>
                      <span class="info-box-number">{{ $contratsClient }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
              </div>
            </div>
            <div class="tab-pane fade" id="pills-Nsia" role="tabpanel" aria-labelledby="pills-Nsia-tab">Contenu Nsia
            </div>
            <div class="tab-pane fade" id="pills-Visiteur" role="tabpanel" aria-labelledby="pills-Visiteur-tab">Contenu
            </div>
          </div>
        </div>
        <div></div>
        @endsection
        @section('js')
        <script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
        <script src="{{ asset('dashboard/customjs/x.js')}}" type="text/javascript"></script>
        <script>
          $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})});
        </script>
        @endsection
