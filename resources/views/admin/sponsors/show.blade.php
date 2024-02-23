@extends('layouts.admin')

@section('content')
    <main id="main" class="main">
        <div class="container  d-flex  justify-content-center mt-5 pt-5 ">

            {{--   <div id="paymentLoader" style="display: none;">Caricamento...<svg id="spinner" viewBox="25 25 50 50">
                    <circle r="20" cy="50" cx="50"></circle>
                </svg></div> --}}
            <div id="paymentSuccessMessage" style="display: none;">Pagamento riuscito!</div>
            <form action="{{ route('admin.sponsors.store') }}" method="POST" id="cardForm">
                @csrf
                <div class="panel position-relative ">
                    <div id="paymentLoader" style="display: none;"
                        class="text-center pt-5 bg-primary position-absolute top-0 end-0 bottom-0 start-0">
                        <h3 class="text-white"> <i class="fa-solid fa-wallet fa-bounce fa-xl text-white"></i> Caricamento..
                        </h3>

                        <i class=" mt-5 fa-solid  text-white fa-spinner fa-spin-pulse fa-spin-reverse  fs-1"></i>
                    </div>
                    <header class="panel__header">
                        <h1>Pagamento con Carta</h1>
                    </header>
                    <input type="hidden" id="sponsor" name="sponsor" value="{{ $sponsorship->id }}" />
                    <div class="panel__content">
                        <div class="textfield--float-label">
                            <!-- Begin hosted fields section -->
                            <label class="hosted-field--label" for="card-number">

                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                                    </svg></span> Numero Carta
                            </label>
                            <div id="card-number" class="hosted-field">
                            </div>
                            <!-- End hosted fields section -->
                        </div>
                        <div class="textfield--float-label">
                            <!-- Begin hosted fields section -->
                            <label class="hosted-field--label" for="expiration-date">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z" />
                                    </svg>
                                </span>
                                Data di scadenza</label>
                            <div id="expiration-date" class="hosted-field">
                            </div>
                            <!-- End hosted fields section -->
                        </div>
                        <div class="textfield--float-label">
                            <!-- Begin hosted fields section -->
                            <label class="hosted-field--label" for="cvv">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z" />
                                    </svg>
                                </span>
                                CVV</label>
                            <div id="cvv" class="hosted-field">
                            </div>
                            <!-- End hosted fields section -->
                        </div>
                        <div class="textfield--float-label">
                            <!-- Begin hosted fields section -->
                            <label class="hosted-field--label" for="postal-code">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                    </svg>
                                </span>
                                Codice Postale</label>
                            <div id="postal-code" class="hosted-field">
                            </div>
                            <!-- End hosted fields section -->
                        </div>
                    </div>
                    <footer class="panel__footer ">
                        <div class="text-center">Stai effettuando un pagamento di {{ $sponsorship->price }}€ </div>
                        <div class="text-center">La sponsorizzazione avrà una durata di
                            {{ substr($sponsorship->duration, 0, -3) }} ore </div>
                        <div class="d-flex">
                            <button class="pay-button text-center mt-3" type="submit">Paga</button>
                        </div>

                    </footer>
                </div>
            </form>

        </div>
    </main>
    <script>
        //alert();
        braintree.client.create({
            authorization: @json(env('BRAINTREE_TOKENIZATION_KEY', 'default_value'))
        }, function(err, clientInstance) {
            if (err) {
                console.error(err);
                return;
            }

            braintree.hostedFields.create({
                client: clientInstance,
                styles: {
                    'input': {
                        'font-size': '16px',
                        'font-family': 'roboto, verdana, sans-serif',
                        'font-weight': 'lighter',
                        'color': 'black'
                    },
                    ':focus': {
                        'color': 'black'
                    },
                    '.valid': {
                        'color': 'black'
                    },
                    '.invalid': {
                        'color': 'black'
                    }
                },
                fields: {
                    number: {
                        selector: '#card-number',
                        placeholder: '1111 1111 1111 1111'
                    },
                    cvv: {
                        selector: '#cvv',
                        placeholder: '111'
                    },
                    expirationDate: {
                        selector: '#expiration-date',
                        placeholder: 'MM/YY'
                    },
                    postalCode: {
                        selector: '#postal-code',
                        placeholder: '11111'
                    }
                }
            }, function(err, hostedFieldsInstance) {
                if (err) {
                    console.error(err);
                    return;
                }

                function findLabel(field) {
                    return $('.hosted-field--label[for="' + field.container.id + '"]');
                }

                hostedFieldsInstance.on('focus', function(event) {
                    let field = event.fields[event.emittedBy];

                    findLabel(field).addClass('label-float').removeClass('filled');
                });

                // Emulates floating label pattern
                hostedFieldsInstance.on('blur', function(event) {
                    let field = event.fields[event.emittedBy];
                    let label = findLabel(field);

                    if (field.isEmpty) {
                        label.removeClass('label-float');
                    } else if (field.isValid) {
                        label.addClass('filled');
                    } else {
                        label.addClass('invalid');
                    }
                });

                hostedFieldsInstance.on('empty', function(event) {
                    let field = event.fields[event.emittedBy];

                    findLabel(field).removeClass('filled').removeClass('invalid');
                });

                hostedFieldsInstance.on('validityChange', function(event) {
                    let field = event.fields[event.emittedBy];
                    let label = findLabel(field);

                    if (field.isPotentiallyValid) {
                        label.removeClass('invalid');
                    } else {
                        label.addClass('invalid');
                    }
                });

                $('#cardForm').submit(function(event) {
                    event.preventDefault(); // Impedisce il submit predefinito del form

                    // Mostra il loader prima dell'inizio del processo di tokenizzazione
                    $('#paymentLoader').show();

                    hostedFieldsInstance.tokenize(function(err, payload) {
                        if (err) {
                            console.error(err);
                            // Nascondi il loader in caso di errore
                            $('#paymentLoader').hide();
                            return;
                        }

                        // Crea un input nascosto con il nonce e aggiungilo al form
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'payment_method_nonce',
                            value: payload.nonce
                        }).appendTo('#cardForm');

                        // Invia il form. Il loader rimarrà visibile fino a quando la pagina non verrà ricaricata o non verrà eseguito il redirect.
                        $('#cardForm').get(0).submit();
                    });
                });

            });
        });
    </script>
@endsection
