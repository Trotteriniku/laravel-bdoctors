<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    // PRESI TUTTI I DATI DI ACCOUNT E CONVERTITI IN UN FILE JSON
    public function index()
    {
        $accounts = Account::with(['specializations', 'sponsorships', 'ratings', 'user'])->get();
        // return response()->json($accounts, );
        return response()->json(
            [
                'success' => true,
                'results' => $accounts
            ]
        );

    }

    // PRESI DATI ACCOUNT + ALTRE ENTITTA' E CONVERTITI IN FILE JSON
    public function show($id)
    {
        $accounts = Account::where('id', $id)->with('specializations', 'sponsorships', 'ratings', 'user')->first();
        return response()->json($accounts);
    }
}
