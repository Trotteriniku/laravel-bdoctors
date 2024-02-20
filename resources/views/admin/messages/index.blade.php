@extends('layouts.admin')
@section('content')
    <div class="container justify-content-end  mt-5 ms-5 pe-0">
        <h1 class="card-head">Messaggi ricevuti: {{count($messages)}} </h1>
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
                @foreach ($messages as $message)
                    <tr class="text-center">
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->title }}</td>
                        <td>{{ substr($message->content, 0, 80) . '...' }}</td>
                        <td>{{ date('d-m-Y \O\r\e\: H:i:s', strtotime($message->created_at)) }} </td>
                        <td >
                            <a class="btn btn-primary" href=" {{ route('admin.messages.show', $message->id) }}"><i
                                    class="fa-regular fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
