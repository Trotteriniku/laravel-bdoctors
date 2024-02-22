<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function isVisible($account)
    {
        // Controlla se esiste una sponsorizzazione attiva
        $now = Carbon::now();
        return $account->sponsorships()->where('start_date', '<=', $now)->where('end_date', '>=', $now)->exists();
    }
    // PRESI TUTTI I DATI DI ACCOUNT E CONVERTITI IN UN FILE JSON
    public function index(Request $request)
    {
        $specializationId = $request->query('specialization');

        if ($specializationId) {
            $accounts = Account::whereHas('specializations', function ($query) use ($specializationId) {
                // Qui specifico che 'id' si riferisce alla tabella delle specializzazioni
                $query->where('specializations.id', $specializationId);
            })
                ->with(['specializations', 'sponsorships', 'ratings', 'user'])
                ->get();
        } else {
            $accounts = Account::with(['specializations', 'sponsorships', 'ratings', 'user'])->get();
        }

        foreach ($accounts as $account) {
            $account['visible'] = $this->isVisible($account);
        }

        return response()->json([
            'success' => true,
            'results' => $accounts,
        ]);
    }

    public function indexBySpecializationsAndRatingAndReviews(string $spec_id, string $min_avg_rating, int $minReviews)
    {
        $specializationId = $spec_id; // Replace with the desired specialization ID
        $minVote = $min_avg_rating;
        $accounts = Account::with(['user', 'specializations', 'ratings', 'reviews'])
            ->select('accounts.*')
            ->leftJoin('reviews', 'accounts.id', '=', 'reviews.account_id')
            ->whereHas('specializations', function ($query) use ($specializationId) {
                $query->where('specializations.id', $specializationId);
            })
            ->groupBy('accounts.id')
            ->selectRaw('COUNT(reviews.id) as review_count')
            ->havingRaw('COUNT(reviews.id) >= ?', [$minReviews])

            ->get();

        //se nella query non vengono specificate le ratings, allora possiamo ignorare il filtro per voto medio
        if ($minVote !== '0' && $minVote !== null) {
            $accounts = $accounts->filter(function ($account) use ($minVote) {
                $averageRating = $account->ratings()->avg('value');

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

    // PRESI DATI ACCOUNT + ALTRE ENTITTA' E CONVERTITI IN FILE JSON
    public function show($id)
    {
        $account = Account::where('id', $id)->with('specializations', 'sponsorships', 'ratings', 'user')->first();

        $now = Carbon::now();
        $account['visible'] = $account->sponsorships()->where('start_date', '<=', $now)->where('end_date', '>=', $now)->exists();

        return response()->json($account);
    }

    public function checkVisibility()
    {
        $doctor = Auth::user(); // Ottieni il dottore autenticato
        $isVisible = $doctor->isVisible();
        return response()->json(['isVisible' => $isVisible]);
    }
}
