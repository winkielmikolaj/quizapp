@extends('layouts.app')

@section('title', $quiz['title'])

@section('content')
    <h1>{{ $quiz['title'] }}</h1>
    <p>Odpowiedz na poniższe pytania:</p>

    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
        <ol>
            @foreach($quiz['questions'] as $question)
                <li style="margin-bottom: 15px;">
                    {{ $question }}
                    <br>
                    <input type="text" placeholder="Twoja odpowiedź...">
                </li>
            @endforeach
        </ol>
    </div>

    <br>
    <a href="/quizzes">Wait, wróć do listy quizów</a>
@endsection
