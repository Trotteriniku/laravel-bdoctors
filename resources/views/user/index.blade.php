@extends('layouts.app')

@section('content')
<div class="container">

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

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                <p class="text-center small">Enter your personal details to create account</p>
                            </div>

                            <form action="{{ route('users.store') }}" method="POST"
                                class="row g-3 needs-validation" enctype="multipart/form-data">

                                @csrf

                                <div class="col-12">
                                    <label for="yourName" class="form-label">Your Name</label>
                                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="yourName" required>
                                    <div class="invalid-feedback">Please, enter your name!</div>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="yourName" class="form-label">Your Surname</label>
                                    <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror" id="yourSurname" required>
                                    <div class="invalid-feedback">Please, enter your surname!</div>
                                    @error('surname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Your Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail" required>
                                    </div>
                                    <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourPassword"
                                        required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value=""
                                            id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a
                                                href="#">terms and conditions</a></label>
                                        <div class="invalid-feedback">You must agree before submitting.</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Already have an account? <a href="pages-login.html">Log in</a>
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
