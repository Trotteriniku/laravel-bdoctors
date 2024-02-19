<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Account;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        /**
         * account_id
         * content
         * title
         * name
         * email
         */

        $request->validate(
            [
                'account_id' => ['required', 'numeric'],
                'content' => 'nullable',
                'title' => 'required|min:3|max:255|string',
                'name' => 'required|min:3|max:255|string',
                'email' => 'required|email|min:3|max:1000',
            ],
            [
                'account_id.required' => 'L\'account ID è obbligatorio e deve essere numerico.',
                'account_id.numeric' => 'L\'account ID deve essere un numero.',

                'title.required' => 'Il titolo è obbligatorio.',
                'title.min' => 'Il titolo deve contenere almeno :min caratteri.',
                'title.max' => 'Il titolo non può superare :max caratteri.',
                'title.string' => 'Il titolo deve essere una stringa.',

                'name.required' => 'Il nome è obbligatorio.',
                'name.min' => 'Il nome deve contenere almeno :min caratteri.',
                'name.max' => 'Il nome non può superare :max caratteri.',
                'name.string' => 'Il nome deve essere una stringa.',

                'email.required' => 'L\'indirizzo email è obbligatorio.',
                'email.email' => 'L\'indirizzo email deve essere valido.',
                'email.min' => 'L\'indirizzo email deve contenere almeno :min caratteri.',
                'email.max' => 'L\'indirizzo email non può superare :max caratteri.',
            ],
        );
        Account::findOrFail($request->account_id);

        $data = $request->all();
        $message = Message::create($data);
        dd($message);
    }
}
