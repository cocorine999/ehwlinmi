@extends('layouts.dash')
@section('pagetitle', "SMS")

@section('content')

   <div class="card">
        <div class="card-body">
            
            <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>From.</th>
                    <th>To</th>
                    <th>Message</th>
                    <th>Sent</th>
                    <th>Envoyé le</th>
                  </tr>
                </thead>
                <tbody>
                     @foreach ($sms as $s)
                      <tr>
                        <td>{{ $s->from }} </td>
                        <td>{{ $s->to }} </td>
                        <td>{{ $s->message }} </td>
                        <td>{{ $s->sent }} </td>
                        <td>{{ $s->created_at }} </td>
                      </tr>
                     @endforeach
                </tbody>
              </table>
              <hr>
              <div>{{ $sms->links() }}</div>
              
         </div>
   </div>

@endsection
