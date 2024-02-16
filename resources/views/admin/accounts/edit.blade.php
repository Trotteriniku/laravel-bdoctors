@extends('layouts.admin')

@section('content')
    <div class="container pt-5 ">

        <section class="section register d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="  col-lg-8  d-flex flex-column align-items-center justify-content-center">

                        <div class="card mb-3">
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
                                    <h5 class="card-title text-center pb-0 fs-4">Modifica il tuo profilo</h5>
                                </div>

                                <form id="myForm" action="{{ route('admin.accounts.update', $account) }}" method="POST"
                                    class="row g-3 needs-validation form-register" enctype="multipart/form-data">

                                    @method('PUT')
                                    @csrf



                                    {{-- IMAGE --}}
                                    <div class="col-10">
                                        <label for="imageUpload" class="form-label">Immagine del profilo</label>
                                        <input type="file" accept=".jpeg,.jpg,.png" name="image"
                                            class="form-control @error('image') is-invalid @enderror" id="imageUpload">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Anteprima dell'immagine --}}
                                    <div class="col-2 d-flex justify-content-end">
                                        <div class="box-img border">
                                            <img id="uploadPreview" style="width: 100%;"
                                                src="{{ $account->image ? asset($account->image) : 'https://placehold.jp/023E73/ffffff/150x150.png?text=Anteprima%20Immagine' }}">
                                        </div>
                                    </div>


                                    {{-- CV --}}
                                    <div class="col-12">
                                        <label for="cv" class="form-label">Carica un nuovo CV</label>
                                        <div class="d-flex flex-row">
                                            <input type="file" accept=".pdf" name="cv"
                                                class="form-control  @error('cv') is-invalid @enderror" id="cv"
                                                value="{{ old('curriculum', $account->curriculum) }}">
                                        </div>
                                        @error('cv')
                                            <div class="invalid-feedbac">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- cv preview --}}
                                    <div class="d-flex py-2 ">
                                        <div class="framed w-100 border" style="height: fit-content;">
                                            @if ($account->cv !== '')
                                                <iframe id="uploadPreviewCv" style="width: 100%; min-height: 400px;"
                                                    src="{{ asset($account->cv) }}">
                                                </iframe>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- PHONE --}}
                                    <div class="col-12 col-lg-6">
                                        <label for="phone" class="form-label">Telefono <span
                                                class="text-danger">*</span></label>
                                        <input type="tel" pattern="^\+?\d*$" name="phone"
                                            class="form-control  @error('phone') is-invalid @enderror" id="phone"
                                            required minlength="9" placeholder="Formato: 1234567890"
                                            value="{{ old('phone', $account->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedbac">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Inserisci il tuo numero</div>
                                    </div>

                                    {{-- INDIRIZZO --}}
                                    <div class="col-12 col-lg-6">
                                        <label for="address" class="form-label">Indirizzo <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="address"
                                                class="form-control  @error('address') is-invalid @enderror" id="address"
                                                required minlength="3" maxlength="1000"
                                                value="{{ old('address', $account->address) }}">
                                            @error('address')
                                                <div class="invalid-feedbac">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="invalid-feedback">Please insert your adddress!</div>
                                    </div>

                                    {{-- SPECIALIZATIONS --}}
                                    <p class="mt-4 m-0 ">Specializzazioni <span class="text-danger">*</span><span
                                            class="text-danger error-alert-specialization"></span></p>
                                    <fieldset>

                                        <div class="d-flex flex-wrap" id="specializations-container">
                                            @foreach ($specializations as $specialization)
                                                <div class="form-check pe-4 check-specializations">
                                                    <input class="form-check-input specialization" type="checkbox"
                                                        value="{{ $specialization->id }}" id="{{ $specialization->name }}"
                                                        name="specialization[]"
                                                        @foreach ($account->specializations as $account_spec) @if ($account_spec->id == $specialization->id) checked @endif @endforeach>
                                                    <label class="form-check-label label-specialization"
                                                        id="{{ $specialization->id }}" for="{{ $specialization->name }}">
                                                        {{ ucfirst($specialization->name) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('specialization')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div id="specialization-error" class="text-danger d-none">Seleziona almeno una
                                            specializzazione.</div>

                                    </fieldset>


                                    {{-- PERFORMANCES --}}
                                    <div class="col-12">
                                        <label for="performances" class="form-label">Modifica le prestazioni</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="performances"
                                                class="form-control  @error('performances') is-invalid @enderror"
                                                id="performances"
                                                value="{{ old('performances', $account->performances) }}" />
                                        </div>
                                        @error('performances')
                                            <div class="invalid-feedbac">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Conferma le
                                            modifiche</button>
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
