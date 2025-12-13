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
        // 1. Walidacja danych
        $data = $request->validate([
            'answers'   => 'required|array',
            // Dodaliśmy '|numeric' - teraz Laravel przepuści tylko liczby
            'answers.*' => 'required|numeric',
        ], [
            // Nasze komunikaty błędów
            'answers.*.required' => 'To pole nie może być puste! Wpisz wynik.',
            'answers.*.numeric'  => 'Musisz wpisać liczbę (np. 10). Tekst jest niedozwolony.',
        ]);

        // 2. Tutaj w przyszłości dodamy sprawdzanie poprawności...

        // 3. Powrót z sukcesem
        return back()->with('success', 'Dziękujemy! Twoje odpowiedzi (liczbowe) zostały wysłane.');
    }
}
