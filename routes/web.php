<?php

use App\Http\Controllers\admin\ApplicationController;
use App\Http\Controllers\admin\PortfolioController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function (){
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/',[ApplicationController::class, "index"])->name('index');
        Route::put('{application}',[ApplicationController::class, "change_state"])->name('change_state');
        Route::get('show_done_app',[ApplicationController::class, "show_done_app"])->name('show_done_app');
    });
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware('guest')->group(function (){
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});
