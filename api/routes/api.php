<?php

use App\Http\Controllers\Auth\PatientLoginController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\DoctorLoginController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route to handle unauthorized access
Route::get('/login', function() {
    return response()->json(['message' => 'Please login to access the protected routes'], 401);
})->name('login');

// Admin routes
Route::post('/admin/login', [AdminLoginController::class, 'admin_login'])->name('admin.login');
Route::post('/admin/signup', [AdminLoginController::class, 'admin_signup'])->defaults('guard', 'admin');

Route::middleware(['auth:sanctum', 'auth.guard:admin'])->group(function () {
    Route::post('/admin/logout', [AdminLoginController::class, 'admin_logout'])->name('admin.logout');

    // Patient for admin
    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/patients/{id}', [PatientController::class, 'show']);
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

    Route::post('/patients_info', [PatientController::class, 'patient_info_create']);
    Route::get('/patients_info', [PatientController::class, 'patient_info_index']);
    Route::get('/patients_info/{id}', [PatientController::class, 'patient_info_show']);
    Route::put('/patients_info/{id}', [PatientController::class, 'patient_info_update']);
    Route::delete('/patients_info/{id}', [PatientController::class, 'patient_info_destroy']);

    // Doctor for admin
    Route::get('/doctors', [DoctorController::class, 'index']);
    Route::get('/doctors/{id}', [DoctorController::class, 'show']);
    Route::put('/doctors/{id}', [DoctorController::class, 'update']);
    Route::delete('/doctors/{id}', [DoctorController::class, 'destroy']);

    Route::post('/doctor_info', [DoctorController::class, 'doctor_info_create']);
    Route::get('/doctor_info', [DoctorController::class, 'doctor_info_index']);
    Route::get('/doctor_info/{id}', [DoctorController::class, 'doctor_info_show']);
    Route::put('/doctor_info/{id}', [DoctorController::class, 'doctor_info_update']);
    Route::delete('/doctor_info/{id}', [DoctorController::class, 'doctor_info_destroy']);

    // Appointment for admin
    Route::post('/appointments', [AppointmentController::class, 'appointment_create']);
    Route::get('/appointments', [AppointmentController::class, 'appointment_index']);
    Route::get('/appointments/{id}', [AppointmentController::class, 'appointment_show']);
    Route::put('/appointments/{id}', [AppointmentController::class, 'appointment_update']);
    Route::delete('/appointments/{id}', [AppointmentController::class, 'appointment_destroy']);
});

// Patient routes
Route::post('/patient/login', [PatientLoginController::class, 'patient_login'])->defaults('guard', 'patient')->name('patient.login');
Route::post('/patient/signup', [PatientLoginController::class, 'patient_signup'])->defaults('guard', 'patient');

Route::middleware(['auth:sanctum', 'auth.guard:patient'])->group(function () {
    Route::post('/patient/logout', [PatientLoginController::class, 'patient_logout'])->name('patient.logout');

    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

    Route::get('/patients_info/{id}', [PatientController::class, 'patient_info_show']);

    // Doctor for patient
    Route::get('/doctor_info', [DoctorController::class, 'doctor_info_index']);
    Route::get('/doctor_info/{id}', [DoctorController::class, 'doctor_info_show']);
});

// Doctor routes
Route::post('/doctor/login', [DoctorLoginController::class, 'doctor_login'])->defaults('guard', 'doctor')->name('doctor.login');
Route::post('/doctor/createDoctor', [DoctorLoginController::class, 'createDoctor'])->defaults('guard', 'doctor');

Route::middleware(['auth:sanctum', 'auth.guard:doctor'])->group(function () {
    Route::post('/doctor/logout', [DoctorLoginController::class, 'doctor_logout'])->name('doctor.logout');

    Route::put('/doctors/{id}', [DoctorController::class, 'update']);
    Route::delete('/doctors/{id}', [DoctorController::class, 'destroy']);

    Route::get('/doctor_info', [DoctorController::class, 'doctor_info_index']);
    Route::get('/doctor_info/{id}', [DoctorController::class, 'doctor_info_show']);
    Route::put('/doctor_info/{id}', [DoctorController::class, 'doctor_info_update']);
    
    // Patient for doctor
    Route::get('/patients/{id}', [PatientController::class, 'show']);

    Route::post('/patients_info', [PatientController::class, 'patient_info_create']);
    Route::get('/patients_info', [PatientController::class, 'patient_info_index']);
    Route::get('/patients_info/{id}', [PatientController::class, 'patient_info_show']);
    Route::put('/patients_info/{id}', [PatientController::class, 'patient_info_update']);
});

