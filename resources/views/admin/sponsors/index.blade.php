@extends('layouts.admin')

@section('content')
    <main id="main" class="main">
        <h2 class="text-center fs-1 container">Scegli l'abbonamento che fa al caso tuo!</h2>
        <div class="container d-flex justify-content-center mt-3">
            @foreach ($sponsorships as $item)
                <div class="card p-5 m-5 shadow">
                    <div class="card-body text-center">
                        <h2 class="p-2 text-primary fw-semibold dislpay-5">{{ $item->name }}</h2>
                        <h5 class="p-3"><i class="fa-solid fa-money-bill-1" style="color: #85bb65;"></i> Prezzo:
                            {{ $item->price }} &euro;</h5>
                        <h5 class="p-3"><i class="fa-solid fa-calendar-days"></i> Durata abbonamento:<br>
                            {{--  {{ substr($item->duration, 0, 5) }} ore --}}
                            @if ($item->duration == '24:00:00')
                                1 giorno
                            @elseif($item->duration == '72:00:00')
                                3 giorni
                            @elseif($item->duration == '144:00:00')
                                6 giorni
                            @endif

                        </h5>
                        <button class="btn btn-primary ">
                            <a class="text-white text-decoration-none" href="{{ route('admin.sponsors.show', $item->id) }}">
                                Conferma
                            </a>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
