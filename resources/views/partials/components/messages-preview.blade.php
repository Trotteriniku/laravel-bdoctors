<div class=" card card-body">
    <h5 class="card-title">Messaggi</h5>
    <div class="container-fluid">
        <div class="row">
        @if ($totalMessages)
        <table class="table table-borderless datatable col-12">
            <thead>
                <tr>
                    <th scope="col " class="fst-italic">Titolo</th>
                    <th scope="col" class="fst-italic">Ora</th>
                    <th scope="col" class="fst-italic">Nome</th>
                    <th scope="col" class="fst-italic invisible-1100">Mail</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach ($messages as $message)
                    <tr class="col-12">
                        <td class="fw-bold txt-dark">
                            <a href="{{ route('admin.messages.show', $message->id) }}"
                                class="text-decoration-none text-dark">
                                {{ $message->title }}
                            </a>
                        </td>
                        <td><a href="#" class="text-primary">{{ $message->created_at->format('H:i') }}</a></td>
                        <td>{{ $message->name }}</td>
                        <td class="invisible-1100">{{ \Illuminate\Support\Str::limit($message->email, 4) }}</td>
                    </tr>
                @endforeach
            </tbody>



            </tbody>
        </table>
    @else
        <span>non ci sono messaggi</span>
    @endif
        </div>
    </div>


</div>
