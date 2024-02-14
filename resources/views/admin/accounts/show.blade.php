@extends('layouts.admin')

@section('content')
    <div class="container pt-5 w-100  ">

            <div class="row justify-content-center pt-5">
                <div class="col-6">

                    <div class="pb-2 card">
                        <h1>Dottore da user</h1>
                        <div>
                            <span>nome</span>
                            <span>{{$user->name}}</span>
                        </div>
                        <div>
                            <span>cognome</span>
                            <span>{{$user->surname}}</span>
                        </div>
                        <div>
                            <span>email</span>
                            <span>{{$user->email}}</span>
                        </div>
                    </div>

                    <div class="pb-2 card">
                        <h1>Dottore da account</h1>
                        <div>
                            <span>phone</span>
                            <span>{{$account->phone}}</span>
                        </div>
                        <div>
                            <span>indirizzo</span>
                            <span>{{$account->address}}</span>
                        </div>
                    </div>

                    <div class="pb-2 card">
                        <h1>Dottore specializzazioni</h1>
                        <div>
                            <span>phone</span>
                            <span>{{$account->phone}}</span>
                        </div>
                        <div>
                            <span>indirizzo</span>
                            <span>{{$account->address}}</span>
                        </div>
                    </div>

                    <div class="pb-2 card">
                        <h1>Dottore messaggi ricevuti</h1>
                        @foreach ($messages as $message)
                            <h3>messaggio</h3>
                                <div>
                                    <span class="text-uppercase">titolo</span>
                                    <span>{{$message->title}}</span>
                                </div>
                                <div>
                                    <span class="text-uppercase">nome</span>
                                    <span>{{$message->name}}</span>
                                </div>
                                <div>
                                    <span class="text-uppercase">useremail</span>
                                    <span>{{$message->email}}</span>
                                </div>
                                <div>
                                    <span class="text-uppercase">data</span>
                                    <span>{{ substr($message->created_at, 0, 10)}}</span>
                                </div>
                                <div>
                                    <span class="text-uppercase">contenuto</span>
                                    <span>{{$message->content}}</span>
                                </div>
                        @endforeach

                    </div>

                    <div class="pb-2 card">
                        <h1>Dottore recensioni ricevute</h1>
                        @foreach ($reviews as $review)
                            <h3>messaggio</h3>
                                <div>
                                    <span class="text-uppercase">nome</span>
                                    <span>{{$review->name}}</span>
                                </div>

                                <div>
                                    <span class="text-uppercase">titolo</span>
                                    <span>{{$review->title}}</span>
                                </div>

                                <div>
                                    <span class="text-uppercase">email</span>
                                    <span>{{$review->email}}</span>
                                </div>
                                <div>
                                    <span class="text-uppercase">data</span>
                                    <span>{{ substr($review->created_at, 0, 10)}}</span>
                                </div>
                                <div>
                                    <span class="text-uppercase">contenuto</span>
                                    <span>{{$review->content}}</span>
                                </div>

                        @endforeach

                    </div>


                    <div class="pb-2 card">
                        <h1>Dottore specializzazioni</h1>
                        @foreach ($specializations as $specialization)
                            <h3>specializzazione</h3>
                                <div>
                                    <span class="text-uppercase">nome</span>
                                    <span>{{$specialization->name}}</span>
                                </div>



                        @endforeach

                    </div>

                </div>
            </div>

    </div>
@endsection
