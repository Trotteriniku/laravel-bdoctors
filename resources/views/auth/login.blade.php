@extends('layouts.app')

@section('content')
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">Bdoctors</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3 w-100 ">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Accedi al tuo account</h5>
                                    <p class="text-center small">Inserisci la tua email e password per collegarti</p>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-4 row">
                                        <label for="email"
                                            class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                        <div class="col-md-7 ">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row">
                                        <label for="password"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-7">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Ricordami') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Accedi') }}
                                            </button>

                                        </div>
                                    </div>
                                    <div class="mb-4 row ">

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('register') }}">
                                                {{ __('Crea un nuovo account') }}
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
