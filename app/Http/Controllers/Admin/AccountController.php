<?php

namespace App\Http\Controllers\Admin;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Specialization;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        $specializations = Specialization::all();
        return view('accounts.index', compact('accounts', 'specializations'));
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
        return view('admin.accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $formData = $request->validated();
        //CREATE SLUG
        if ($account->title !== $formData['title']) {
            $slug = Account::getSlug($formData['title']);
            $formData['slug'] = $slug;
        }
        //add slug to formData

        if ($request->hasFile('image')) {
            if ($account->image) {
                Storage::delete($account->image);
            }
            $img_path = Storage::put('images', $formData['image']);
            $formData['image'] = $img_path;
        }

        //aggiungiamo l'id dell'utente proprietario del post
        $formData['user_id'] = $account->user_id;

        $account->update($formData);

        if ($request->has('sponsorships', 'ratings', 'specializations')) {
            $account->specializations()->sync($request->specializations);
            $account->sponsorships()->sync($request->sponsorships);
            $account->ratings()->sync($request->ratings);
        } else {
            $account->specializations()->detach();
            $account->ratings()->detach();
            $account->sponsorships()->detach();
        }

        return redirect()->route('admin.accounts.show', $account->slug);
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
