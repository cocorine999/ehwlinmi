@extends('layouts.dash')
@section('pagetitle', "Point commissions")

@section('styles')

@endsection

@section('content')
      <div class="row">
        <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Point commissions</h3>
        </div>
        <div class="card-body">          
            <div class="">                

  <div >
    @foreach ($supermarchands as $sm)
            <div class="card card-body pb-0 bg-secondary" data-toggle="collapse" data-target="#collapseExample{{$sm->id}}" aria-expanded="false" aria-controls="collapseExample{{$sm->id}}">
                <ul class="p-0 container">
                    <li class="px-3 col-3" style="display:inline;"> <b>Nom :</b> {{$sm->fullname}}</li>
                    <li class="px-3 col-3" style="display:inline;"> <b>Reference :</b> {{$sm->reference}}</li>
                    <li class="px-3 col-3" style="display:inline;"> <b>Commissions :</b> {{$sm->getwallet('commission')->balance / config('custom.points.coefficient')}}</li>
                    <li class="px-3 col-3" style="display:inline;"> <b>Marchands :</b> {{$sm->super_marchand->first()->marchands->count()}}</li>
                </ul>
            </div>
            <div class="collapse" id="collapseExample{{$sm->id}}">
                <table id="examplem1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th>Nom Prenom</th>
                        <th>reference</th>
                        <th>Commissions</th>
                        <th>Contrats</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sm->super_marchand->first()->actual_marchands as $m)
                            <tr>
                                <td>{{$m->users->first()->fullname}}</td>
                                <td style="width: 20%;">{{$m->users->first()->reference}}</td>
                                <td style="width: 20%;">{{$m->users->first()->getwallet('commission')->balance / config('custom.points.coefficient')}}</td>
                                <td style="width: 20%;">{{$m->contrats->count()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    @endforeach
  </div>


            </div>

        </div>
    </div>
        </div>
    </div>
@endsection

@section('js')

@endsection