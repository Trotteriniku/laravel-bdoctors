<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Specialization;
use App\Models\Account;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $accounts = Account::all();
        $specializations = Specialization::all();
        return view('auth.register', compact('accounts', 'specializations'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $specializations = Specialization::all();
        //dd($request->specializations);
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'surname' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'specializations' => ['required', 'array'],
                'specializations.*' => ['exists:specializations,id'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'surname' => $request->surname,
            'visibile' => 1,
            'password' => Hash::make($request->password),
        ]);
        $account = new Account();
        $account->address = $request->address;
        $account['user_id'] = $user->id;
        $account->visible = 1;
        $account->save();

        if (!empty($request->specializations)) {
            $account->specializations()->attach($request->specializations);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
