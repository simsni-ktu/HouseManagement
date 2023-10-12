<?php

use App\Http\Controllers\ResidenceListingCommentController;
use App\Http\Controllers\ResidenceListingController;
use App\Http\Controllers\ResidenceController;
use Illuminate\Support\Facades\Route;

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



Route::apiResource('/residences', ResidenceController::class);
Route::apiResource('/residences.listings', ResidenceListingController::class);
Route::apiResource('/residences.listings.comments', ResidenceListingCommentController::class);

