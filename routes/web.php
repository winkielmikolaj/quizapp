<?php

use Illuminate\Support\Facades\Route;

// Strona główna
Route::get('/', function () {
    return view('home');
});

// Lista quizów
Route::get('/quizzes', function () {
    return view('quizzes');
});
