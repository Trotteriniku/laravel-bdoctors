<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\AccountFilter;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('specializations', [SpecializationController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// CREATE ROTTE API
Route::get('accountfilter', [AccountFilter::class, 'index']);

Route::get('accounts', [AccountController::class, 'index']);
Route::get('accounts/{id}', [AccountController::class, 'show']);
Route::get('accounts/{id}/{AVGrating}/{minNumberReviews}', [AccountController::class, 'indexBySpecializationsAndRatingAndReviews']);
//Route::get('accounts/advanced', [AccountController::class, 'indexBySpecializationsAndRatingAndReviewsAdvanced']);

//rotta per prendere una risorsa
Route::get('specializations', [SpecializationController::class, 'index']);
