@extends('layouts.admin')

@section('content')
    <main id="main" class="main">
        <h2 class="text-center fs-1 container">Scegli l'abbonamento che fa al caso tuo!</h2>
        <div class="container mt-5">
            <div class="row justify-content-center gap-2">
                @foreach ($sponsorships as $item)
                    <div class="col-12 col-md-5 col-lg-4 col-xxl-4   gap-2 card py-3 card-margin  shadow">
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
                            @if ($alreadySponsored)
                                <button class="btn btn-primary" disabled>
                                    Sei gia sponsorizzato
                                </button>
                            @else
                                <a class="btn btn-primary text-white text-decoration-none"
                                    href="{{ route('admin.sponsors.show', $item->id) }}">
                                    Paga
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
