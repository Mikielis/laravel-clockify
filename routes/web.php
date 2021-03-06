<?php

use Illuminate\Support\Facades\Route;

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

// These pages can be seen only by authenticated users
Route::middleware('auth')->group(function() {
    Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('home');

    // Client
    Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients');
    Route::post('/clients/add', [App\Http\Controllers\ClientController::class, 'add'])->name('add-client');
    Route::get('/clients/edit/{id}', [App\Http\Controllers\ClientController::class, 'edit'])->name('edit-client');
    Route::post('/clients/save/{id}', [App\Http\Controllers\ClientController::class, 'save'])->name('save-client');
    Route::get('/clients/disable/{id}', [App\Http\Controllers\ClientController::class, 'disable'])->name('disable-client');

    // Project
    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('projects');
    Route::post('/projects/add', [App\Http\Controllers\ProjectController::class, 'add'])->name('add-project');
    Route::get('/projects/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('edit-project');
    Route::post('/projects/save/{id}', [App\Http\Controllers\ProjectController::class, 'save'])->name('save-project');
    Route::get('/projects/disable/{id}', [App\Http\Controllers\ProjectController::class, 'disable'])->name('disable-project');


    // Timesheet
    Route::get('/timesheet', [App\Http\Controllers\TimesheetController::class, 'index'])->name('timesheet');
    Route::post('/timesheet/add', [App\Http\Controllers\ProjectController::class, 'add'])->name('add-timesheet');
    Route::get('/timesheet/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('edit-timesheet');
    Route::post('/timesheet/save/{id}', [App\Http\Controllers\ProjectController::class, 'save'])->name('save-timesheet');
    Route::get('/timesheet/disable/{id}', [App\Http\Controllers\ProjectController::class, 'disable'])->name('disable-timesheet');

    // User activities
    Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index'])->name('userActivities');

    // Logout
    Route::get('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
});

// Login/logout pages
Route::get('/auth/google/redirect/', [App\Http\Controllers\Auth\GoogleSocialiteController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/incorrect/', [App\Http\Controllers\Auth\GoogleSocialiteController::class, 'incorrectAuth'])->name('google-incorrect-auth');
Route::get('/auth/google/callback/', [App\Http\Controllers\Auth\GoogleSocialiteController::class, 'handleCallback']);
