<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::middleware('role:administrator')->prefix('administrator')->group(function () {
        Route::get('/dashboard', [SystemController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/staff', [StaffController::class, 'index'])->name('admin.staff.index');
        Route::post('/staff', [StaffController::class, 'store'])->name('admin.staff.store');
        Route::put('/staff/{staff}', [StaffController::class, 'update'])->name('admin.staff.update');
        Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('admin.staff.destroy');

        Route::get('/doctors', [DoctorController::class, 'index'])->name('admin.doctors.index');
        Route::post('/doctors', [DoctorController::class, 'store'])->name('admin.doctors.store');
        Route::put('/doctors/{doctor}', [DoctorController::class, 'update'])->name('admin.doctors.update');
        Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');

        Route::get('/medicines', [MedicineController::class, 'index'])->name('admin.medicines.index');
        Route::post('/medicines', [MedicineController::class, 'store'])->name('admin.medicines.store');
        Route::put('/medicines/{medicine}', [MedicineController::class, 'update'])->name('admin.medicines.update');
        Route::delete('/medicines/{medicine}', [MedicineController::class, 'destroy'])->name('admin.medicines.destroy');

        Route::get('/fees', [SystemController::class, 'fees'])->name('admin.fees.index');
        Route::post('/fees', [SystemController::class, 'updateFee'])->name('admin.fees.update');
        Route::get('/audit', [SystemController::class, 'audit'])->name('admin.audit.index');
    });

    Route::middleware('role:receptionist')->get('/receptionist/dashboard', function () {
        return view('receptionist.dashboard');
    })->name('receptionist.dashboard');

    Route::middleware('role:attendant')->get('/attendant/dashboard', function () {
        return view('attendant.dashboard');
    })->name('attendant.dashboard');

    Route::middleware('role:doctor')->get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');

    Route::middleware('role:accountant')->get('/accountant/dashboard', function () {
        return view('accountant.dashboard');
    })->name('accountant.dashboard');
});
