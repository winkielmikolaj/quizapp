<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;

class QuizController extends Controller
{
    public function index()
    {
        //pobiera quizy z bazy
        $quizzes = Quiz::all();

        return view('quizzes', ['quizzes' => $quizzes]);
    }

    //wyswietla jeden quiz na podstawie id
    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);

        $history = Result::where('quiz_id', $id)->latest()->take(5)->get();

        return view('quiz', ['quiz' => $quiz, 'history' => $history]);
    }

    //przesyla odpowiedzi do bazy danych
    public function submit(Request $request, $id)
    {
        //walidacja podstawowych danych
        $data = $request->validate([
            'answers'   => 'required|array',
            'answers.*' => 'required|numeric',
        ], [
            'answers.*.required' => 'To pole jest wymagane.',
            'answers.*.numeric'  => 'Musisz wpisać liczbę (nie tekst).',
        ]);

        $quiz = Quiz::with('questions')->findOrFail($id);

        $score = 0;
        $total = $quiz->questions->count();

        foreach ($quiz->questions as $question) {

            $userAnswer = (int) ($data['answers'][$question->id] ?? 0);

            //sprawdzenie odpowiedzi
            if ($userAnswer === $question->answer) {
                $score++;
            }
        }

        //zapis do bazy
        Result::create([
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total_questions' => $total,
        ]);

        $message = "Twój wynik ($score / $total) został zapisany w bazie!";

        if ($score === $total) {
            $message .= " Brawo! Wszystko dobrze!";
        } else {
            $message .= " Spróbuj jeszcze raz, żeby poprawić wynik.";
        }

        return back()->with('success', $message);
    }
}
