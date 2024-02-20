@extends('layouts.admin')

@section('content')
    <div class="container mt-4 pt-5" style="background-color: #f6f9ff;">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="mb-4 d-flex justify-content-center align-items-center"
                    style="background-color: #95D904; height: 300px;">
                    {{-- <img src="{{ asset('path_to_your_image.jpg') }}" alt="Foto del medico"
                        style="max-width: 100%; height: auto;"> --}}

                    @if ($account->image !== '')
                        <img class="img-fluid" src="{{ asset('images/Bdoctor.png') }}" alt="Foto del medico">
                    @endif

                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="w-100  d-flex justify-content-center">
                            @if (isset($account->image))
                                <div class="box-img mt-3 ">
                                    <img src="{{ asset($account->image) }}" alt="hello">
                                </div>
                            @endif
                        </div>
                        <h1 class="card-title fw-semibold border-bottom">Informazioni Utente</h1>
                        <div class="row " style="color: #0476D9">
                            <div class="col-md-6">
                                <p><strong>Nome:</strong> {{ $user->name }}</p>
                                <p><strong>Cognome:</strong> {{ $user->surname }}</p>
                                <p><strong>Indirizzo:</strong> {{ $account->address }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Telefono:</strong> {{ $account->phone }}</p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="card-title fw-semibold border-bottom ">Messaggi Ricevuti</h1>
                        @foreach ($messages as $message)
                            <div class="border-bottom mb-3 pb-3">
                                <h4 class="card-subtitle mb-2 text-muted" style="color: #0476D9">{{ $message->title }}</h4>
                                <p><strong>Nome:</strong> {{ $message->name }}</p>
                                <p><strong>Email:</strong> {{ $message->email }}</p>
                                <p><strong>Data:</strong> {{ substr($message->created_at, 0, 10) }}</p>
                                <p><strong>Contenuto:</strong> {{ $message->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card mb-4 ">
                    <div class="card-body">
                        <h1 class="card-title fw-semibold border-bottom">Recensioni Ricevute</h1>
                        @foreach ($reviews as $review)
                            <div class="border-bottom mb-3 pb-3">
                                <h4 class="card-subtitle mb-2 text-muted" style="color: #0476D9">{{ $review->title }}</h4>
                                <p><strong>Nome:</strong> {{ $review->name }}</p>
                                <p><strong>Email:</strong> {{ $review->email }}</p>
                                <p><strong>Data:</strong> {{ substr($review->created_at, 0, 10) }}</p>
                                <p><strong>Contenuto:</strong> {{ $review->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card mb-4 ">
                    <div class="card-body">
                        <h1 class="card-title fw-semibold border-bottom">Specializzazioni</h1>
                        @foreach ($specializations as $specialization)
                            <div class="border-bottom mb-3 pb-3 " style="color: #0476D9">
                                <p><strong>Nome:</strong> {{ $specialization->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
