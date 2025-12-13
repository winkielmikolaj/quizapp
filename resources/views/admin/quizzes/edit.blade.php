@extends('layouts.app')

@section('title', 'Edytuj Quiz')

@section('content')
    <h1>Edytuj Quiz: {{ $quiz->title }}</h1>

    <form action="{{ route('quizzes.update', $quiz) }}" method="POST">
        @csrf
        @method('PUT') <div style="margin-bottom: 15px;">
            <label>Tytuł Quizu:</label><br>
            <input type="text" name="title" value="{{ $quiz->title }}" style="width: 100%; padding: 8px;" required>
        </div>

        <button type="submit" style="background: orange; color: white; padding: 10px 20px; border: none;">Zaktualizuj</button>
        <a href="{{ route('quizzes.index') }}" style="margin-left: 10px;">Anuluj</a>
    </form>
@endsection
