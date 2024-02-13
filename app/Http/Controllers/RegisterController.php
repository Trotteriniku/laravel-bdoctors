<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function create()
    {

        $accounts = Account::all();
        $specializations = Specialization::all();
        return view('auth.register', compact('accounts', 'specializations'));

    }
    /*   public function store(Request $request)
      {
          $request->validate([
              'name' => ['required', 'string', 'max:255'],
              'surname' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
          ]);
          $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'surname' => $request->surname,
              'password' => Hash::make($request->password),
          ]);
          $account = new Account();
          $account->address = $request->address;
          $account['user_id'] = $user->id;
          $account->save();
          foreach ($request['specialization'] as $specializations) {
              $account->specializations()->attach($specializations);
          }
          event(new Registered($user));

          Auth::login($user);

          return redirect(RouteServiceProvider::HOME);
      } */
    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
