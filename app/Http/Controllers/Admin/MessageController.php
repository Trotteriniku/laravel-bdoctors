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
        $messages = Message::where('account_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $title = 'BDoc | Dashboard  - Messaggi';
        return view('admin.messages.index', compact('messages', 'title'));

    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        $title = 'BDoc | Dashboard - Messaggio';
        return view('admin.messages.show', compact('message', 'title'));
    }


    public function destroy(Message $message)
    {
        //
    }
}
