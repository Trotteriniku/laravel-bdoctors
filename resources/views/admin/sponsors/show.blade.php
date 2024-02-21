@extends('layouts.admin')

@section('content')
    <div class="container d-flex  justify-content-center mt-5 pt-5 ">
        <form action="{{ route('admin.sponsors.store') }}" method="POST">
            @csrf
            <input type="hidden" id="sponsor" name="sponsor" value="{{ $sponsorship->id }}" />
            <div id="dropin-wrapper"></div>
            <div id="checkout-message">prezzo: {{ $sponsorship->price }}</div>
            <div id="dropin-container" class="shadow-lg"></div>
            <button type="submit" id="submit-button" class="">Payment submit</button>
        </form>
    </div>
    </div>
    <script>
        let button = document.querySelector('#submit-button');

        braintree.dropin.create({
            // Insert your tokenization key here
            authorization: 'sandbox_385ng8rr_3kk8b2d8r9s3zn4d',
            container: '#dropin-container'
        }, function(createErr, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(requestPaymentMethodErr, payload) {
                    // When the user clicks on the 'Submit payment' button this code will send the
                    // encrypted payment information in a variable called a payment method nonce
                    $.ajax({
                        type: 'POST',
                        url: '/checkout',
                        data: {
                            'paymentMethodNonce': payload.nonce
                        }
                    }).done(function(result) {
                        // Tear down the Drop-in UI
                        instance.teardown(function(teardownErr) {
                            if (teardownErr) {
                                console.error('Could not tear down Drop-in UI!');
                            } else {
                                console.info('Drop-in UI has been torn down!');
                                // Remove the 'Submit payment' button
                                $('#submit-button').remove();
                            }
                        });

                        if (result.success) {
                            $('#checkout-message').html(
                                '<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>'
                            );
                        } else {
                            console.log(result);
                            $('#checkout-message').html(
                                '<h1>Error</h1><p>Check your console.</p>');
                        }
                    });
                });
            });
        });
    </script>
@endsection
