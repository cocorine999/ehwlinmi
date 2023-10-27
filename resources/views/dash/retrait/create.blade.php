@extends('layouts.dash')
@section('pagetitle', "Effectuer un retrait")

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <div class="card-body">
        <form autocomplete="off" action="{{route('retraits.store')}}" method="POST" role="form">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="montant">Montant à retirer</label>
                <input required type="number" min="0"
                  {{-- max="{{Auth::user()->getWallet('commissions') ? Auth::user()->getWallet('commissions')->balance : 0}}"
                  --}}class="form-control" id="montant" name="montant" placeholder="Montant à retirer">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="motif">Motif du retrait</label>
                <input required type="text" class="form-control" id="motif" name="motif" placeholder="Motif du retrait">
              </div>
            </div>

          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right col-sm-12 col-md-4">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('dashboard/customjs/getContratByTelephone.js')}}" type="text/javascript"></script>
<script>
  $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})});
</script>
@endsection
