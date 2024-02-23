<div class=" card card-body">
    <h5 class="card-title">Messaggi</h5>

    <table class="table table-borderless datatable">
        <thead>
            <tr>
                <th scope="col" class="fst-italic">Titolo</th>
                <th scope="col" class="fst-italic">Ora</th>
                <th scope="col" class="fst-italic">Nome</th>
                <th scope="col" class="fst-italic">Mail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td class="fw-bold txt-dark">{{ $message->title }}</td>
                    <td><a href="#" class="text-primary">{{ $message->created_at }}</a>
                    </td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                </tr>
            @endforeach


        </tbody>
    </table>

</div>
