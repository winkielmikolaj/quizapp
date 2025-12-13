<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    // 1. Lista wszystkich quizów
    public function index()
    {
        // Pobieramy quizy i od razu liczymy, ile mają pytań (withCount)
        $quizzes = Quiz::withCount('questions')->get();
        return view('admin.quizzes.index', ['quizzes' => $quizzes]);
    }

    // 2. Formularz dodawania nowego quizu
    public function create()
    {
        return view('admin.quizzes.create');
    }

    // 3. Zapisywanie nowego quizu w bazie
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        Quiz::create($data);

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz został pomyślnie dodany!');
    }

    // 4. Formularz edycji istniejącego quizu
    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', ['quiz' => $quiz]);
    }

    // 5. Aktualizacja quizu w bazie
    public function update(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        $quiz->update($data);

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz został zaktualizowany!');
    }

    // 6. Usuwanie quizu
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz został usunięty!');
    }
}
