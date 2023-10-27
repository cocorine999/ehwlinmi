@extends('layouts.dash')
@section('pagetitle', "Contrats en attente")

@section('styles')

@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contrats en attente de traitement</h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body">
              <div class="">
                  @include('dash.components.listcontrats')
                </div>
              </div>
          </div>
        </div>
    </div>
@endsection

@section('js')

@endsection


