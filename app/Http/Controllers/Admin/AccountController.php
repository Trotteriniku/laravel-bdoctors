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


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        return view('admin.accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $formData = $request->validated();
        //CREATE SLUG
        $slug = Account::getSlug($formData['title']);
        //add slug to formData
        $formData['slug'] = $slug;
        //prendiamo l'id dell'utente loggato
        $userId = Auth::id();
        //dd($userId);
        //aggiungiamo l'id dell'utente
        $formData['user_id'] = $userId;


        if ($request->hasFile('image')) {
            $img_path = Storage::put('images', $request->image);
            $formData['preview'] = $img_path;
        }
        $account = Account::create($formData);
        if ($request->has('sponsorships', 'ratings', 'specializations')) {
            $account->sponsorships()->attach($request->sponsorships);
            $account->ratings()->attach($request->ratings);
            $account->specializations()->attach($request->specializations);
        }
        return redirect()->route('admin.accounts.show', $account->slug);
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
            $account->technologies()->sync($request->technologies);
            $account->sponsorships()->sync($request->sponsorships);
            $account->ratings()->sync($request->ratings);
        } else {
            $account->technologies()->detach();
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
