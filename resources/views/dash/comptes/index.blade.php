@extends('layouts.dash')
@section('pagetitle', "Mon compte")
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@section('styles')

@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">Solde principal :  <b>{{ Auth::user()->getWallet('principal')->balance / config('custom.points.coefficient') }} FCFA</b></div>
                <div class="col-md-6">Solde commission : <b>{{ Auth::user()->getWallet('commission')->balance / config('custom.points.coefficient') }} FCFA</b></div>
            </div>
        </div>
        <div class="card-body">          
            <h4>Transferer des points</h4>
            <hr>
            @if(Auth::user()->getWallet('principal')->balance > 1000)
                <form autocomplete="off" role="form" method='POST' action="{{route('transactions.transfert')}}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Source *</label>
                            <select required class="form-control select2bs4" name="source">
                                <option value="" selected disabled>Choisissez une option...</option>
                                <option value="principal">Compte principal ({{ Auth::user()->getWallet('principal')->balance / config('custom.points.coefficient') }} FCFA) </option>
                                <option value="commission">Compte commission ({{ Auth::user()->getWallet('commission')->balance / config('custom.points.coefficient') }} FCFA) </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Destination *</label>
                            <select required class="form-control select2bs4" name="user_id">
                                <option value="" selected disabled>Choisissez une option...</option>
                                @foreach($destination as $user)
                                    <option value="{{ $user->id }} ">{{ $user->shortFullName }} - {{ $user->commune->departement->nom }} -{{ $user->commune->nom }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="InputPoints">Points *</label>
                            <input required type="number" max="{{Auth::user()->getWallet('principal')->balance / config('custom.points.coefficient') }}" class="form-control" id="InputPoints" name="points" placeholder="Entrer points">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputMotif">Motif *</label>
                            <input required type="text" class="form-control" id="InputMotif" name="motif" placeholder="Entrer motif">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" disable>Valider</button>
                </form>
            @else
            <p>Vous ne disposez pas d'assez de points pour effectuer un transfert.</p>
            @endif
        </div>
    </div>

@endsection

@section('js')
<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
@endsection


