<?php

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

    Route::middleware('role:administrator')->get('/administrator/dashboard', function () {
        return view('administrator.dashboard');
    })->name('admin.dashboard');

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
