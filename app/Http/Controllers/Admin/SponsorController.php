<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Gateway as BraintreeGateway;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsorships = Sponsorship::all();
        $clientToken = $this->getClientToken(); // Ottieni il token del cliente come stringa
        return view('admin.sponsors.index', compact('sponsorships', 'clientToken'));
    }

    // Metodo per generare il client token
    public function getClientToken()
    {
        $gateway = new BraintreeGateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        return $gateway->clientToken()->generate(); // Ritorna il token come stringa
    }

    // Questo metodo dovrebbe essere completato con la logica per processare il pagamento
    public function store(Request $request)
    {
        // Configura il gateway Braintree
        // Usa $request->paymentMethodNonce e altri parametri per creare una transazione
        // ...
    }
}
