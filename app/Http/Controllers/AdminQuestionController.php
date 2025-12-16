<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    //pobiera i wyswietla wszystkie pytania
    public function index($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        return view('admin.questions.index', ['quiz' => $quiz]);
    }

    //form dodawania pytania
    public function create($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        return view('admin.questions.create', ['quiz' => $quiz]);
    }

    //zapisywanie nowego pytania
    public function store(Request $request, $quiz_id)
    {
        $data = $request->validate([
            'content' => 'required',
            'answer'  => 'required|integer'
        ]);

        $quiz = Quiz::findOrFail($quiz_id);

        $quiz->questions()->create($data);

        return redirect()->route('admin.quiz.questions', $quiz->id)
            ->with('success', 'Pytanie dodane pomyślnie!');
    }

    // 4.wyswietla formularz edycji
    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('admin.questions.edit', ['question' => $question]);
    }

    // 5.zapisywanie zmian w pytniu
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $data = $request->validate([
            'content' => 'required',
            'answer'  => 'required|integer'
        ]);

        $question->update($data);

        return redirect()->route('admin.quiz.questions', $question->quiz_id)
            ->with('success', 'Pytanie zaktualizowane!');
    }

    // 6.usuwanie pytania
    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        //zapisanie id quizu, zeby wiedziec gdzie wrocic po usunieciu pytania
        $quiz_id = $question->quiz_id;

        $question->delete();

        return redirect()->route('admin.quiz.questions', $quiz_id)
            ->with('success', 'Pytanie usunięte!');
    }
}
