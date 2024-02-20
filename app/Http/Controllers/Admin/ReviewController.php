<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\AccountRating;
//use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('account_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $ratings = AccountRating::where('account_id', Auth::id())->get();
        //dd($reviews);
        return view('admin.reviews.index', compact('reviews', 'ratings'));
    }

    public function show($id)
    {
        //dd($id);
        $review = Review::findOrFail($id);

        return view('admin.reviews.show', compact('review'));
    }
}
