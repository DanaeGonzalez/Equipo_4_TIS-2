<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



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

Route::post('/register', [AuthController::class, 'registerUser'])->name('register.user');
Route::get('/formulario-registro', [AuthController::class, 'showRegisterForm'])->name('register');

Route::get('/', [AuthController::class, 'index'])->name('home');
Route::post('/custom-login', [AuthController::class, 'login'])->name('custom-login');
Route::get('/logados', [AuthController::class, 'logados'])->name('logados');