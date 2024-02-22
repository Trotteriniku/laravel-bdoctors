<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class AccountFilter extends Controller
{
    public function isVisible($account)
    {
        // Controlla se esiste una sponsorizzazione attiva
        $now = Carbon::now();
        return $account->sponsorships()->where('start_date', '<=', $now)->where('end_date', '>=', $now)->exists();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //public function index(string $spec_id, string $min_avg_rating, int $minReviews)

        //specializzazione
        $specializationId = $request->query('s'); // obbligatorio

        //media voti minimi
        if ($request->query('mar')) {
            $minVote = $request->query('mar');
        } else {
            $minVote = 0;
        }

        //numero recensioni minime

        if ($request->query('mr')) {
            $reviewsMinum = $request->query('mr');
        } else {
            $reviewsMinum = 0;
        }
        //ASC // DESC
        if ($request->query('order')) {
            $order = $request->query('order');
        } else {
            $order = 'DESC';
        }

        $accounts = Account::with(['user', 'specializations', 'ratings', 'reviews'])
            ->select('accounts.*')
            ->leftJoin('reviews', 'accounts.id', '=', 'reviews.account_id')
            ->whereHas('specializations', function ($query) use ($specializationId) {
                $query->where('specializations.id', $specializationId);
            })
            ->groupBy('accounts.id')
            ->selectRaw('COUNT(reviews.id) as review_count')
            ->havingRaw('COUNT(reviews.id) >= ?', [$reviewsMinum])

            ->get();

        //se nella query non vengono specificate le ratings, allora possiamo ignorare il filtro per voto medio
        //if ($minVote > 0) {
        $accounts = $accounts->filter(function ($account) use ($minVote) {
            $averageRating = $account->ratings()->avg('value');

            if (empty($averageRating)) {
                $averageRating = 0;
            }
            $account->average_rating = $averageRating;

            //$averageRating = $account->ratings()->get();
            return $averageRating >= $minVote;
        });

        $accounts = $accounts->filter(function ($account) {
            $numberReview = $account->reviews()->count();

            if (empty($numberReview)) {
                $numberReview = 0;
            }
            $account->total_reviews = $numberReview;

            //$averageRating = $account->ratings()->get();
            return true;
        });
        //// dd(array(...$accounts));

        $accounts = [...$accounts];
        $totalReviews = array_column($accounts, 'total_reviews');

        // Ordina l'array principale in base all'array di valori di 'total_reviews'
        if ($order === 'DESC') {
            array_multisort($totalReviews, SORT_DESC, $accounts);
        } else {
            array_multisort($totalReviews, SORT_ASC, $accounts);
        }

        foreach ($accounts as $account) {
            $account['visible'] = $this->isVisible($account);
        }

        //}
        //pagination
        // $accounts = new LengthAwarePaginator($accounts->values()->forPage(request()->input('page'), 20), $accounts->count(), 20, null, ['path' => url()->current()]);

        return response()->json([
            'success' => true,
            'results' => $accounts,
        ]);
    }
}
