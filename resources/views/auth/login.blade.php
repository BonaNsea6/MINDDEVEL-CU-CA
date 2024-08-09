@extends('layouts.auth')

@section('form')
<div class="card mb-3">

    <div class="card-body">

        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Connecte vous à votre compte</h5>
            <p class="text-center small">Entres ton Identifiant et ton mot de passe</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate>
            @csrf
            <div class="col-12">
                <label for="yourUsername" class="form-label">email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="email" name="email"  class="form-control @error('email') is-invalid @enderror" id="yourUsername"  placeholder="Email" value="{{ old('email') }}"  autocomplete="email" autofocus required>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
            </div>

            <div class="col-12">
                <label for="yourPassword" class="form-label">Password </label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <div class="invalid-feedback">
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary ">
                                        {{ __('Connectez-vous') }}
                    </button>
                        <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                </div>
              
        </form>
    </div>
</div>
@endsection
