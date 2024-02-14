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
        $accounts = Account::all();
        return response()->json($accounts);
    }

    // PRESI DATI ACCOUNT + ALTRE ENTITTA' E CONVERTITI IN FILE JSON
    public function show($id)
    {
        $accounts = Account::where('id', $id)->with('specializations', 'sponsorships', 'ratings')->first();
        return response()->json($accounts);
    }
}
