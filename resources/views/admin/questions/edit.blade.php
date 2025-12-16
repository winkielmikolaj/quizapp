@extends('layouts.app')

@section('title', 'Edytuj Pytanie')

@section('content')
    <h1>Edytuj Pytanie</h1>

    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT') <div style="margin-bottom: 15px;">
            <label>Treść pytania:</label><br>
            <input type="text" name="content"
                   value="{{ $question->content }}"
                   required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Poprawna odpowiedź (liczba):</label><br>
            <input type="number" name="answer"
                   value="{{ $question->answer }}"
                   required style="width: 100px; padding: 8px;">
        </div>

        <button type="submit" style="background: orange; color: white; padding: 10px 20px; border: none;">Zaktualizuj</button>
        <a href="{{ route('admin.quiz.questions', $question->quiz_id) }}" style="margin-left: 10px;">Anuluj</a>
    </form>
@endsection
