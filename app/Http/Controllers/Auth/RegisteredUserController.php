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
use Illuminate\Support\Facades\Storage;

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
                'image' => ['image', 'mimes:png,jpg,jpeg'],
                'cv' => ['file', 'mimes:pdf', 'max:1000'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'surname' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'specializations' => ['required', 'array'],
                'specializations.*' => ['exists:specializations,id'],
                'performance' => ['max:500'],
                'phone' => ['min:9'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'image.image' => 'Il file deve essere un immagine',
                'image.mimes' => 'Utilizza uno dei formati accettati: .png, .jpg, .jpeg',
                'cv.mimes' => 'Il CV deve essere in formato PDF',
                'address.required' => 'L\'indirizzo è obbligatorio',
                'address.min' => 'L\'indirizzo deve contenere almeno :min caratteri',
                'address.max' => 'L\'indirizzo deve contenere almeno :max caratteri',
                'performance.max' => 'La performance deve essere di massimo :max caratteri',
                'user_id.numeric' => 'user id deve essere un numero',
                'phone.min' => 'Il numero di telefono deve essere di :min caratteri',
                'email.required' => 'L\'email è obbligatoria',
                'email.unique' => 'L\'email deve essere univoca',
                'name.required' => 'Il nome è obbligatorio',
                'name.max' => 'Il nome deve essere di massimo :max caratteri',
                'surname.required' => 'Il cognome è obbligatorio',
                'surname.max' => 'Il cognome deve essere di massimo :max caratteri',
                'specializations.required' => 'La specializazione è obbligatoria',
                'password.required' => 'La password è obbligatoria',
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
        $account->phone = $request->phone;
        $account->performances = $request->performance;
        $account['user_id'] = $user->id;
        $account->visible = 1;
        //inserting cv url to curriculum

        if ($request->hasFile('cv')) {
            $file_url = Storage::putFile('account_cvs', $request->file('cv'));
            $file_url = 'storage/' . $file_url;
            $account->cv = $file_url;
        }

        //inserting img url data into profile photo
        if ($request->hasFile('image')) {
            $img_url = Storage::putFile('account_images', $request['image']);
            $img_url = 'storage/' . $img_url;
            $account['image'] = $img_url;
        }

        $account->save();

        if (!empty($request->specializations)) {
            $account->specializations()->attach($request->specializations);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
