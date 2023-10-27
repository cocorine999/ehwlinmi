@extends('layouts.dash')
@section('pagetitle', "Transferer contrats")

@section('content')
<div class="row">
  <div class="col-md-8 float-center">
    <div class="col-md-8 float-right">
      <!-- Profile Image -->
      <form action="{{route('utilisateurs.applytransferall')}}" method="POST">
        @csrf
        <input type="hidden" name="actual_marchand" value="{{$user->id}}">
        <select name="new_marchand" id="new_marchand" class="form-control select2">
          <option value="" selected disabled>Selectionnez le nouveau marchand</option>
          @foreach ($marchands as $u)
          <option value="{{$u->id}}">{{$u->reference}} - {{$u->fullname}}</option>
          @endforeach
        </select>
        <input type="submit" value="Transferer les contrats" class="btn btn-danger mx-auto my-2">
      </form>
    </div>
  </div>
</div>
@endsection
