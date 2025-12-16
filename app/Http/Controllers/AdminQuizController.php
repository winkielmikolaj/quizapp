<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    public function index()
    {
        //pobieranie quizow i pobiera ile ma pytan (withCount)
        $quizzes = Quiz::withCount('questions')->get();
        return view('admin.quizzes.index', ['quizzes' => $quizzes]);
    }

    //formularz dodwania nowego quizu
    public function create()
    {
        return view('admin.quizzes.create');
    }

    //zapisywanie nowego quizu w bazie danych
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        //eloquent tworzy nowy rekord w tabeli quizzes
        Quiz::create($data);

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz został pomyślnie dodany!');
    }

    //edycja quizu
    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', ['quiz' => $quiz]);
    }

    public function update(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        $quiz->update($data);

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz został zaktualizowany!');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz został usunięty!');
    }
}
