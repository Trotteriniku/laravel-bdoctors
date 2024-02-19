<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AccountRating;
use App\Models\Account;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $account_id = $request->account_id;
        $rating = $request->rating_id;

        Account::findOrFail($account_id);

        if (!is_int($rating) || $rating > 5 || $rating < 1) {
            return response()->json([
                'success' => false,
                'error' => 'inserire un numero intero tra 1 e 5',
            ]);
        }

        $accountRating = AccountRating::create([
            'account_id' => $account_id,
            'rating_id' => $rating,
        ]);
    }
}
