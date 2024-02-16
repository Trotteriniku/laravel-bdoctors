@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6  ">
                <div class="d-flex justify-content-center py-3">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                        <img src="assets/img/logo.png" alt="">
                        <span class="d-none d-lg-block p-3">BDOCTORS</span>
                    </a>
                </div>
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Crea un Account</h5>
                            {{--  <p class="text-center small">Inserisci i tuoi dati personali per creare un account</p> --}}
                        </div>
                        <form action="{{ route('register') }}" method="POST" class="row g-3 needs-validation"
                            enctype="multipart/form-data">
                            @csrf
                            {{-- NAME --}}
                            <div class="col-12 col-lg-6  ">
                                <label for="yourName" class="form-label">Nome</label>
                                <input type="text" name="name"
                                    class="form-control  @error('name') is-invalid @enderror" id="name">
                                <div id="name-errorField" class="d-none"></div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- SURNAME --}}
                            <div class="col-12 col-lg-6  ">
                                <label for="yourName" class="form-label">Cognome</label>
                                <input type="text" name="surname"
                                    class="form-control @error('surname') is-invalid @enderror" id="last_name">
                                <div id="last-name-errorField" class="d-none"></div>
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- EMAIL --}}
                            <div class="col-12 col-lg-6  ">
                                <label for="yourEmail" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email">
                                </div>
                                <div id="email-errorField" class="d-none"></div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- PHONE --}}
                            <div class="col-12 col-lg-6  ">
                                <label for="phone" class="form-label">Telefono</label>
                                <input type="text" name="phone"
                                    class="form-control  @error('phone') is-invalid @enderror" id="phone"
                                    minlength="9">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- PASSWORD --}}
                            <div class="col-12 col-lg-6  ">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" id="yourPassword"
                                    minlength="3" maxlength="12">
                                {{-- Error field  --}}
                                <div id="psw-errorField" class="d-none"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- CONFIRM PASSWORD --}}
                            <div class="col-12 col-lg-6  ">
                                <label for="password-confirm" class="form-label">Conferma Password</label>
                                <input id="password-confirm" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" autocomplete="new-password">
                                <div id="confirmPsw-errorField" class="d-none"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input class="d-none" type="text" name="user_id" value="{{ session('user_id') }}">
                            {{-- IMAGE --}}
                            <div class="col-12 col-lg-6  ">
                                <label for="yourName" class="form-label">Carica un'immagine profilo</label>
                                <input type="file" accept=".jpeg,.jpg,.png" name="image"
                                    class="form-control  @error('image') is-invalid @enderror" id="image"
                                    value="{{ old('image') }}">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- CV --}}
                            <div class="col-12 col-lg-6  ">
                                <label for="cv" class="form-label">Carica il tuo CV</label>
                                <input type="file" accept=".pdf" name="cv"
                                    class="form-control  @error('cv') is-invalid @enderror" id="cv">
                                @error('cv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- INDIRIZZO --}}
                            <div class="col-12">
                                <label for="address" class="form-label">Indirizzo</label>
                                <div class="input-group has-validation">
                                    <input type="text" value="{{ old('address') }}" name="address"
                                        class="form-control  @error('address') is-invalid @enderror" id="address"
                                        minlength="3" maxlength="500">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- SPECIALIZATIONS --}}
                            <div class="mb-3">
                                <div class="form-group">
                                    <h5>Seleziona una specializzazione:</h5>
                                    <div class="d-flex flex-wrap align-items-center justify-content-start  mt-2">
                                        @foreach ($specializations as $specialization)
                                            <div class="@error('specializations') is-invalid @enderror">
                                                <div
                                                    class="form-check pt-1 pe-4 @error('specializations') is-invalid @enderror">
                                                    <input type="checkbox" class="form-check-input"
                                                        name="specializations[]"
                                                        value="{{ old('specializations[]', $specialization->id) }}"
                                                        id="{{ $specialization->id }}"
                                                        {{ is_array(old('specialization')) && in_array($specialization->id, old('specialization')) ? ' checked' : '' }}>
                                                    <label class="form-check-label fw-bold"
                                                        for="specialization_{{ $specialization->id }}">
                                                        {{ $specialization->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                        @error('specializations')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- PERFORMANCE --}}
                            <div class="col-12">
                                <label for="performance" class="form-label">Descrivi le tue prestazioni</label>
                                <div class="input-group has-validation">
                                    <textarea type="text" name="performance" class="form-control  @error('performances') is-invalid @enderror"
                                        id="performance" minlength="3" maxlength="1000"></textarea>
                                </div>
                                @error('performances')
                                    <div class="invalid-feedbac">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- CREA ACCOUNT --}}
                            <div class="row mt-3 justify-content-between">
                                <div class="col-12   col-lg-4">
                                    <button class="btn btn-primary p-2" id="registration-form" type="submit">Crea
                                        Account</button>
                                </div>
                                <div class="col-12   col-lg-4 pt-3">
                                    <p class="small mb-0">Hai già un account? <a href="{{ route('login') }}">Accedi</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    @vite('resources/js/validations/register-validation.js')
</script>
