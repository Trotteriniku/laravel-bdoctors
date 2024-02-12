@extends('layouts.app')

@section('content')
    <div class="container">

        <section
            class="section register min-vh-100 d-flex flex-column align-specializations-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-specializations-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-specializations-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">Bdoctors</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Complete an Account</h5>
                                    <p class="text-center small">Enter your personal details to create account</p>
                                </div>

                                {{-- FORM --}}
                                <form action="{{ route('accounts.store') }}" method="POST" class="row g-3 needs-validation"
                                    enctype="multipart/form-data">

                                    @csrf
                                    <input class="d-none" type="text" name="user_id" value="{{ session('user_id') }}">
                                    {{-- IMAGE --}}
                                    <div class="col-12">
                                        <label for="yourName" class="form-label">Your Image</label>
                                        <input type="file" name="name"
                                            class="form-control  @error('image') is-invalid @enderror" id="yourName">
                                        @error('image')
                                            <div class="invalid-feedbac">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Please, enter your name!</div>
                                    </div>
                                    {{-- CV --}}
                                    <div class="col-12">
                                        <label for="cv" class="form-label">CV</label>
                                        <input type="file" name="cv"
                                            class="form-control  @error('cv') is-invalid @enderror" id="cv">
                                        @error('cv')
                                            <div class="invalid-feedbac">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Inserisci il tuo curriculum</div>
                                    </div>

                                    {{-- PHONE --}}
                                    <div class="col-12">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control  @error('phone') is-invalid @enderror" id="phone"
                                            required minlength="9">
                                        @error('phone')
                                            <div class="invalid-feedbac">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Inserisci il tuo numero</div>
                                    </div>

                                    {{-- INDIRIZZO --}}
                                    <div class="col-12">
                                        <label for="address" class="form-label">Your address</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="address"
                                                class="form-control  @error('address') is-invalid @enderror" id="address"
                                                required minlength="3" maxlength="1000">
                                            @error('address')
                                                <div class="invalid-feedbac">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="invalid-feedback">Please insert your adddress!</div>
                                    </div>

                                    {{-- SPECIALIZATIONS --}}
                                    <div class="mb-3">
                                        <div class="form-group mt-5">
                                            <h5>Select specializations:</h5>
                                            <div class="row mt-3">
                                                @foreach ($specializations as $specialization)
                                                    <div class="  @error('specializations') is-invalid @enderror">
                                                        <!-- Colonna per ogni checkbox -->
                                                        <div
                                                            class="form-check @error('specializations') is-invalid @enderror">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="specializations[]" value="{{ $specialization->id }}">

                                                            <label class="form-check-label fw-bold ">
                                                                {{ $specialization->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @error('specializations')
                                                    <div class="invalid-feedbac">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    {{-- PERFORMANCE --}}
                                    <div class="col-12">
                                        <label for="performance" class="form-label">Your performance</label>
                                        <div class="input-group has-validation">
                                            <textarea type="text" name="performance" class="form-control  @error('performances') is-invalid @enderror"
                                                id="performance">
                                            </textarea>
                                        </div>
                                        @error('performances')
                                            <div class="invalid-feedbac">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Please insert your adddress!</div>
                                    </div>





                                    {{-- <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value=""
                                                id="acceptTerms" required>
                                            <label class="form-check-label" for="acceptTerms">Accetto i termini e le
                                                condifizioni <a href="#">terms and conditions</a></label>
                                            <div class="invalid-feedback">You must agree before submitting.</div>
                                        </div>
                                    </div> --}}

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Hai già un account? <a href="{{ route('login') }}">Log in</a>
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
