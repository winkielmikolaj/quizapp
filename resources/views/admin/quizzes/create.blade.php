@extends('layouts.app')

@section('title', 'Dodaj Quiz')

@section('content')
    <h1>Dodaj Nowy Quiz</h1>

    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Tytuł Quizu:</label><br>
            <input type="text" name="title" style="width: 100%; padding: 8px;" required>
        </div>

        <button type="submit" style="background: blue; color: white; padding: 10px 20px; border: none;">Zapisz Quiz</button>
        <a href="{{ route('quizzes.index') }}" style="margin-left: 10px;">Anuluj</a>
    </form>
@endsection
