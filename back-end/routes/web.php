<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;

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
    return view('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [PageController::class, 'home']);

    Route::get('/doctor', [PageController::class, 'doctor']);
    
    Route::get('/add-doctor', [PageController::class, 'addDoctor']);
    
    Route::get('/update-doctor', [PageController::class, 'updateDoctor']);
    
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/{id}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/patients/add-info/{id}', [PatientController::class, 'addInfo'])->name('patients.add-info');
    Route::post('/patients/add-info/{id}', [PatientController::class, 'storeInfo'])->name('patients.store-info');
    Route::get('/patients/{id}/edit-info', [PatientController::class, 'editInfo'])->name('patients.edit-info');
    Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');

    Route::post('/doctor/store', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctor.index');
    Route::get('/doctor/{id}', [DoctorController::class, 'show'])->name('doctor.show');
    Route::get('/update-doctor/{id}', [DoctorController::class, 'edit'])->name('doctor.edit');
    Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::delete('/doctor/{id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');

    
    Route::get('/appointment', [PageController::class, 'appointment'])->name('appointments.index');
    
    Route::get('/profile/{id}', [PageController::class, 'profile'])->name('profile.show');
    Route::post('/profile/{id}', [PageController::class, 'update'])->name('profile.update');  
    Route::delete('/profile/{id}', [PageController::class, 'destroy'])->name('profile.destroy'); 

    Route::get('/add-admin', [PageController::class, 'addAdmin']);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/signup', [PageController::class, 'signup'])->name('signup');
    Route::post('/signup', [LoginController::class, 'signup'])->name('signup');
   
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
