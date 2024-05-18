<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicinController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/zaloguj', function () {
    return view('Logowanie');
});

Route::get('/lekarzeTab', [DoctorController::class, 'index'])->name('doctorIndex');

Route::get('/pielegniarkiTab', [NurseController::class, 'index'])->name('nurseIndex');

Route::get('/pacjenciTab', [PatientController::class, 'index'])->name('patientIndex');

Route::get('/lekiTab', [MedicinController::class, 'index'])->name('medicinIndex');

Route::get('/saleTab', [RoomController::class, 'index'])->name('roomIndex');

Route::get('/pacjenciTab', function () {
    return view('pacjenciTab');
})->name('pacjenciTab');

Route::get('/saleTab', function () {
    return view('saleTab');
})->name('saleTab');

Route::get('/admin', function() {
    return view('admin');
})->name('admin');



