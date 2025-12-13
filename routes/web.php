<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return view('home');
});

//metoda index z controllera
Route::get('/quizzes', [QuizController::class, 'index']);


//metoda show z controllera, ktora wyswietla quiz na podstawie id w linku
Route::get('/quizzes/{id}', [QuizController::class, 'show']);
