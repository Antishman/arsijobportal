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
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard');
});

Route::middleware(['auth', 'employer'])->group(function () {
    Route::view('/employer/dashboard', 'employer.dashboard');
});

Route::middleware(['auth', 'jobseeker'])->group(function () {
    Route::view('/jobseeker/dashboard', 'jobseeker.dashboard');
});