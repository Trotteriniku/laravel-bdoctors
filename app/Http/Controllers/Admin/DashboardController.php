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
use Illuminate\Support\Facades\DB;

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

        //anno corrente
        $year = now()->year; // Considera l'anno corrente

        // rating
        $ratingCount = DB::table('account_rating')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('AVG(rating_id) as average_rating'))
            ->where('account_id', $account_id)
            ->whereYear('created_at', $year) // Filtra per l'anno corrente
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('average_rating', 'month');

        //messages
        $messagesCount = DB::table('messages')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->where('account_id', $account_id)
            ->whereYear('created_at', $year) // Filtra per l'anno corrente
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('count', 'month');

        //revews

        $reviewsCount = DB::table('reviews')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->where('account_id', $account_id)
            ->whereYear('created_at', $year) // Filtra per l'anno corrente
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('count', 'month');

        //
        //anno precedente
        //

        $lastYear = now()->year - 1; // Considera l'anno precedente

        // ratings
        $lastRatingCount = DB::table('account_rating')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('AVG(rating_id) as average_rating'))
            ->where('account_id', $account_id)
            ->whereYear('created_at', $lastYear) // Filtra per l'anno corrente
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('average_rating', 'month');

        // reviews
        $lastReviewsCount = DB::table('reviews')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->where('account_id', $account_id)
            ->whereYear('created_at', $lastYear) // Filtra per l'anno corrente
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('count', 'month');

        // messages
        $lastMessagesCount = DB::table('messages')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->where('account_id', $account_id)
            ->whereYear('created_at', $lastYear) // Filtra per l'anno corrente
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('count', 'month');

        // Assicurati che l'array contenga tutte i mesi dell'anno con conteggio 0 se non ci sono messaggi
        $monthlyCounts = [];
        $monthNames = [
            1 => 'Gennaio',
            2 => 'Febbraio',
            3 => 'Marzo',
            4 => 'Aprile',
            5 => 'Maggio',
            6 => 'Giugno',
            7 => 'Luglio',
            8 => 'Agosto',
            9 => 'Settembre',
            10 => 'Ottobre',
            11 => 'Novembre',
            12 => 'Dicembre',
        ];

        //ratings
        $monthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyCounts[$monthNames[$m]] = $ratingCount->get($m, 0);
        }

        $lastMonthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $lastMonthlyCounts[$monthNames[$m]] = $lastRatingCount->get($m, 0);
        }

        //messages

        $messagesMonthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $messagesMonthlyCounts[$monthNames[$m]] = $messagesCount->get($m, 0);
        }

        $lastMessagesMonthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $lastMessagesMonthlyCounts[$monthNames[$m]] = $lastMessagesCount->get($m, 0);
        }

        // reviews

        $reviewsMonthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $reviewsMonthlyCounts[$monthNames[$m]] = $reviewsCount->get($m, 0);
        }

        $lastReviewsMonthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $lastReviewsMonthlyCounts[$monthNames[$m]] = $lastReviewsCount->get($m, 0);
        }

        //dd($monthlyCounts);
        $title = 'BDoctors - Dashboard';
        return view('admin.dashboard', compact('messages', 'reviews', 'ratings', 'averageRating', 'totalReviews', 'totalMessages', 'activeSponsor', 'monthlyCounts', 'lastMonthlyCounts', 'messagesMonthlyCounts', 'lastMessagesMonthlyCounts', 'reviewsMonthlyCounts', 'lastReviewsMonthlyCounts', 'title'));
    }

}


