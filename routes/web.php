<?php

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

/*
Route::get('/', function () {
    return view('index');
});

Route::get('/show', function () {
    return view('show');
});
*/

use App\Http\Controllers\AccountController;

Route::get('/', [AccountController::class, 'index'])->name('home');
Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
Route::get('/accounts/{account}', [AccountController::class, 'show'])->name('accounts.show');
Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');

