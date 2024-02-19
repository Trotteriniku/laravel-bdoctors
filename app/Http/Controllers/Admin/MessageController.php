<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::where('account_id', Auth::id())->get();
        return view('admin.messages.index', compact('messages'));

    }



    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }


    public function destroy(Message $message)
    {
        //
    }
}
