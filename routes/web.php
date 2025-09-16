<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/sign-in', [UserController::class, 'signIn'])->name('sign.in');
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
    Route::get('/patientRecord/patientInfo/{patient}', [PatientController::class, 'showPatientInfo'])
        ->name('patientInfo');




    Route::get('/ai-support', function () {
        return view('ai-support');
    })->name('ai-support');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('/inventory', function () {
        return view('inventory');
    })->name('inventory');
});
