<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;

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
    Route::get('/employer/jobs', [JobController::class, 'create']);
    Route::post('/employer/jobs', [JobController::class, 'store']);
    Route::delete('/employer/jobs/{job}', [JobController::class, 'destroy']);
    Route::get('/employer/jobs/{job}/applications', [JobController::class, 'applications']);
    Route::post('/applications/{id}/status', [JobController::class, 'updateStatus']);
});

Route::middleware(['auth', 'jobseeker'])->group(function () {
    Route::view('/jobseeker/dashboard', 'jobseeker.dashboard');
    Route::get('/jobs', [JobController::class, 'index']);
    Route::get('/jobs/saved', [JobController::class, 'saved']);
    Route::get('/jobs/{job}', [JobController::class, 'show']);
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store']);
    Route::get('/applications', [ApplicationController::class, 'myApplications']);
    Route::get('/applications/{id}/edit', [ApplicationController::class, 'edit']);
    Route::post('/applications/{id}/update', [ApplicationController::class, 'update']);
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy']);
    Route::post('/jobs/{id}/bookmark', [JobController::class, 'bookmark']);
    Route::delete('/jobs/{id}/unbookmark', [JobController::class, 'unbookmark']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::post('/admin/jobs/{id}/status', [AdminController::class, 'updateJobStatus']);
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser']);
    Route::delete('/admin/jobs/{id}', [AdminController::class, 'deleteJob']);
});