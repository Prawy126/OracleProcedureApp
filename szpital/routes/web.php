<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/zaloguj', function () {
    return view('Logowanie');
});

Route::get('/admin', function() {
    return view('admin');
}); //admin autoryzacja

Route::get('/lekiTab', function() {
    return view('lekiTab');
}); //admin autoryzacja

