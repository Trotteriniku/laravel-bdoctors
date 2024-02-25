@extends('../layouts.admin')
@section('content')
    <main id="main" class="main">



        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-8">
                    <div class="row">
                        {{-- CARD LINKEN --}}
                        @include('partials.components.card-linker')
                    </div>

                    {{-- CARD LINE-CHART --}}
                    <div class="col-12">
                        <div class="card">


                            @include('partials.components.line-chart')
                        </div>
                    </div>
                    {{-- END-> CARD LINE-CHART --}}

                    {{-- CARD BAR-CHART --}}
                    <div class="col-12">
                        <div class="card">



                            @include('partials.components.bar-chart')
                        </div>
                    </div>
                    {{-- END -> CARD BAR-CHART --}}

                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Attivi</a></li>
                                    <li><a class="dropdown-item" href="#">Disponibili</a></li>
                                    <li><a class="dropdown-item" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                {{-- CARD DEI VOTI MEDI --}}
                @include('partials.components.average-score')

                {{-- CARD DEI MESSAGGI, RECENSIONI E VOTI --}}
                @include('partials.components.messages-preview')

                @include('partials.components.reviews-preview')

                @include('partials.components.scores-preview')
                {{-- END -> CARD DEI MESSAGGI, RECENSIONI E VOTI --}}
            </div>
            </div>
            </div>
        </section>

    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="fa-solid fa-arrow-up-short"></i></a>
    </body>

    </html>
@endsection
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-8">
                    <div class="row">
                        {{-- CARD LINKEN --}}
                        @include('partials.components.card-linker')
                    </div>

                     {{-- CARD BAR-CHART --}}
                     <div class="col-12">
                        <div class="card">

                            @include('partials.components.bar-chart')
                        </div>
                    </div>
                    {{-- END -> CARD BAR-CHART --}}

                    {{-- CARD LINE-CHART --}}
                    <div class="col-12">
                        <div class="card">


                        @include('partials.components.line-chart')
                        </div>
                    </div>
                    {{-- END-> CARD LINE-CHART --}}



                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Attivi</a></li>
                                    <li><a class="dropdown-item" href="#">Disponibili</a></li>
                                    <li><a class="dropdown-item" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                {{-- CARD DEI VOTI MEDI --}}
                @include('partials.components.average-score')

                {{-- CARD DEI MESSAGGI, RECENSIONI E VOTI --}}
                @include('partials.components.messages-preview')

                @include('partials.components.reviews-preview')

                {{-- @include('partials.components.scores-preview') --}}
                {{-- END -> CARD DEI MESSAGGI, RECENSIONI E VOTI --}}
            </div>
            </div>
            </div>
        </section>

    </main>


    </body>

    </html>
@endsection
