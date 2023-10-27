@extends('layouts.dash')
@section('pagetitle', "Primes")

@section('styles')

@endsection

@section('content')

   <div class="card">
        <div class="card-header">
            <h3 class="card-title">Primes</h3>
            <div class="card-tools">
                <a href="{{route('primes.create')}}" type="button" class="btn btn-primary float-right" title="Enregistrer une prime">
                    <i class="fas fa-plus"></i> Enregistrer une prime</a>
            </div>
        </div>
        <div class="card-body">
            <div class="">
            <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nom Prenom</th>
                    <th>Telephone</th>
                    <th>Commune</th>
                    <th>Créé le</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach (Auth::user()->contrats as $c)
                     @foreach ($c->primes as $prime)
                      <tr>
                        <td>{{ $prime->contrat->reference}} </td>
                        <td>{{ $prime->montant}} </td>
                        <td>{{ $prime->user->fullname}} </td>
                        <td>{{ $prime->created_at}} </td>
                      </tr>
                     @endforeach
                  @endforeach
                </tbody>
              </table>
              </div>
         </div>
   </div>

@endsection