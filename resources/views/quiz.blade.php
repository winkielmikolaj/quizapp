@extends('layouts.app')

{{-- Zmiana tablicy ['title'] na obiekt ->title --}}
@section('title', $quiz->title)

@section('content')
    <h1>{{ $quiz->title }}</h1>
    <p>Odpowiedz na poniższe pytania:</p>

    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
        <ol>
            {{-- Iterujemy po relacji ->questions --}}
            @foreach($quiz->questions as $question)
                <li style="margin-bottom: 15px;">
                    {{-- WAŻNE: Teraz pytanie to obiekt, więc wyświetlamy jego pole 'content' --}}
                    {{ $question->content }}
                    <br>
                    <input type="text" placeholder="Twoja odpowiedź...">
                </li>
            @endforeach
        </ol>
    </div>

    <br>
    <a href="/quizzes">Wait, wróć do listy quizów</a>
@endsection
