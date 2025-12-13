<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    // stored info
    private $quizzes = [
        1 => [
            'id' => 1,
            'title' => 'Matematyka: Dodawanie',
            'questions' => [
                'Ile to jest 2 + 2?',
                'Ile to jest 15 + 25?',
                'Jaki jest wynik 100 + 0?'
            ]
        ],
        2 => [
            'id' => 2,
            'title' => 'Matematyka: Mnożenie',
            'questions' => [
                'Ile to jest 3 * 3?',
                'Ile to jest 7 * 8?',
                'Jaki jest wynik 10 * 10?'
            ]
        ]
    ];

    // lista quizow
    public function index()
    {
        return view('quizzes', ['quizzes' => $this->quizzes]);
    }

    // wyswietla jeden quiz
    public function show($id)
    {
        // czy quiz istnieje
        if (!isset($this->quizzes[$id])) {
            abort(404);
        }

        $quiz = $this->quizzes[$id];

        return view('quiz', ['quiz' => $quiz]);
    }
}
