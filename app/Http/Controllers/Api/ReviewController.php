<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

class ReviewController extends Controller
{
    // ricordarsi di passare anche il doctors_id
    /**
     * {account_id}
     * {name}
     * {title}
     * {email}
     * {content}
     *
     */
    public function store(Request $request)
    {
        $request->validate(
            ['account_id' => ['required', 'numeric'], 'name' => ['required'], 'email' => ['required', 'email'], 'title' => ['required'], 'content' => ['required', 'min:4', 'max:1000']],
            [
                'account_id.required' => 'L\'account ID è obbligatorio e deve essere numerico.',
                'account_id.numeric' => 'L\'account ID deve essere un numero.',
                'name.required' => 'Il nome è obbligatorio',
                'email.required' => 'La email è obbligatoria',
                'email.email' => 'Deve essere una email valida ',
                'title.required' => 'Il titolo è obbligatorio',
                'content.required' => 'Il contenuto è obbligatorio',
                'content.min' => 'Il contenuto deve avere min:caratteri',
                'content.max' => 'Il contenuto deve avere max:caratteri',
            ],
        );
        Account::findOrFail($request->account_id);
        $data = $request->all();

        //$review = new Review();
        //$review->fill($data);
        //$review->save();
        $review = Review::create($data);
        dd($review);
    }
}
