@extends('layouts.dash')
@section('pagetitle', "Transactions Mobile Money")

@section('styles')

@endsection

@section('content')

   <div class="card">
        <div class="card-header">
            {{--  <h3 class="card-title">Transactions Mobile Money</h3>  --}}

            <form  action="{{route('exportTransferts')}}" method="POST" role="form" >
               @csrf
                <input  value="{{ collect($transactions->items()) }}"  class="form-control d-none"  name="data" >
                <button type="submit"  class="btn btn-primary float-right"><i class="far fa-fw fa-file-excel"></i> Exporter en Excel</button>
            </form>
        <div class="card-tools mr-2">
        <a href="{{ route('historique.transactions') }}" class="btn btn-primary btn-block" ><i class="far fa-fw fa-file-pdf"></i>Exporter en PDF</a>
        </div>
        </div>
        <div class="card-body">
            <div class="">
            <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Dest.</th>
                    <th>Operateur</th>
                    <th>Motif</th>
                    <th>Montant</th>
                    <th>transref</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Response</th>
                    <th>MAJ le</th>
                    <th>Effectuée le</th>
                    <th>Par</th>
                  </tr>
                </thead>
                <tbody>
                     @foreach ($transactions as $t)
                      <tr>
                        <td>{{ $t->msisdn }} </td>
                        <td>{{ $t->operateur }} </td>
                        <td>{{ $t->narration }} </td>
                        <td>{{ $t->amount }} </td>
                        <td>{{ $t->transref }} </td>
                        <td>{{ $t->lastname }} </td>
                        <td>{{ $t->firstname }} </td>
                        <td>{{ $t->response_msg }} </td>
                        <td>{{ $t->updated_at }} </td>
                        <td>{{ $t->created_at }} </td>
                        <td>{{ $t->user->shortFullName }} </td>
                      </tr>
                     @endforeach
                </tbody>
              </table>
              <hr>
              <div>{{ $transactions->links() }}</div>
              </div>
         </div>
   </div>

@endsection
