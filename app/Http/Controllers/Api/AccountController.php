<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    // PRESI TUTTI I DATI DI ACCOUNT E CONVERTITI IN UN FILE JSON
    public function index(Request $request)
    {
        $specializationId = $request->query('specialization');

        if ($specializationId) {
            $accounts = Account::whereHas('specializations', function ($query) use ($specializationId) {
                // Qui specifico che 'id' si riferisce alla tabella delle specializzazioni
                $query->where('specializations.id', $specializationId);
            })->with(['specializations', 'sponsorships', 'ratings', 'user'])->get();
        } else {
            $accounts = Account::with(['specializations', 'sponsorships', 'ratings', 'user'])->get();
        }

        return response()->json(
            [
                'success' => true,
                'results' => $accounts
            ]
        );

    }

    // PRESI DATI ACCOUNT + ALTRE ENTITTA' E CONVERTITI IN FILE JSON
    public function show($id)
    {
        $accounts = Account::where('id', $id)->with('specializations', 'sponsorships', 'ratings', 'user')->first();
        return response()->json($accounts);
    }
}

/*
public function index(Request $request)
{
    $specializationId = $request->query('specialization');
    $rating = $request->query('rating'); // Assumiamo che 'rating' sia un valore minimo per il filtro

    // Inizia con una query base che include le relazioni desiderate
    $query = Account::with(['specializations', 'sponsorships', 'ratings', 'user']);

    // Applica il filtro di specializzazione, se presente
    if ($specializationId) {
        $query = $query->whereHas('specializations', function ($query) use ($specializationId) {
            $query->where('id', $specializationId);
        });
    }

    // Applica il filtro di valutazione, se presente
    if ($rating) {
        $query = $query->whereHas('ratings', function ($query) use ($rating) {
            $query->where('rating', '>=', $rating); // Assicurati che 'rating' sia il nome corretto del campo nella tua tabella di valutazioni
        });
    }

    // Esegui la query e ottieni i risultati
    $accounts = $query->get();

    // Restituisci i risultati come JSON
    return response()->json([
        'success' => true,
        'results' => $accounts
    ]);
}
 */
