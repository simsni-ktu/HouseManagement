<?php

use App\Http\Controllers\AuthController;
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


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::group([
    'middleware' => [\App\Http\Middleware\UnauthenticatedAccessMiddleware::class],
], function ($router) {
    Route::apiResource('/residences', ResidenceController::class);
    Route::apiResource('/residences.listings', ResidenceListingController::class);
    Route::apiResource('/residences.listings.comments', ResidenceListingCommentController::class);
});
