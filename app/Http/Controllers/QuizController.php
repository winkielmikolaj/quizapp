<?php

namespace App\Http\Controllers;

use App\Models\Quiz; //import modelu z quizami

class QuizController extends Controller
{
    public function index()
    {
        // pobieranie quizow do widoku
        $quizzes = Quiz::all();

        return view('quizzes', ['quizzes' => $quizzes]);
    }

    // wyswietlanie quizu po id quizu
    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);

        return view('quiz', ['quiz' => $quiz]);
    }
}
