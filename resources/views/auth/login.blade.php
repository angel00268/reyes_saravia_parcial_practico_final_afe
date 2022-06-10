@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 mt-5">
            <div class="shadow p-5">
                <div class="text-center">
                    <h3>{{ __('Login') }}</h3>
                </div>
                <div style="display: flex; justify-content: center" class="my-3">
                    <img src="{{asset('img/key.png')}}" style="width: 100px; height:100x">
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input placeholder="Correo electrónico" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input placeholder="Contraseña" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn" style="background-color: #764AF1; color: white">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="text-center">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection