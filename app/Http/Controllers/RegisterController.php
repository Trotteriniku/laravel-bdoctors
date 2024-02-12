<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('user.index');
        //return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
