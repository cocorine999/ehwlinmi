@extends('layouts.dash')
@section('pagetitle', "Tableau de bord")
@section('style')
@endsection
@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<div class="card">
    <div class="card-body">

        <h3>Bienvenue
        @if(Auth::user()->sexe == "Masculin")
        M.
        @elseif(Auth::user()->sexe == "Feminin")
        Mme
        @endif
        {{Auth::user()->shortFullName}} </h3>
        <hr class="mb-4">

        @hasanyrole(config('custom.roles.direction_all').'|'.config('custom.roles.nsia_all'))

        <div class="row">
            <div class="d-none col-md-6 col-lg-4">Solde principal NSIA :  <b>{{ \App\User::role(config('custom.roles.nsia'))->first()->getWallet('principal')->balance / config('custom.points.coefficient') }} FCFA</b></div>
            <div class="col-md-6 col-lg-4">Solde commission NSIA : <b>{{ \App\User::role(config('custom.roles.nsia'))->first()->getWallet('commission')->balance / config('custom.points.coefficient') }} FCFA</b></div>
        </div>

        <div class="row">
            <div class="d-none col-md-6 col-lg-4">Solde principal MMS :  <b>{{ \App\User::role(config('custom.roles.direction'))->first()->getWallet('principal')->balance / config('custom.points.coefficient') }} FCFA</b></div>
            <div class="col-md-6 col-lg-4">Solde commission MMS : <b>{{ \App\User::role(config('custom.roles.direction'))->first()->getWallet('commission')->balance / config('custom.points.coefficient') }} FCFA</b></div>
        </div>

        <hr class="mb-4">
        <div class="row">
            @hasanyrole(config('custom.roles.direction'))

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ \App\User::role(config('custom.roles.direction'))->first()->getWallet('principal')->balance / config('custom.points.coefficient') }}</h3>
                            <p>Montant Adhésions</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-wallet"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $commissions_sm }}</h3>
                            <p>Commissions Super-Marchands</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-wallet"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $commissions_m }}</h3>
                            <p>Commissions Marchands</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-wallet"></i>
                        </div>
                    </div>
                </div>
            @endhasanyrole

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $users }}</h3>
                        <p>Utilisateurs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $clients }}</h3>
                        <p>Souscripteurs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $assures }}</h3>
                        <p>Assurés</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $beneficiaires }}</h3>
                        <p>Beneficiaires</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $departements }}</h3>
                        <p>Départements</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-map-marked"></i>
                    </div>
                </div>
            </div>
                <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $commune }}</h3>
                        <p>Communes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsPaiement }}</h3>
                        <p>Contrats en attente de paiement </p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsAttente }}</h3>
                        <p>Contrats en attente de traitement</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6 d-none">
                <!-- small card -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>0{{-- $contratsAttente --}}</h3>
                        <p>Contrats en attente de validation</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ $contratsValide }}</h3>
                        <p>Contrats valides</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $contratsRejete }}</h3>
                        <p>Contrats rejetés</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsSinistre }}</h3>
                        <p>Sinistres</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $contratsTermine }}</h3>
                        <p>Contrats terminés</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $nsia }}</h3>
                        <p>Utilisateur de NSIA Vie</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $directions }}</h3>
                        <p>Utilisateur de la direction</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $prospects }}</h3>
                        <p>Prospects</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ $supermarchands }}</h3>
                        <p>Supermarchands</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6 d-none">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{-- $soldes --}}</h3>
                        <p>Soldes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ $marchands }}</h3>
                        <p>Marchands</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>{{ $primes }}</h3>
                        <p>Primes</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        @endrole
       {{--   <hr>  --}}
         @hasanyrole(config('custom.roles.smarchand').'|'.config('custom.roles.marchand').'|'.config('custom.roles.client').'|'.config('custom.roles.assure'))
        <div class="row">
        @hasanyrole(config('custom.roles.smarchand'))
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $marchandSuperMarchand }}</h3>
                        <p>Marchands</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsPaiement }}</h3>
                        <p>Contrats en attente de paiement</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsAttente }}</h3>
                        <p>Contrats en attente de traitement</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ $contratsValide }}</h3>
                        <p>Contrats valides</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $contratsRejete }}</h3>
                        <p>Contrats rejetés</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsSinistre }}</h3>
                        <p>Sinistres</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $contratsTermine }}</h3>
                        <p>Contrats terminés</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $soldesprincipal }}</h3>
                        <p>Solde principal</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">

                        <h3>{{ Auth::user()->getWallet('commission') ? Auth::user()->getWallet('commission')->balance /10 : 0 }}</h3>
                        <p>Solde commission </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

          @endhasanyrole
        @hasanyrole(config('custom.roles.marchand'))
           <div class="col-lg-3 col-6 d-none">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $marchandSuperMarchand }}</h3>
                        <p>Marchands</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsAttente }}</h3>
                        <p>Contrats en attente de traitement</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsPaiement }}</h3>
                        <p>Contrats en attente de paiement</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ $contratsValide }}</h3>
                        <p>Contrats valides</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $contratsRejete }}</h3>
                        <p>Contrats rejetés</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ $contratsSinistre }}</h3>
                        <p>Sinistres</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $contratsTermine }}</h3>
                        <p>Contrats terminés</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>

            {{--
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $soldesprincipal }}</h3>
                        <p>Solde principal</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            --}}

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ Auth::user()->getWallet('commission') ? Auth::user()->getWallet('commission')->balance /10 : 0 }}</h3>
                        <p>Solde commission </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                </div>
            </div>
            @endhasanyrole
        @hasanyrole(config('custom.roles.client'))
           <div class="col-lg-3 col-6 d-none">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $marchandSuperMarchand }}</h3>
                        <p>Marchands</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsPaiement }}</h3>
                        <p>Contrats en attente de paiement</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsAttente }}</h3>
                        <p>Contrats en attente de traitement</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ $contratsValide }}</h3>
                        <p>Contrats valides</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $contratsRejete }}</h3>
                        <p>Contrats rejetés</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $contratsSinistre }}</h3>
                        <p>Sinistres</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $contratsTermine }}</h3>
                        <p>Contrats terminés</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-buffer"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6 d-none">
                <!-- small card -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $soldesprincipal ? $soldesprincipal:0 }}</h3>
                        <p>Solde principal</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6 d-none">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $soldescommission ? $soldescommission:0 }}</h3>
                        <p>Solde commission </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                </div>
            </div>
            @endhasanyrole
            <!-- ./col -->

            <!-- ./col -->
        </div>
    </div>
</div>
  @endrole
@endsection
@section('js')
@endsection
