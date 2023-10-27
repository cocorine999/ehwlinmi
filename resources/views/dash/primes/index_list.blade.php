@extends('layouts.dash')
@section('pagetitle', "Primes")

@section('styles')

@endsection

@section('content')

   <div class="card">
        <div class="card-header">
            <h3 class="card-title">Primes</h3>
        </div>
        <div class="card-body">
            <div class="">
            <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nom Prenom</th>
                    <th>Montant</th>
                    <th>Payé par</th>
                    <th>le</th>
                  </tr>
                </thead>
                <tbody>
                     @foreach ($primes as $prime)
                      <tr>
                        <td>{{ $prime->souscription->contrat->reference}} </td>
                        <td>{{ $prime->montant}} </td>
                        <td>{{ $prime->user->fullname}} </td>
                        <td>{{ $prime->created_at}} </td>
                      </tr>
                     @endforeach
                </tbody>
              </table>
              </div>
         </div>
   </div>

@endsection