@extends('layouts.admin')
@section('content')
    <main id="main" class="main">
        <div class="container " style="background-color: #f6f9ff;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="container">
                        <div class="row">
                            <h1 class="card-head">Recensioni : {{ count($reviews) }}</h1>
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Titolo</th>
                                        <th scope="col">Anteprima</th>
                                        <th scope="col">Data/ora</th>
                                        <th scope="col">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr class="text-center">
                                            <td>{{ $review->name }}</td>
                                            <td>{{ $review->email }}</td>
                                            <td>{{ $review->title }} </td>
                                            <td>{{ strlen($review->content) > 80 ? substr($review->body, 0, 80) . '...' : $review->body }}
                                            </td>
                                            <td class="col-3">
                                                {{ date('d-m-Y \O\r\e\: H:i:s', strtotime($review->created_at)) }} </td>
                                            <td class="">
                                                <a class="btn btn-primary"
                                                    href=" {{ route('admin.reviews.show', $review->id) }}"><i
                                                        class="fa-regular fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
