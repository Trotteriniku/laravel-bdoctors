<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class AccountFilter extends Controller
{
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
        if ($minVote > 0) {
            $accounts = $accounts->filter(function ($account) use ($minVote) {
                $averageRating = $account->ratings()->avg('value');
                //$averageRating = $account->ratings()->get();
                return $averageRating >= $minVote;
            });
        }
        //pagination
        // $accounts = new LengthAwarePaginator($accounts->values()->forPage(request()->input('page'), 20), $accounts->count(), 20, null, ['path' => url()->current()]);

        return response()->json([
            'success' => true,
            'results' => $accounts,
        ]);
    }
}
