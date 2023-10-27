@extends('layouts.dash')
@section('pagetitle', "Détail du Contrat")
@section('styles')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="row">
  <div class="col-md-3">
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <p class="text-muted text-center">Contrat</p>
        <ul class="list-group list-group-unbordered mb-3">
          @hasanyrole(config('custom.roles.ITMMS'))
          <li class="list-group-item">
            <b>Id Contrat</b> <a class="float-right">{{$contrat->id}}</a>
          </li>
          @endhasanyrole
          <li class="list-group-item">
            <b>Reférence</b> <a class="float-right">{{$contrat->reference}}</a>
          </li>
          <li class="list-group-item">
            <b>Nom du marchand</b> <a
              class="float-right">{{$contrat->marchands->last()->users()->first()->getFullNameAttribute()}}</a>
          </li>
          <li class="list-group-item">
            <b>Téléphone</b> <a class="float-right">{{$contrat->marchands->last()->users()->first()->telephone}}</a>
          </li>
          <li class="list-group-item">
            <b>Date de création du contrat</b> <a class="float-right">{{$contrat->created_at}}</a>
          </li>
          <li class="list-group-item">
            <b>Primes</b> <span
              class="float-right badge badge-primary">{{$contrat->souscriptions->last()->primes->count()}}</span>
          </li>
          <li class="list-group-item">
            <b>Prime(s) payée(s)</b> <span
              class="float-right badge badge-primary">{{$contrat->souscriptions->last()->primes->count()}}</span>
          </li>
          @if(in_array($contrat->statut, ['Valide','Terminé' {{--'Rejeté', 'Sinistre',  'Résilié', 'Annulé'--}}]))
          <li class="list-group-item">
            <b>Date d'effet </b> <span class="float-right  text-success">{{$contrat->dateEffet}}</span>
          </li>
          <li class="list-group-item">
            <b>Date d'échéance</b> <span class="float-right  text-danger">{{$contrat->dateEffet->addYears(1)}}</span>
          </li>
          @endif
          <li class="list-group-item">
            {{--  <!-- <b>Etat Actuel</b> <span class="float-right badge badge-primary">{{\App\Models\StatutSouscription::find($contrat->souscriptions->last()->statut_souscriptions->last()->pivot->statut_contrat_id)->label}}</span>
            --> --}}
            <b>Etat Actuel</b> <span class="float-right badge badge-primary">{{$contrat->statut}}</span>
          </li>
          {{-- @forelse($contrat->souscriptions->last()->statut_souscriptions as $statut)
               <li class="list-group-item">
                  <b class="badge badge-primary">{{$statut->pivot->statut_contrat_id ?? ''}}</b> <span
            class="float-right">{{$statut->pivot->statut ?? ''}}</span><br>
          <b>Motif</b>:<span class="float-right">{{$statut->pivot->statut ?? ''}}</span>
          </li>
          @endforeach --}}
        </ul>

        {{-- @role(config('custom.roles.marchand'))
        @if($contrat->statut =="Attente de paiement" && auth()->user()->marchand->first()->id ==
        $contrat->marchands->last()->id )--}}
        @can('renouveller', $contrat)
        <button type="button" class="btn btn-success btn-block col-12" data-toggle="modal" data-target="#exampleModal">
          Renouveller le contrat
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Renouveller le contrat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="text-center text-warning">
                  Cher(e) client(e), vous venez de boucler un an de cotisation sur votre contrat.
                  Restez couvert en renouvelant votre adhésion.
                  <p>Assurez vous d'avoir au moins 1000 FCFA sur votre compte Mobile Money ou Moov Money pour les frais
                    de renouvellement.</p>

                </div>
                <form action="{{route('souscriptions.renouveller')}}" method="POST">
                  @csrf
                  <input type="text" value="{{$contrat->id}}" name="contrat_id" class="d-none">
                  @include('dash.components.paiementChoiceComponent')
                  <button type="submit" class="btn btn-primary float-right">
                    Valider
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        {{-- @endif
         @endrole --}}
        @endif
        <hr>

        @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.ITMMS').'|'.config('custom.roles.direction_FC'))
        <a href="{{ route('transactions.contrat_transactions', $contrat->reference) }}"
          class="btn btn-primary btn-block"><b>Voir transactions</b></a>
        @endhasanyrole
        @if($contrat->primes->count())
        <a href="{{ route('primes.contrat_primes', $contrat->reference) }}" class="btn btn-primary btn-block"><b>Voir
            primes</b></a>
        @endif
        @if($contrat->beneficiaires->count() == 0 && Auth::id() == $contrat->marchands->last()->users()->first()->id )
        <a href="{{ route('contrats.addBeneficiares', $contrat->reference) }}"
          class="btn btn-warning btn-block"><b>Ajouter des bénéficiaires</b></a>
        @else
        @hasanyrole(config('custom.roles.nsia').'|'.config('custom.roles.nsia1'))
        @if($contrat->statut =="Attente de traitement" )
        <a href="{{ route('contrats.valider', $contrat->id) }}" class="btn btn-primary btn-block"><b>Valider le
            contrat</b></a>
        <a href="{{ route('contrats.rejeter', $contrat->id) }}" class="btn btn-danger btn-block"><b>Rejeter le
            contrat</b></a>
        @endif
        @if($contrat->statut =="Valide" )
        <a href="{{ route('contrats.rejeter', $contrat->id) }}" class="btn btn-danger btn-block"><b>Rejeter le
            contrat</b></a>
        @endif
        @endhasanyrole

        <hr>
        @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.ITMMS'))
        @if ($contrat->statut !== "Résilié" && $contrat->statut !== "Annulé")
        @if ($contrat->statut !== "Résilié")
        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
          data-target="{{'#resilier'.$contrat->id}}">
          Résilier le contrat
        </button>
        <div class="modal fade" id="{{'resilier'.$contrat->id}}" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-danger">Résilier le contrat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('contrats.resilier')}}" method="POST">
                @csrf
                <div class="modal-body">
                  <div class="col-12">
                    <input type="hidden" name="contrat_id" value="{{$contrat->id}}">
                    <label for="motif" class="col-form-label">Motif</label>
                    <textarea name="motif" id="motif" required
                      class="form-control @error('motif') is-invalid @enderror">{{old('motif')}}</textarea>
                    @error('motif')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                  <button type="submit" name="resilier" class="btn btn-danger">Résilier</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endif

        @if ($contrat->statut !== "Annulé")
        <button type="button" class="btn btn-warning btn-block mt-1" data-toggle="modal"
          data-target="{{'#annuler'.$contrat->id}}">
          Annuler le contrat
        </button>
        <div class="modal fade" id="{{'annuler'.$contrat->id}}" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-warning">Annuler le contrat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('contrats.annuler')}}" method="POST">
                @csrf
                <div class="modal-body">
                  <div class="col-12">
                    <input type="hidden" name="contrat_id" value="{{$contrat->id}}">
                    <label for="motif" class="col-form-label">Motif</label>
                    <textarea name="motif" id="motif" required
                      class="form-control @error('motif') is-invalid @enderror">{{old('motif')}}</textarea>
                    @error('motif')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                  <button type="submit" name="annuler" class="btn btn-warning">Annuler le contrat</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endif
        @endif
        @endhasanyrole

        @hasanyrole(config('custom.roles.direction').'|'.config('custom.roles.direction_C').'|'.config('custom.roles.ITMMS'))
        @role(config('custom.roles.ITMMS'))
        <form class="col-xs-12 hidden-xs" name="sentMessage" id="DesForm"
          action="{{route('contrats.destroy', $contrat->id)}}" method="POST">
          @method("DELETE")
          @csrf
          <input value="{{$contrat->id}}" type="hidden" class="form-control d-none" name="contrat_id">
          <button type="submit" class="btn btn-danger btn-block my-2">Supprimer le contrat</button>
        </form>
        @endrole
        @endhasanyrole

        @role(config('custom.roles.marchand'))
        @if($contrat->statut =="Attente de paiement" && auth()->user()->marchand->first()->id ==
        $contrat->marchands->last()->id )
        <button type="button" class="btn btn-success btn-block col-12" data-toggle="modal" data-target="#exampleModal">
          Payer les Frais
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payer les frais pour ce contrat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="text-center text-warning">
                  Assurez vous d'avoir au moins 1000 FCFA sur votre compte Mobile Money ou Moov Money pour les frais
                  d'adhésion.
                </p>
                <form action="{{route('souscriptions.payer')}}" method="POST">
                  @csrf
                  <input type="text" value="{{$contrat->souscriptions->last()->id}}" name="souscription_id"
                    class="d-none">
                  @include('dash.components.paiementChoiceComponent')
                  <button type="submit" class="btn btn-primary float-right">
                    Valider
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endrole
        @endif


        <!-- Button trigger modal -->


      </div>
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Validation du contrat</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form autocomplete="off" action="{{route('utilisateurs.changePassword')}}" method="POST"
                enctype="multipart/form-data" role="form">
                @csrf
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-primary">Valider</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <div class="col-md-3">
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <div class="image">
            <img src="{{ asset('dashboard/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
        </div>
        <h3 class="profile-username text-center">{{ $contrat->client->users->first()->getFullNameAttribute() }}</h3>
        <p class="text-muted text-center"> Souscripteur</p>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item d-none">
            <b>Etat</b> <a class="float-right">{{$contrat->client->users->first()->actif ? 'Actif':"Non Actif"}}</a>
          </li>
          <li class="list-group-item">
            <b>Adresse</b> <a class="float-right">{{$contrat->client->users->first()->adresse}}</a>
          </li>
          <li class="list-group-item">
            <b>Téléphone</b> <a class="float-right">{{$contrat->client->users->first()->telephone}}</a>
          </li>
          <li class="list-group-item">
            <b>Email</b> <a class="float-right">{{$contrat->client->users->first()->email}}</a>
          </li>
          <li class="list-group-item">
            <b>Sexe</b> <a class="float-right">{{$contrat->client->users->first()->sexe}}</a>
          </li>
          <li class="list-group-item">
            <b>IFU</b> <a class="float-right">{{$contrat->client->users->first()->ifu}}</a>
          </li>
          <li class="list-group-item">
            <b>Date de naissance</b> <a class="float-right">{{$contrat->client->users->first()->date_naissance}}</a>
          </li>
          <li class="list-group-item">
            <b>Situation matrimoniale</b> <a
              class="float-right">{{$contrat->client->users->first()->situation_matrimoniale}}</a>
          </li>
          <li class="list-group-item">
            <b>Employeur</b> <a class="float-right">{{$contrat->client->users->first()->employeur}}</a>
          </li>
          @role(config('custom.roles.direction'))
          <li class="list-group-item">
            <b>Rôle(s)</b> <a class="float-right">
              @foreach($contrat->client->users->first()->getRoleNames() as $r)
              <span class="badge badge-primary">{{$r}}</span>
              @endforeach
            </a>
          </li>
          @endrole
          <li class="list-group-item">
            <b>Commune</b> <a class="float-right">
              {{ $contrat->client->users->first()->commune->nom }}
            </a>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <div class="col-md-3">
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <div class="image">
            <img src="{{ asset('dashboard/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
        </div>
        <h3 class="profile-username text-center">{{ $contrat->assure->users->first()->getFullNameAttribute() }}</h3>
        <p class="text-muted text-center">Assuré</p>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item d-none">
            <b>Etat</b> <a class="float-right">{{$contrat->assure->users->first()->actif ? 'Actif':"Non Actif"}}</a>
          </li>
          <li class="list-group-item">
            <b>Adresse</b> <a class="float-right">{{$contrat->assure->users->first()->adresse}}</a>
          </li>
          <li class="list-group-item">
            <b>Téléphone</b> <a class="float-right">{{$contrat->assure->users->first()->telephone}}</a>
          </li>
          <li class="list-group-item">
            <b>Email</b> <a class="float-right">{{$contrat->assure->users->first()->email}}</a>
          </li>
          <li class="list-group-item">
            <b>Sexe</b> <a class="float-right">{{$contrat->assure->users->first()->sexe}}</a>
          </li>
          <li class="list-group-item">
            <b>IFU</b> <a class="float-right">{{$contrat->assure->users->first()->ifu}}</a>
          </li>
          <li class="list-group-item">
            <b>Date de naissance</b> <a class="float-right">{{$contrat->assure->users->first()->date_naissance}}</a>
          </li>
          <li class="list-group-item">
            <b>Situation matrimoniale</b> <a
              class="float-right">{{$contrat->assure->users->first()->situation_matrimoniale}}</a>
          </li>
          <li class="list-group-item">
            <b>Employeur</b> <a class="float-right">{{$contrat->assure->users->first()->employeur}}</a>
          </li>
          @role(config('custom.roles.direction'))
          <li class="list-group-item">
            <b>Rôle(s)</b> <a class="float-right">
              @foreach($contrat->assure->users()->first()->getRoleNames() as $r)
              <span class="badge badge-primary">{{$r}}</span>
              @endforeach
            </a>
          </li>
          @endrole
          <li class="list-group-item">
            <b>Commune</b> <a class="float-right">
              {{ $contrat->assure->users->first()->commune->nom }}
            </a>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <div class="col-md-3">
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <h3 class="text-primary">Liste des Questions</h3>
        <div class="form-group">
          <input type="checkbox" class="" id="reference" value="q1" name="reference" {{$contrat->q1 ? "checked" :"" }}
            disabled>
          <label for="forRef">Etes vous actuellement malade ou hospitalisé ?</label>
        </div>
        <div class="form-group">
          <input type="checkbox" class="" id="reference" value="q2" name="reference" {{$contrat->q2 ? " checked" :"" }}
            disabled>
          <label for="forRef">Avez vous fait un accident au cours de ces trois derniers mois ?</label>
        </div>
        <div class="form-group">
          <input type="checkbox" class="" id="reference" value="q3" name="reference" {{$contrat->q3 ? " checked" :"" }}
            disabled>
          <label for="forRef">Souffrez vous ou avez vous souffert de {{ "l'Hepatite" }}, Tuberculose, Diabète, AVC
            ?</label>
        </div>
        <div class="form-group">
          <input type="checkbox" class="" id="reference" value="q4" name="reference" {{$contrat->q4 ? " checked" :"" }}
            disabled>
          <label for="forRef">Etes vous immobilisé pour une raison de santé ?</label>
        </div>
        <div class="form-group">
          <input type="checkbox" class="" id="reference" value="q5" name="reference" {{$contrat->q5 ? "checked" :"" }}
            disabled>
          <label for="forRef">Etes vous en bonne santé ?</label>
        </div>
        <a href="#" class="btn btn-primary btn-block d-none"><b>Follow</b></a>
        <h3 class="text-primary">Pièces fournies</h3>
        @foreach($contrat->fichiers as $f)
        <div class="row my-2">
          <a href="{{asset('/images/'.$f->label.'/'.$f->nom)}}" class="col-12">
            <img style="width: 150px;" class="float-right image-responsive"
              src="{{asset('/images/'.$f->label.'/'.$f->nom)}}" alt="Photo {{$f->label}} de ce contrat">
            {{$f->label}}
          </a>
        </div>
        @endforeach
      </div>
      <!-- /.card-body -->
    </div>
  </div>


  @foreach($contrat->beneficiaires as $bene)
  <div class="col-md-3">
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <div class="image">
            <img src="{{ asset('dashboard/dist/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
        </div>
        <h3 class="profile-username text-center">{{ $bene->users->first()->getFullNameAttribute() }}</h3>
        <p class="text-muted text-center"> Bénéficiaire</p>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item d-none">
            <b>Etat</b> <a class="float-right">{{$bene->users->first()->actif ? 'Actif':"Non Actif"}}</a>
          </li>
          <li class="list-group-item">
            <b>Adresse</b> <a class="float-right">{{$bene->users->first()->adresse}}</a>
          </li>
          <li class="list-group-item">
            <b>Téléphone</b> <a class="float-right">{{$bene->users->first()->telephone}}</a>
          </li>
          <li class="list-group-item">
            <b>Email</b> <a class="float-right">{{$bene->users->first()->email}}</a>
          </li>
          <li class="list-group-item">
            <b>Sexe</b> <a class="float-right">{{$bene->users->first()->sexe}}</a>
          </li>
          <li class="list-group-item">
            <b>IFU</b> <a class="float-right">{{$bene->users->first()->ifu}}</a>
          </li>
          <li class="list-group-item">
            <b>Date de naissance</b> <a class="float-right">{{$bene->users->first()->date_naissance}}</a>
          </li>
          <li class="list-group-item">
            <b>Situation matrimoniale</b> <a class="float-right">{{$bene->users->first()->situation_matrimoniale}}</a>
          </li>
          <li class="list-group-item">
            <b>Employeur</b> <a class="float-right">{{$bene->users->first()->employeur}}</a>
          </li>
          <li class="list-group-item">
            <b>Taux</b> <a class="float-right">{{$bene->taux}}</a>
          </li>
          @role(config('custom.roles.direction'))
          <li class="list-group-item">
            <b>Rôle(s)</b> <a class="float-right">
              @foreach($bene->users->first()->getRoleNames() as $r)
              <span class="badge badge-primary">{{$r}}</span>
              @endforeach
            </a>
          </li>
          @endrole
          <li class="list-group-item">
            <b>Commune</b> <a class="float-right">
              {{ $bene->users->first()->commune->nom }}
            </a>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
  </div>

  <div class="col-md-3">
    <div class="card card-primary card-outline">
      <div class="card-body box-profile px-0">
        <ul class="list-group list-group-unbordered mb-3">
          <div class="row">
            <div class="col-md-12">
              <div class="timeline">
                @foreach ($contrat->souscriptions->last()->statut_souscriptions->sortByDesc('created_at') as
                $status)
                <div>
                  <i class="fas fa-circle bg-grey"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header no-border">@hasanyrole('ITCAA|Comité|CAA') <a
                        href="#">{{$status->user->name}}</a> a changé le statut en :
                      @endhasanyrole<b>{{$status->label}}</b></h3>
                    @if($status->pivot->motif)
                    <p class="p -0 m-0">{{$status->pivot->motif}}</p>
                    @endif
                    <small class="no-border text-secondary justify-content-right px-2"><i class="fas fa-clock"></i>
                      {{$status->pivot->created_at}}</small>
                  </div>
                </div>
                <!-- END timeline item -->
                @endforeach
                <div>
                  <i class="fas fa-clock bg-gray"></i>
                  <div class="timeline-item">
                    <h3 class="timeline-header no-border">Statut actuel :
                      <b>{{$contrat->souscriptions->last()->statut}}</b>
                    </h3>
                  </div>
                </div>

              </div>
            </div>
            <!-- /.col -->
          </div>
      </div>
      </ul>
    </div>
  </div>

</div>
@endforeach



</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('dashboard/customjs/x.js')}}" type="text/javascript"></script>
<script>
  $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})});
</script>
@endsection
