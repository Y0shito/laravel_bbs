<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('index', [IndexController::class, 'index'])->name('index');

// Twitterログイン
Route::get('twitter-login', [UserController::class, 'login'])->name('twitter-login');
Route::get('callback', [UserController::class, 'callback']);
Route::get('twitter-logout', [UserController::class, 'logout'])->name('twitter-logout');
