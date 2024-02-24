<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Review;
use App\Models\Account;
use App\Models\AccountRating;
use App\Models\AccountSponsorship;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $account_id = Auth::id();
        $account = Account::findOrFail($account_id);
        $messages = Message::where('account_id', $account_id)->get();
        $reviews = Review::where('account_id', $account_id)->get();
        $ratings = AccountRating::where('account_id', $account_id)->get();

        $averageRating = AccountRating::where('account_id', $account_id)->avg('rating_id');
        $totalMessages = Message::where('account_id', $account_id)->count();
        $totalReviews = Review::where('account_id', $account_id)->count();

        //prendo lo sponsor attivo
        $activeSponsor = AccountSponsorship::where('account_id', $account_id)->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now())->first();

        //dd($activeSponsor);
        return view('admin.dashboard', compact('messages', 'reviews', 'ratings', 'averageRating', 'totalReviews', 'totalMessages', 'activeSponsor'));
    }
}
