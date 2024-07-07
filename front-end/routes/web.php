<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PageController;
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

// Routes that require authentication for both patients and doctors
Route::middleware(['auth:patient,doctor'])->group(function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

});


// Routes that require authentication for patients only
Route::middleware(['auth:patient'])->group(function () {
    Route::get('/appointments', [PageController::class, 'index'])->name('appointment.index');
    Route::get('/appointment/{id}', [PageController::class, 'show'])->name('appointment.show');
    Route::delete('/appointment/{id}/cancel', [PageController::class, 'cancel'])->name('appointment.cancel');
    Route::get('/appointment/{id}/edit', [PageController::class, 'edit'])->name('appointment.edit');
    Route::put('/appointment/{id}', [PageController::class, 'update'])->name('appointment.update');

    Route::post('/review_post', [FormController::class, 'review_post'])->name('review_post');
});

// Routes that require authentication for doctors only
Route::middleware(['auth:doctor'])->group(function () {
    Route::get('/doctor/appointments', [DoctorController::class, 'appointments'])->name('doctor.appointments');
    Route::get('/doctor/appointment/{id}', [DoctorController::class, 'appointment'])->name('doctor.appointment');
    Route::delete('/doctor/appointment/{id}/cancel', [DoctorController::class, 'cancel'])->name('doctor.appointment.cancel');
});

// Public routes accessible without authentication
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/home', [PageController::class, 'home']);

Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor.index');
Route::get('/doctor/{id}', [DoctorController::class, 'show'])->name('doctor.show');

Route::get('/booking-form', [PageController::class, 'booking_form']);
Route::get('/about', [PageController::class, 'about']);

Route::get('/testiminal', [PageController::class, 'testiminal'])->name('testiminal');

Route::get('/signup', [PageController::class, 'signup'])->name('signup');
Route::post('/signup', [LoginRegisterController::class, 'signup'])->name('signup.process');

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [LoginRegisterController::class, 'login'])->name('login.process');

Route::post('/appointment_post', [FormController::class, 'appointment_post'])->name('appointment_post');
Route::get('/appointment_confirm/{appointment_id}', [PageController::class, 'appointment_confirm'])->name('appointment_confirm');
Route::get('/review', [PageController::class, 'review'])->name('review');