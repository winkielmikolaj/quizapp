@extends('layouts.app')

@section('title', 'Lista Quizów')

@section('content')
    <h1>Dostępne Quizy Matematyczne</h1>

    <ul>
        @foreach($quizzes as $quiz)
            <li style="margin-bottom: 10px;">
                {{-- Zmiana ['title'] na ->title --}}
                <strong>{{ $quiz->title }}</strong>
                <br>
                {{-- Zmiana ['id'] na ->id --}}
                <a href="/quizzes/{{ $quiz->id }}">Rozwiąż ten quiz -></a>
            </li>
        @endforeach
    </ul>
@endsection
