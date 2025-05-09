<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminAnnouncementController;

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
    Route::get('/employer/dashboard', [JobController::class, 'employerDashboard']);
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
    Route::get('/resume/create', [ResumeController::class, 'create']);
    Route::post('/resume', [ResumeController::class, 'store']);
    Route::get('/resume/preview', [ResumeController::class, 'preview']);
    Route::get('/jobseeker/dashboard', [JobController::class, 'jobseekerDashboard'])->name('jobseeker.dashboard');
    Route::get('/jobseeker/profile/edit', [ProfileController::class, 'edit'])->name('jobseeker.profile.edit');
    Route::post('/jobseeker/profile/update', [ProfileController::class, 'update'])->name('jobseeker.profile.update');

});
Route::post('/notifications/read-all', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::post('/admin/jobs/{id}/status', [AdminController::class, 'updateJobStatus']);
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser']);
    Route::delete('/admin/jobs/{id}', [AdminController::class, 'deleteJob']);
    Route::get('/announcements', [AdminAnnouncementController::class, 'index'])->name('admin.announcements.index');
    Route::get('/announcements/create', [AdminAnnouncementController::class, 'create'])->name('admin.announcements.create');
    Route::post('/announcements', [AdminAnnouncementController::class, 'store'])->name('admin.announcements.store');
    Route::delete('/announcements/{id}', [AdminAnnouncementController::class, 'destroy'])->name('admin.announcements.destroy');;
});


Route::middleware(['auth', 'admin'])->prefix('admin/tags')->name('admin.tags.')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('index');
    Route::get('/create', [TagController::class, 'create'])->name('create');
    Route::post('/', [TagController::class, 'store'])->name('store');
    Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('edit');
    Route::put('/{tag}', [TagController::class, 'update'])->name('update');
    Route::delete('/{tag}', [TagController::class, 'destroy'])->name('destroy');
});

Route::get('/employer/jobseekers', [JobController::class, 'viewJobseekers'])
    ->middleware(['auth', 'employer']);
