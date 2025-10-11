<?php

use App\Livewire\MediAi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediAiController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ConsultationController;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/sign-in', [UserController::class, 'signIn'])->name('sign.in');

    Route::get('/forgotpassword', [UserController::class, 'showForgotPassword'])->name('show-forgot-password');
    Route::post('/forgotpassword', [UserController::class, 'forgotPassword'])->name('forgot-password');

    Route::get('/verifyemail', [UserController::class, 'showVerifyEmail'])->name('show-verify-email');
    Route::post('/verifyemail', [UserController::class, 'verifyEmail'])->name('verify-email');

    Route::get('/newpassword', [UserController::class, 'showNewPassword'])->name('show-new-password');
    Route::post('/newpassword', [UserController::class, 'newPassword'])->name('new-password');

    Route::post('/resend-otp', [UserController::class, 'resendOtp'])->name('resend-otp');
});

Route::get('/', function () {
    return auth()->check()
        ? view('dashboard')
        : view('login');
})->name('welcome');



Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/patientRecord', [PatientController::class, 'showPatientRecordPage'])->name('patientRecord');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroyPatient'])->name('patients.destroy');



    // for search
    Route::get('/patients/search', [PatientController::class, 'search'])->name('patients.search');


    //add patient
    Route::post('/patients', [PatientController::class, 'createPatient'])->name('patients.store');
    Route::put('/patients/{patient}', [PatientController::class, 'updatePatientInfo'])->name('patients.update');

    //Ai
    Route::get('/ai-support', [MediAiController::class, 'showMediAiPage'])->name('ai-support');
    Route::post('/ai-support', [MediAiController::class, 'generate'])->name('generate');

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'showDashboardPage'])->name('dashboard');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/inventory', [InventoryController::class, 'showInventoryPage'])->name('inventory');
    Route::delete('/inventory/{medicine}', [InventoryController::class, 'destroyMedicine'])->name('medicine.destroy');

    // Create medicine
    Route::post('/medicines', [InventoryController::class, 'store'])->name('medicines.store');

    // Update medicine
    Route::put('/medicines/{id}', [InventoryController::class, 'update'])->name('medicines.update');



    Route::get('/patientRecord/patientInfo/{patient}', [PatientController::class, 'showPatientInfo'])
        ->name('patientInfo');

    Route::post('/patients/{patient}/consultations', [ConsultationController::class, 'store'])
        ->name('consultations.store');

    Route::get('/medicines/search', [InventoryController::class, 'search'])->name('medicines.search');

    Route::post('/password/update', [UserController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});
