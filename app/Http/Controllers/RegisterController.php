<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
        //return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
