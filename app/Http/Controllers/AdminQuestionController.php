<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    // 1. Pokaż wszystkie pytania konkretnego quizu
    public function index($quiz_id)
    {
        // Pobieramy quiz na podstawie ID
        $quiz = Quiz::findOrFail($quiz_id);

        // WAŻNE: Wskazujemy na widok w folderze 'questions', a nie 'quizzes'
        // Przekazujemy zmienną $quiz (pojedynczą), bo widok tego oczekuje
        return view('admin.questions.index', ['quiz' => $quiz]);
    }

    // 2. Pokaż formularz dodawania pytania
    public function create($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        // Formularz dodawania pytania (w folderze questions)
        return view('admin.questions.create', ['quiz' => $quiz]);
    }

    // 3. Zapisz nowe pytanie
    public function store(Request $request, $quiz_id)
    {
        // Walidacja danych i przypisanie do zmiennej $data
        $data = $request->validate([
            'content' => 'required',        // Treść pytania
            'answer'  => 'required|integer' // Odpowiedź musi być liczbą
        ]);

        $quiz = Quiz::findOrFail($quiz_id);

        // Tworzymy pytanie przypisane do tego quizu
        $quiz->questions()->create($data);

        // Przekierowanie z powrotem do listy pytań TEGO quizu
        return redirect()->route('admin.quiz.questions', $quiz->id)
            ->with('success', 'Pytanie dodane pomyślnie!');
    }

    // 4. Pokaż formularz edycji
    public function edit($id)
    {
        // Znajdujemy konkretne pytanie
        $question = Question::findOrFail($id);

        // Widok edycji (w folderze questions)
        return view('admin.questions.edit', ['question' => $question]);
    }

    // 5. Zapisz zmiany w pytaniu
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $data = $request->validate([
            'content' => 'required',
            'answer'  => 'required|integer'
        ]);

        // Aktualizujemy dane pytania
        $question->update($data);

        // Wracamy do listy pytań quizu, do którego należy to pytanie
        return redirect()->route('admin.quiz.questions', $question->quiz_id)
            ->with('success', 'Pytanie zaktualizowane!');
    }

    // 6. Usuń pytanie
    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        // Zapamiętujemy ID quizu, żeby wiedzieć gdzie wrócić po usunięciu
        $quiz_id = $question->quiz_id;

        $question->delete();

        return redirect()->route('admin.quiz.questions', $quiz_id)
            ->with('success', 'Pytanie usunięte!');
    }
}
