<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Specialization;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        $specializations = Specialization::all();
        return view('admin.accounts.index', compact('accounts', 'specializations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = Specialization::all();
        $account = new Account();
        return view('admin.accounts.create', compact('specializations', 'account'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        //var_dump('controller');

        $formData = $request->validated();
        //CREATE SLUG
        // $slug = Account::getSlug($formData['title']);
        //add slug to formData
        //$formData['slug'] = $slug;

        if ($request->hasFile('image')) {
            $img_path = Storage::put('image', $request->image);
            $formData['preview'] = $img_path;
        }
        if ($request->hasFile('cv')) {
            $cv_path = Storage::put('cv', $request->cv);
            $formData['cv-preview'] = $cv_path;
        }
        $formData['visible'] = 1;
        $account = Account::create($formData);
        Auth::login($account);
        return redirect()->route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        $reviews = Review::all();
        $messages = Message::all();
        return view('admin.accounts.show', compact('account', 'reviews', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        $user_id = Auth::id();
        $specializations = Specialization::all();
        return view('admin.accounts.edit', compact('account', 'specializations', 'user_id'));
        //return view('admin.accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $request->validate(
            [
                'phone' => ['nullable', 'numeric', 'min:9', Rule::unique('accounts')->ignore($account->id)],
                'image' => 'nullable|image|mimes:png,jpg,jpeg',
                'cv' => 'nullable|file:pdf',
                'address' => 'required|min:3|max:1000',
                'performances' => 'nullable|string|min:3|max:1000',
                'specialization' => 'required',
            ],
            [
                'phone.numeric' => 'Il telefono può contenere solo numeri',
                'phone.min' => 'Il telefono deve avere almeno :min cifre',
                'phone.unique' => 'Il telefono risulta già assegnato ad un altro utente',
                'image.image' => 'La foto profilo deve essere una foto',
                'cv.file' => 'Il CV deve essere un PDF',
                'address.string' => 'Inseriti caratteri non validi',
                'performances.string' => 'Inseriti caratteri non validi',
                'specialization' => 'Seleziona una specializzazione tra quelle disponibili.',
            ],
        );
        $data = $request->all();
        //adding image data
        if (array_key_exists('image', $data)) {
            // Check if we already have a profile image
            if ($account->image) {
                // Extract the relative path from the absolute URL
                $image_path = str_replace(asset('storage/'), '', $account->image);
                // Delete the old profile image using the relative path
                Storage::delete($image_path);
            }
            // Store the uploaded image in images directory
            $img_path = $data['image']->store('account_images', 'public');

            // Generate the absolute URL for the stored image
            $img_url = asset('storage/' . $img_path);

            // Update the 'image' field with the absolute URL
            $data['image'] = $img_url;
        }

        //updating cv data
        if (array_key_exists('cv', $data)) {
            // Check if we already have a cv
            if ($account->cv) {
                // Extract the relative path from the absolute URL
                $old_cv_path = str_replace(asset('storage/'), '', $account->cv);
                // Delete the old profile image using the relative path
                Storage::delete($old_cv_path);
            }
            // Store the uploaded cv in account_cvs directory
            $cv_path = $data['cv']->store('account_cvs', 'public');

            // Generate the absolute URL for the stored cv
            $cv_url = asset('storage/' . $cv_path);

            // Update the 'cv' field with the absolute URL
            $data['cv'] = $cv_url;
        }

        $account->update($data);

        //aggiungiamo l'id dell'utente proprietario del post

        // Gestione delle specializzazioni
        $account_specialization_ids = [];

        foreach ($account->specializations as $acc_spec) {
            $account_specialization_ids[] = $acc_spec->id;
        }

        // Se una specializzazione dei dati non è contenuta nelle specializzazioni del dottore, la inserisco
        foreach ($data['specialization'] as $data_spec) {
            if (!in_array($data_spec, $account_specialization_ids)) {
                $account->specializations()->attach($data_spec);
            }
        }

        // Se una specializzazione del dottore non è contenuta nelle specializzazioni dei dati, la tolgo
        foreach ($account_specialization_ids as $acc_spec_id) {
            if (!in_array($acc_spec_id, $data['specialization'])) {
                $account->specializations()->detach($acc_spec_id);
            }
        }
        return redirect()->route('admin.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return to_route('admin.accounts.index')->with('message', "$account->title eliminato con successo");
    }
}
