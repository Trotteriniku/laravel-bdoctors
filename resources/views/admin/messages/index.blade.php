@extends('layouts.admin')
@section('content')
    <div class="container mt-4 pt-5" style="background-color: #f6f9ff;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        @foreach ($messages as $message)
                            <div class="w-75 pt-3 ps-5">
                                <div class="card">
                                    <h1 class="text-center">{{ $message->name }}</h1>
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $message->title }}</h3>
                                        <p class="card-text">{{ $message->email }}</p>
                                        <p class="card-text">{{ $message->content }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
