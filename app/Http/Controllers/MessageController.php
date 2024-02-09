<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
