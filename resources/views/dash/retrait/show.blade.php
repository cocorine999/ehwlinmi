@extends('layouts.dash')
@section('pagetitle', "Détail du retrait")
@section('content')
<div class="row">
  <div class="col-6">
    <div class="mx-auto btn-group">
      @if ($retrait->active)
      @hasanyrole('Direction_FC|ITMMS')
      <button type="button" class="mb-4 btn btn-success mx-2" data-toggle="modal"
        data-target="{{'#form'.$retrait->id}}">
        Valider
      </button>

      <button type="button" class="mb-4 btn btn-danger mx-2" data-toggle="modal"
        data-target="{{'#formr'.$retrait->id}}">
        Rejeter
      </button>
      @endhasanyrole
      @endif
    </div>
  </div>
</div>

<div class="modal fade" id="{{'form'.$retrait->id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title text-success">Valider le retrait</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('retraits.handle')}}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="col-12">
            <input type="hidden" name="retrait_id" value="{{$retrait->id}}">
            <label for="observation" class="col-form-label">Observation *</label>
            <textarea name="observation" id="observation"
              placeholder="Entrer une petite observation qui justifie ce choix" required
              class="form-control @error('observation') is-invalid @enderror">{{old('observation')}}</textarea>
            @error('observation')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="submit" name="valider" class="btn btn-success">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="{{'formr'.$retrait->id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title text-danger">Rejeter le retrait</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('retraits.handle')}}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="col-12">
            <input type="hidden" name="retrait_id" value="{{$retrait->id}}">
            <label for="observation" class="col-form-label">Observation</label>
            <textarea name="observation" id="observation"
              placeholder="Entrer une petite observation qui justifie ce choix" required
              class="form-control @error('observation') is-invalid @enderror">{{old('observation')}}</textarea>
            @error('observation')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="submit" name="rejeter" class="btn btn-danger">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="card card-primary card-outline col-md-6 mx-auto">
  <div class="card-body box-profile">
    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Utilisateur</b> <a class="float-right">{{ $retrait->created_by->full_name}}</a>
      </li>
      <li class="list-group-item">
        <b>Telephone</b> <a class="float-right">{{ $retrait->created_by->telephone}}</a>
      </li>
      <li class="list-group-item">
        <b>Montant à retirer</b> <a class="float-right">{{$retrait->montant}}</a>
      </li>
      <li class="list-group-item">
        <b>Solde commission</b> <a
          class="float-right">{{ $retrait->created_by->getWallet("commission")->balance / 10}}</a>
      </li>
      <li class="list-group-item">
        <b>Motif</b> <a class="float-right">{{$retrait->motif}}</a>
      </li>
      <li class="list-group-item">
        <b>Status</b> <a class="float-right">{{ $retrait->status ?? "Non traité" }}</a>
      </li>
      <li class="list-group-item">
        <b>Traité par</b> <a class="float-right">{{ optional($retrait->handled_by)->full_name }}</a>
      </li>
      <li class="list-group-item">
        <b>Crée le</b> <a class="float-right">{{$retrait->created_at}}</a>
      </li>
    </ul>
  </div>
</div>
@endsection
