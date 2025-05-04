<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;



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
    return view('landing');
});

Route::get('/registro', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.submit');

Route::get('/inicio-sesion',[LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class, 'loginUser'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'destroy'])->middleware('auth')->name('logout');