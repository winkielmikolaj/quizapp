@extends('layouts.app')

@section('title', 'Dodaj Pytanie')

@section('content')
    <h1>Dodaj Pytanie do: {{ $quiz->title }}</h1>

    <form action="{{ route('admin.quiz.questions.store', $quiz->id) }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Treść pytania:</label><br>
            <input type="text" name="content" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Poprawna odpowiedź (liczba):</label><br>
            <input type="number" name="answer" required style="width: 100px; padding: 8px;">
        </div>

        <button type="submit" style="background: blue; color: white; padding: 10px 20px; border: none;">Zapisz</button>
        <a href="{{ route('admin.quiz.questions', $quiz->id) }}" style="margin-left: 10px;">Anuluj</a>
    </form>
@endsection
