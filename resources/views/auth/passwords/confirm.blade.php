@extends('layouts.auth')
@section('pagetitle', "Confirmer le mot de passe.")
@section('content')
    {{ __('Please confirm your password before continuing.') }}

      <form autocomplete="off" method="post" action="{{ route('password.confirm') }}">
        @csrf
        <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Confirmer le mot de passe" name="password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Confirmer le mot de passe.</button>
          </div>
        </div>
      </form>
      @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
              {{ __('Mot de passe oublié?') }}
          </a>
      @endif
@endsection
