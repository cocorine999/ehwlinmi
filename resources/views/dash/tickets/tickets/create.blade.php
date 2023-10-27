@extends('layouts.dash')
@section('pagetitle', "Ajouter un ticket")

@section('content')

<div class="card">
  <div class="card-body">
    <form autocomplete="off" role="form" method='POST' action="{{route('tickets.store')}}">
        @csrf

        <div class="row">
            <div class="form-group col-6">
                <label for="priority">Priorité</label>
                <select name="priority_id" id="priority" class="form-control select2" required>
                    @foreach($priorities as $id => $priority)
                        <option value="{{ $id }}">{{ $priority }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label for="category">Categorie</label>
                <select name="category_id" id="category" class="form-control select2" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label for="InputTelephone">Telephone de l'utilisateur concerné</label>
            <input type="number" class="form-control" id="InputTelephone" name="telephone" placeholder="Entrer telephone">
          </div>
          <div class="form-group col-6">
            <label for="InputReference">Référence du contrat concerné</label>
            <input required type="text" class="form-control" id="InputReference" name="reference" placeholder="Entrer reference">
          </div>
          <div class="form-group col-12">
            <label for="InputTitle">Objet *</label>
            <input required type="text" class="form-control" id="InputTitle" name="title" placeholder="Objet">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-12">
            <label for="conent">Description *</label>
            <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="Décrivez le probleme"></textarea>
          </div>
        </div>



        <button type="submit" class="btn btn-primary float-right">Enregister</button>
    </form>
  </div>
</div>
@endsection
@section('js')
<script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
<script> $(function () {$('.select2bs4').select2({theme: 'bootstrap4'})}); </script>
<script src="{{ asset('dashboard/customjs/checkIfUserExist.js')}}"></script>

<script>
document.getElementById('InputTelephone').addEventListener("change", function(event){
    event.preventDefault();
    checkTelephone1('#InputTelephone');
});
</script>
@endsection
