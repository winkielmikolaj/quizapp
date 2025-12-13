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


// przesylanie rozwiazania (POST)
Route::post('/quizzes/{id}', [QuizController::class, 'submit']);


use App\Http\Controllers\AdminQuizController; // <--- Pamiętaj o imporcie!

// Grupa tras dla Administratora
// prefix('admin') -> wszystkie adresy będą zaczynać się od /admin/...
// middleware('auth.basic') -> wymaga logowania (email: admin@test.com, hasło: password)
Route::middleware(['auth.basic'])->prefix('admin')->group(function () {

    // Automatyczne trasy dla CRUD (index, create, store, edit, update, destroy)
    Route::resource('quizzes', AdminQuizController::class);

    // Tutaj później dodamy trasy dla pytań...
});
