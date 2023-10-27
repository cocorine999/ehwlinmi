@extends('layouts.dash')
@section('pagetitle', "Cautions")
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@section('styles')

@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 col-lg-4">Solde principal :  <b>{{ Auth::user()->getWallet('principal')->balance / config('custom.points.coefficient') }} FCFA</b></div>
                <div class="col-md-6 col-lg-4">Solde commission : <b>{{ Auth::user()->getWallet('commission')->balance / config('custom.points.coefficient') }} FCFA</b></div>
                @role(config('custom.roles.direction'))
                <div class="col-md-6 col-lg-4">Solde caution : <b>{{ Auth::user()->getWallet('caution')->balance / config('custom.points.coefficient') }} FCFA</b></div>
                @endrole
            </div>
        </div>
        <div class="card-body">
            <h4>Dépôt de cautions</h4>
            <hr>
                <form autocomplete="off" role="form" method='POST' action="{{route('cautions.store')}}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Selectionnez le Super-Marchand *</label>
                            <select required class="form-control select2bs4" name="user_id">
                                <option value="" selected disabled>Super-Marchand...</option>
                                @foreach($destination as $user)
                                    <option value="{{ $user->id }} ">{{ $user->shortFullName }} - {{ $user->commune->departement->nom }} -{{ $user->commune->nom }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputPoints">Points *</label>
                            <input required type="number" class="form-control" id="InputPoints" name="points" placeholder="Entrer points">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" disable>Valider</button>
                </form>
        </div>
    </div>

@endsection

@section('js')
<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
@endsection


