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

    // 1. Zarządzanie Quizami (cały CRUD)
    Route::resource('quizzes', AdminQuizController::class);

    // 2. Zarządzanie Pytaniami

    // Lista pytań danego quizu
    Route::get('quizzes/{id}/questions', [App\Http\Controllers\AdminQuestionController::class, 'index'])
        ->name('admin.quiz.questions');

    // Formularz dodawania pytania
    Route::get('quizzes/{id}/questions/create', [App\Http\Controllers\AdminQuestionController::class, 'create'])
        ->name('admin.quiz.questions.create');

    // Zapisywanie nowego pytania
    Route::post('quizzes/{id}/questions', [App\Http\Controllers\AdminQuestionController::class, 'store'])
        ->name('admin.quiz.questions.store');

    // Formularz edycji pytania (TO MOGŁO CI BRAKOWAĆ)
    Route::get('questions/{id}/edit', [App\Http\Controllers\AdminQuestionController::class, 'edit'])
        ->name('admin.questions.edit');

    // Aktualizacja pytania (TO MOGŁO CI BRAKOWAĆ)
    Route::put('questions/{id}', [App\Http\Controllers\AdminQuestionController::class, 'update'])
        ->name('admin.questions.update');

    // Usuwanie pytania
    Route::delete('questions/{id}', [App\Http\Controllers\AdminQuestionController::class, 'destroy'])
        ->name('admin.questions.destroy');
});
