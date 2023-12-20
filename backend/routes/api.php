<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
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




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('/residences', ResidenceController::class);
    Route::apiResource('/residences.listings', ResidenceListingController::class);
    Route::apiResource('/residences.listings.comments', ResidenceListingCommentController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/token/refresh', [AuthController::class, 'refresh']);
    Route::get('/listings', [ListingController::class, 'index']);

});
