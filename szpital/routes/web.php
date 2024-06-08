<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicinController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TreatmentNurseController;
use App\Http\Controllers\TreatmentTypeController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


//dopisz import dla UserController
//Zawartość w pliku do controllera.txt
/*
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣠⣤⣤⣤⣤⣤⣶⣦⣤⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⣿⡿⠛⠉⠙⠛⠛⠛⠛⠻⢿⣿⣷⣤⡀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⣼⣿⠋⠀⠀⠀⠀⠀⠀⠀⢀⣀⣀⠈⢻⣿⣿⡄⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⣸⣿⡏⠀⠀⠀⣠⣶⣾⣿⣿⣿⠿⠿⠿⢿⣿⣿⣿⣄⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⣿⣿⠁⠀⠀⢰⣿⣿⣯⠁⠀⠀⠀⠀⠀⠀⠀⠈⠙⢿⣷⡄⠀
⠀⠀⣀⣤⣴⣶⣶⣿⡟⠀⠀⠀⢸⣿⣿⣿⣆⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⣷⠀
⠀⢰⣿⡟⠋⠉⣹⣿⡇⠀⠀⠀⠘⣿⣿⣿⣿⣷⣦⣤⣤⣤⣶⣶⣶⣶⣿⣿⣿⠀
⠀⢸⣿⡇⠀⠀⣿⣿⡇⠀⠀⠀⠀⠹⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠃⠀
⠀⣸⣿⡇⠀⠀⣿⣿⡇⠀⠀⠀⠀⠀⠉⠻⠿⣿⣿⣿⣿⡿⠿⠿⠛⢻⣿⡇⠀⠀
⠀⣿⣿⠁⠀⠀⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣧⠀⠀
⠀⣿⣿⠀⠀⠀⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⠀
⠀⣿⣿⠀⠀⠀⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⠀⠀
⠀⢿⣿⡆⠀⠀⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⡇⠀⠀
⠀⠸⣿⣧⡀⠀⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⣿⠃⠀⠀
⠀⠀⠛⢿⣿⣿⣿⣿⣇⠀⠀⠀⠀⠀⣰⣿⣿⣷⣶⣶⣶⣶⠶⠀⢠⣿⣿⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⣿⣿⠀⠀⠀⠀⠀⣿⣿⡇⠀⣽⣿⡏⠁⠀⠀⢸⣿⡇⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⣿⣿⠀⠀⠀⠀⠀⣿⣿⡇⠀⢹⣿⡆⠀⠀⠀⣸⣿⠇⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⢿⣿⣦⣄⣀⣠⣴⣿⣿⠁⠀⠈⠻⣿⣿⣿⣿⡿⠏⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠈⠛⠻⠿⠿⠿⠿⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/zaloguj', function () {
    return view('Logowanie');
});

// Poprawione trasy
Route::get('/lekarzeTab', [DoctorController::class, 'index'])->name('doctorIndex');
Route::post('/lekarzeTab', [DoctorController::class, 'store'])->name('doctorStore');
Route::get('/lekarzeTab/{id}/edycjaLekarza', [DoctorController::class, 'edit'])->name('doctorEdit');
Route::put('/lekarzeTab/{id}', [DoctorController::class, 'update'])->name('doctorUpdate');
Route::delete('/lekarzeTab/{id}', [DoctorController::class, 'destroy'])->name('doctorDelete');

Route::get('/pielegniarkiTab', [NurseController::class, 'index'])->name('nurseIndex');
Route::post('/nurses', [NurseController::class, 'store'])->name('nursesStore');
Route::get('/nurses/{id}', [NurseController::class, 'show'])->name('nursesShow');
Route::put('/nurses/{id}', [NurseController::class, 'update'])->name('nursesUpdate');
Route::delete('/nurses/{id}', [NurseController::class, 'destroy'])->name('nursesDestroy');

Route::get('/pacjenciTab', [PatientController::class, 'index'])->name('patientIndex');
Route::post('/patients', [PatientController::class, 'store'])->name('patientsStore');
Route::get('/patients/{id}', [PatientController::class, 'show'])->name('patientsShow');
Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patientsUpdate');
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patientsDestroy');


Route::get('/lekiTab', [MedicinController::class, 'index'])->name('medicinIndex');
Route::post('/lekiTab', [MedicinController::class, 'store'])->name('medicinStore');
Route::get('/lekiTab/{id}/edycjaLeku', [MedicinController::class, 'edit'])->name('medicinEdit');
Route::put('/lekiTab/{id}', [MedicinController::class, 'update'])->name('medicinUpdate');
Route::delete('/lekiTab/{id}', [MedicinController::class, 'destroy'])->name('medicinDelete');

Route::get('/saleTab', [RoomController::class, 'index'])->name('roomIndex');
Route::get('/rooms/{id}', [RoomController::class, 'edit'])->name('roomsShow');
Route::post('/rooms', [RoomController::class, 'store'])->name('roomsStore');
Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('roomsUpdate');
Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('roomsDestroy');

Route::get('/procedures', [ProcedureController::class, 'index'])->name('proceduresIndex');
Route::get('/procedures/{id}/edit', [ProcedureController::class, 'show'])->name('proceduresShow');
Route::post('/procedures', [ProcedureController::class, 'store'])->name('proceduresStore');
Route::put('/procedures/{id}', [ProcedureController::class, 'update'])->name('proceduresUpdate');
Route::delete('/procedures/{id}', [ProcedureController::class, 'destroy'])->name('proceduresDestroy');

Route::get('/admin', [AdminController::class, 'showAdminPanel'])->name('admin');

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
Route::get('/nurse/dashboard', [NurseController::class, 'dashboard'])->name('nurse.dashboard');
Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');

Route::get('/treatment-types', [TreatmentTypeController::class, 'index'])->name('treatmentTypes.index');
Route::post('/treatment-types', [TreatmentTypeController::class, 'store'])->name('treatmentTypes.store');
Route::get('/treatment-types/{id}/edit', [TreatmentTypeController::class, 'edit'])->name('treatmentTypes.edit');
Route::put('/treatment-types/{id}', [TreatmentTypeController::class, 'update'])->name('treatmentTypes.update');
Route::delete('/treatment-types/{id}', [TreatmentTypeController::class, 'destroy'])->name('treatmentTypes.destroy');

Route::get('/treatment-nurses', [TreatmentNurseController::class, 'index'])->name('admin');
Route::post('/treatment-nurses', [TreatmentNurseController::class, 'store'])->name('treatmentNurses.store');
Route::get('/treatment-nurses/{id}/edit', [TreatmentNurseController::class, 'edit'])->name('treatmentNurses.edit');
Route::put('/treatment-nurses/{nurse_id}', [TreatmentNurseController::class, 'update'])->name('treatmentNurses.update');
Route::delete('/treatment-nurses/{nurse_id}', [TreatmentNurseController::class, 'destroy'])->name('treatmentNurses.destroy');
