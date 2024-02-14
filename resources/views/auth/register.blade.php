@extends('layouts.app')

@section('content')
    <div class="container vh-100">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">Bdoctors</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card vw-100 ms-5 me-5 ">
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
                                    <p class="text-center small">Inserisci i tuoi dati personali per creare un account</p>
                                </div>

                                <form action="{{ route('register') }}" method="POST" class="row g-3 needs-validation"
                                    enctype="multipart/form-data">


                                    @csrf
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Nome</label>
                                        <input type="text" name="name"
                                            class="form-control  @error('name') is-invalid @enderror" id="yourName" >
                                        <div class="invalid-feedback">Inserisci il tuo nome</div>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Cognome</label>
                                        <input type="text" name="surname"
                                            class="form-control @error('surname') is-invalid @enderror" id="yourSurname"
                                            >
                                        <div class="invalid-feedback">Inserisci il tuo cognome</div>
                                        @error('surname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="yourEmail"
                                                >

                                        </div>
                                        <div class="invalid-feedback">Inserisci un indirizzo email valido</div>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="yourPassword"
                                             minlength="3" maxlength="12">
                                        <div class="invalid-feedback">Inserisci una password valida</div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="password-confirm" class="form-label">Conferma Password</label>

                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation"  autocomplete="new-password">
                                    </div>

                                    <!--<input class="d-none" type="text" name="user_id" value="{{ session('user_id') }}">-->
                                    {{-- IMAGE --}}
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Foto</label>
                                        <input type="file" name="name"
                                            class="form-control  @error('image') is-invalid @enderror" id="yourName">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Inserisci la tua foto</div>
                                    </div>
                                    {{-- CV --}}
                                    <div class="col-12">
                                        <label for="cv" class="form-label">CV</label>
                                        <input type="file" name="cv"
                                            class="form-control  @error('cv') is-invalid @enderror" id="cv">
                                        @error('cv')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Inserisci il tuo curriculum</div>
                                    </div>

                                    {{-- PHONE --}}
                                    <div class="col-12">
                                        <label for="phone" class="form-label">Telefono</label>
                                        <input type="text" name="phone"
                                            class="form-control  @error('phone') is-invalid @enderror" id="phone"
                                             minlength="9">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Inserisci il tuo numero di telefono</div>
                                    </div>

                                    {{-- INDIRIZZO --}}
                                    <div class="col-12">
                                        <label for="address" class="form-label">Indirizzo</label>
                                        <div class="input-group has-validation">
                                            <input type="text" value="{{old('address')}}" name="address"
                                                class="form-control  @error('address') is-invalid @enderror"
                                                id="address"  minlength="3" maxlength="500">
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="invalid-feedback">Inserisci il tuo indirizzo</div>
                                    </div>

                                    {{-- SPECIALIZATIONS --}}
                                    <div class="mb-3">
                                        <div class="form-group mt-5">
                                            <h5>Seleziona una specializzazione:</h5>
                                            <div class="row mt-3">
                                                @foreach ($specializations as $specialization)
                                                    <div class="@error('specializations') is-invalid @enderror">
                                                        <div
                                                            class="form-check @error('specializations') is-invalid @enderror">
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
                                        <label for="performance" class="form-label">Performance</label>
                                        <div class="input-group has-validation">
                                            <textarea type="text" name="performance" class="form-control  @error('performances') is-invalid @enderror"
                                                id="performance" minlength="3" maxlength="1000">
                                            </textarea>
                                        </div>
                                        @error('performances')
                                            <div class="invalid-feedbac">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Inserisci la tua performance!</div>
                                    </div>





                                    {{-- <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value=""
                                                id="acceptTerms" >
                                            <label class="form-check-label" for="acceptTerms">Accetto i termini e le
                                                condifizioni <a href="#">terms and conditions</a></label>
                                            <div class="invalid-feedback">You must agree before submitting.</div>
                                        </div>
                                    </div> --}}

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Crea un account</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Hai già un account? <a href="{{ route('login') }}">Log
                                                in</a>
                                        </p>
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
