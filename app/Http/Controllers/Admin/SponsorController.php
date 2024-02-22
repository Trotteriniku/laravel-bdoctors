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
use App\Jobs\UpdateAccountVisibility;
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
//    public function storeveccio (Request $request)
//     {
//         // Configura il gateway Braintree
//         // Usa $request->paymentMethodNonce e altri parametri per creare una transazione
//         // ...
//         dd($request);
//         $sponsorship_id = $request->sponsor;
//         $sponsorship = Sponsorship::findOrFail($sponsorship_id);

//         $doctor_id = Auth::id();

//         $start_date = Carbon::now();
//         //dd($start_date);
//         //select sponsorship
//         if ($sponsorship_id == 1) {
//             $end_date = Carbon::now()->addDay();
//             //$end_date = $start_date + 86400;
//         } elseif ($sponsorship_id == 2) {
//             $end_date = Carbon::now()->addDay(3);
//         } elseif ($sponsorship_id == 3) {
//             $end_date = Carbon::now()->addDay(6);
//         }
//         //dd($end_date);

//         //
//         $accountSponsor = AccountSponsorship::create([
//             'account_id' => $doctor_id,
//             'sponsorship_id' => $sponsorship_id,
//             'start_date' => $start_date,
//             'end_date' => $end_date,

//         ]);
//         dd('fatto');
//     }



public function store(Request $request)
{
    //dd($request);
    //$request->sponsor = 2;
    $sponsorship_id = $request->sponsor;
    $sponsorship = Sponsorship::findOrFail($sponsorship_id);
    $request->validate([
        'sponsor' => 'required|exists:sponsorships,id',
        'payment_method_nonce' => 'required',
    ]);


    $gateway = new BraintreeGateway([
        'environment' => env('BRAINTREE_ENVIRONMENT'),
        'merchantId' => env('BRAINTREE_MERCHANT_ID'),
        'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
        'privateKey' => env('BRAINTREE_PRIVATE_KEY')
    ]);

    $result = $gateway->transaction()->sale([
        'amount' => $sponsorship->price, // Assumi che questo sia il costo della sponsorizzazione. Dovresti recuperarlo dinamicamente.
        'paymentMethodNonce' => $request->payment_method_nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    $doctor_id = Auth::id();
    $start_date = Carbon::now();

    if ($request->sponsor == 1) {
        $end_date = Carbon::now()->addSeconds(15);
        //$end_date = $start_date + 86400;
    } elseif ($request->sponsor== 2) {
        $end_date = Carbon::now()->addDays(3);
    } elseif ($request->sponsor == 3) {
        $end_date = Carbon::now()->addDays(6);
    }

    if ($result->success) {
        AccountSponsorship::create([
            'account_id' => $doctor_id,
            'sponsorship_id' => $sponsorship_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
        $account = Account::find($doctor_id);
        if ($account) {
            $account->update(['visible' => 1]);
            // Programma il job per impostare 'visible' a 0 al termine della sponsorizzazione.
            $this->scheduleVisibilityUpdate($doctor_id, $end_date);
        }

        return redirect()->route('admin.accounts.show', ['account' => $doctor_id])->with('success', 'Pagamento effettuato con successo.');

    } else {
        return back()->withErrors('Errore nel processamento del pagamento.');
    }
}
private function scheduleVisibilityUpdate($doctor_id, $endDate)
{
    // Pianifica un job per aggiornare il campo 'visible' a '0' alla data di fine sponsorizzazione
    UpdateAccountVisibility::dispatch($doctor_id)->delay($endDate);
}
}
