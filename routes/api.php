<?php

use App\Http\Controllers\Api\ApplicationController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('application')->name('.application')->group(function () {
    Route::get('',[ApplicationController::class, 'index'])->name('index');
    Route::post('',[ApplicationController::class, 'store'])->name('store');
    Route::put('{application}',[ApplicationController::class, 'change_state'])->name('change_state');
});
