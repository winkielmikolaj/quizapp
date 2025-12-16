<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminQuizController;

Route::get('/', function () {
    return view('home');
});

//metoda index z controllera (GET)
Route::get('/quizzes', [QuizController::class, 'index']);


//metoda show z controllera, ktora wyswietla quiz na podstawie id w linku
Route::get('/quizzes/{id}', [QuizController::class, 'show']);


// przesylanie rozwiazania (POST)
Route::post('/quizzes/{id}', [QuizController::class, 'submit']);

//prosty middlewear
Route::middleware(['auth.basic'])->prefix('admin')->group(function () {

    //zarzadanie quizami
    Route::resource('quizzes', AdminQuizController::class);


    //lista pytan do edytowania lub usuniecia
    Route::get('quizzes/{id}/questions', [App\Http\Controllers\AdminQuestionController::class, 'index'])
        ->name('admin.quiz.questions');

    //form od dodwania pytania
    Route::get('quizzes/{id}/questions/create', [App\Http\Controllers\AdminQuestionController::class, 'create'])
        ->name('admin.quiz.questions.create');

    //nowe pytanie
    Route::post('quizzes/{id}/questions', [App\Http\Controllers\AdminQuestionController::class, 'store'])
        ->name('admin.quiz.questions.store');

    //edycja pytan
    Route::get('questions/{id}/edit', [App\Http\Controllers\AdminQuestionController::class, 'edit'])
        ->name('admin.questions.edit');

    //aktualizacja pytan
    Route::put('questions/{id}', [App\Http\Controllers\AdminQuestionController::class, 'update'])
        ->name('admin.questions.update');

    //usuwanie pytania
    Route::delete('questions/{id}', [App\Http\Controllers\AdminQuestionController::class, 'destroy'])
        ->name('admin.questions.destroy');
});
