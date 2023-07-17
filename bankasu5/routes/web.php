<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientController as C;
use App\Http\Controllers\AccountController as A;
use App\Http\Controllers\StatisticsController as S;
use App\Http\Controllers\TransfersController as T;

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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Login/logout
Auth::routes();

// Clients
Route::prefix('clients')->name('clients-')->group(function () {

    Route::get('/', [C::class, 'index'])->name('index');
    Route::get('/create', [C::class, 'create'])->name('create');
    Route::post('/', [C::class, 'store'])->name('store');
    Route::get('/edit/{client}', [C::class, 'edit'])->name('edit');
    Route::put('/{client}', [C::class, 'update'])->name('update');
    Route::get('/delete/{client}', [C::class, 'delete'])->name('delete');
    Route::delete('/{client}', [C::class, 'destroy'])->name('destroy');
});

// Accounts
Route::prefix('accounts')->name('accounts-')->group(function () {

    Route::get('/', [A::class, 'index'])->name('index');
    Route::get('/create', [A::class, 'create'])->name('create');
    Route::post('/', [A::class, 'store'])->name('store');
    Route::get('/edit/{account}', [A::class, 'edit'])->name('edit');
    Route::put('/{account}', [A::class, 'update'])->name('update');
    Route::get('/delete/{account}', [A::class, 'delete'])->name('delete');
    Route::delete('/{account}', [A::class, 'destroy'])->name('destroy');
});

// Statistics
Route::get('/statistics', [S::class, 'index'])->name('statistics');

// Transfers
Route::get('/transfers', [T::class, 'transfer'])->name('transfers');
Route::post('/transfers', [T::class, 'execute'])->name('execute');