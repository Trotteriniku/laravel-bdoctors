<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Review;
use App\Models\Account;
use App\Models\AccountRating;
use Illuminate\Support\Facades\Auth;

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



        return view('admin.dashboard', compact('messages', 'reviews', 'ratings', 'averageRating', 'totalReviews', 'totalMessages'));
    }
}
