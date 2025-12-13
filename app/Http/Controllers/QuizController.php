<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    // Lista quizów
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes', ['quizzes' => $quizzes]);
    }

    // Pojedynczy quiz
    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('quiz', ['quiz' => $quiz]);
    }

    // Obsługa formularza (Walidacja)
    public function submit(Request $request, $id)
    {
        // 1. Walidacja (tak jak wcześniej)
        $data = $request->validate([
            // Pierwsza tablica: reguły
            'answers'   => 'required|array',
            'answers.*' => 'required|numeric',
        ], [
            // Druga tablica: Twoje tłumaczenia (To tutaj naprawiamy ten komunikat!)
            'answers.*.required' => 'To pole jest wymagane.',
            'answers.*.numeric'  => 'Musisz wpisać liczbę (nie tekst).',
        ]);

        // 2. Pobieramy quiz z pytaniami z bazy
        $quiz = Quiz::with('questions')->findOrFail($id);

        $score = 0; // Licznik punktów
        $total = $quiz->questions->count(); // Liczba pytań

        // 3. Pętla sprawdzająca odpowiedzi
        foreach ($quiz->questions as $question) {
            // Pobieramy odpowiedź użytkownika dla danego pytania
            // (int) wymusza traktowanie wpisu jako liczby (np. "4" staje się 4)
            $userAnswer = (int) $data['answers'][$question->id];

            // Porównujemy z poprawną odpowiedzią z bazy
            if ($userAnswer === $question->answer) {
                $score++; // Punkt w górę!
            }
        }

        // 4. Budujemy komunikat
        $message = "Twój wynik to: $score / $total punktów.";

        if ($score === $total) {
            $message .= " Brawo! Wszystko dobrze!";
        } else {
            $message .= " Spróbuj jeszcze raz, żeby poprawić wynik.";
        }

        // 5. Zwracamy wynik
        return back()->with('success', $message);
    }
}
