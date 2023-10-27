@extends('layouts.dash')
@section('pagetitle', "Versements")

@section('styles')

@endsection

@section('content')
      <div class="row">
        <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Versements du {{$mois->format('m/Y')}}</h3>
        </div>
        <div class="card-body">
            <div class="">


            <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Nom Prenom</th>
                    <th>Telephone</th>
                    <th>Montant</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                      <tr>
                          <td>{{$user->id}}</td>
                          <td>{{$user->fullname}}</td>
                          <td>{{$user->telephone}}</td>
                          <td>{{$user->getWallet('commission')->balance / 10}}</td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
              </div>

              </div>
    </div>
        </div>
    </div>
@endsection

@section('js')

@endsection


