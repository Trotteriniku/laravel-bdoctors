@extends('layouts.admin')

@section('content')
    <div class="container mt-4 pt-5" style="background-color: #f6f9ff;">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1 class="card-title fw-semibold ">Recensione</h1>
                <div class="card p-3 ">
                    <div class="card-body">
                        <div class=" mb-3 ">
                            <h4 class="card-subtitle mb-2 py-3 text-muted" style="color: #0476D9">{{ $review->title }}
                            </h4>
                            <p><strong>Nome:</strong> {{ $review->name }}</p>
                            <p><strong>Email:</strong> {{ $review->email }}</p>
                            <p><strong>Data:</strong> {{ substr($review->created_at, 0, 10) }}</p>
                            <p><strong>Contenuto:</strong> {{ $review->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
