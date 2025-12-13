<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result; // Ważne: import modelu wyników

class QuizController extends Controller
{
    // Metoda wyświetlająca listę quizów
    public function index()
    {
        // Pobieramy wszystkie quizy z bazy
        $quizzes = Quiz::all();

        return view('quizzes', ['quizzes' => $quizzes]);
    }

    // Metoda wyświetlająca jeden konkretny quiz i jego pytania
    public function show($id)
    {
        // Znajdź quiz o danym ID razem z pytaniami, lub zwróć błąd 404
        $quiz = Quiz::with('questions')->findOrFail($id);

        $history = Result::where('quiz_id', $id)->latest()->take(5)->get();

        return view('quiz', ['quiz' => $quiz, 'history' => $history]);
    }

    // Metoda obsługująca przesłanie formularza z odpowiedziami
    public function submit(Request $request, $id)
    {
        // 1. Walidacja danych wejściowych
        $data = $request->validate([
            'answers'   => 'required|array',     // Musi być tablicą
            'answers.*' => 'required|numeric',   // Każda odpowiedź musi być liczbą
        ], [
            // Niestandardowe komunikaty błędów
            'answers.*.required' => 'To pole jest wymagane.',
            'answers.*.numeric'  => 'Musisz wpisać liczbę (nie tekst).',
        ]);

        // 2. Pobieramy quiz i pytania z bazy, aby sprawdzić poprawność
        $quiz = Quiz::with('questions')->findOrFail($id);

        $score = 0; // Licznik punktów użytkownika
        $total = $quiz->questions->count(); // Maksymalna liczba punktów do zdobycia

        // Pętla sprawdzająca każdą odpowiedź
        foreach ($quiz->questions as $question) {
            // Pobieramy odpowiedź użytkownika (jeśli brak, przyjmujemy 0)
            // Rzutowanie na (int) usuwa ewentualne problemy z typami
            $userAnswer = (int) ($data['answers'][$question->id] ?? 0);

            // Porównujemy z poprawną odpowiedzią z bazy
            if ($userAnswer === $question->answer) {
                $score++;
            }
        }

        // 3. Zapisujemy wynik do bazy danych
        Result::create([
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total_questions' => $total,
        ]);

        // 4. Przygotowujemy komunikat dla użytkownika
        $message = "Twój wynik ($score / $total) został zapisany w bazie!";

        if ($score === $total) {
            $message .= " Brawo! Wszystko dobrze!";
        } else {
            $message .= " Spróbuj jeszcze raz, żeby poprawić wynik.";
        }

        // 5. Przekierowujemy z powrotem z komunikatem sukcesu
        return back()->with('success', $message);
    }
}
