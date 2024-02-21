<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Gateway as BraintreeGateway;
use App\Models\Account;
use App\Models\AccountSponsorship;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SponsorController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        $sponsorships = Sponsorship::all();
        $clientToken = $this->getClientToken(); // Ottieni il token del cliente come stringa
        return view('admin.sponsors.index', compact('sponsorships', 'clientToken', 'accounts'));
    }

    public function show($id)
    {
        $sponsorship = Sponsorship::findOrFail($id);
        return view('admin.sponsors.show', compact('sponsorship'));
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
        // dd($request);
        $sponsorship_id = $request->sponsor;
        $sponsorship = Sponsorship::findOrFail($sponsorship_id);

        $doctor_id = Auth::id();

        $start_date = Carbon::now();
        //dd($start_date);
        //select sponsorship
        if ($sponsorship_id == 1) {
            $end_date = Carbon::now()->addDay();
            //$end_date = $start_date + 86400;
        } elseif ($sponsorship_id == 2) {
            $end_date = Carbon::now()->addDay(3);
        } elseif ($sponsorship_id == 3) {
            $end_date = Carbon::now()->addDay(6);
        }
        //dd($end_date);

        //
        $accountSponsor = AccountSponsorship::create([
            'account_id' => $doctor_id,
            'sponsorship_id' => $sponsorship_id,
            'start_date' => $start_date,
            'end_date' => $end_date,

        ]);
        dd('fatto');
    }
}