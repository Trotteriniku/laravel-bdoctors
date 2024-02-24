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

        $reviewsCount = DB::table('reviews')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->where('account_id', $account_id)
            ->whereYear('created_at', $year) // Filtra per l'anno corrente
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('count', 'month'); // Crea un array associativo [mese => conteggio]

        //anno precedente

        $lastYear = now()->year - 1; // Considera l'anno precedente

        $lastReviewsCount = DB::table('reviews')
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

        $monthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyCounts[$monthNames[$m]] = $reviewsCount->get($m, 0);
        }

        $lastMonthlyCounts = [];
        for ($m = 1; $m <= 12; $m++) {
            $lastMonthlyCounts[$monthNames[$m]] = $lastReviewsCount->get($m, 0);
        }


        // dd($monthlyCounts);

        //dd($activeSponsor);
        return view('admin.dashboard', compact('messages', 'reviews', 'ratings', 'averageRating', 'totalReviews', 'totalMessages', 'activeSponsor', 'monthlyCounts', 'lastMonthlyCounts'));
    }
}





// {
//     public function showStatistics($doctorId)
//     {
//         $messagesPerMonthYear = Message::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month'), DB::raw('count(*) as count'))
//             ->where('account_id', $doctorId)
//             ->groupBy('year', 'month')
//             ->orderBy('year', 'desc')
//             ->orderBy('month', 'desc')
//             ->get();

//         $reviewsPerMonthYear = Review::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month'), DB::raw('count(*) as count'))
//             ->where('account_id', $doctorId)
//             ->groupBy('year', 'month')
//             ->orderBy('year', 'desc')
//             ->orderBy('month', 'desc')
//             ->get();

//         // Continua con il codice per preparare i dati per i grafici...
//     }
// }
