@extends('layouts.app')

@section('title', 'Lista Quizów')

@section('content')
    <h1>Dostępne Quizy Matematyczne</h1>

    <ul>
        @foreach($quizzes as $quiz)
            <li style="margin-bottom: 10px;">
                <strong>{{ $quiz['title'] }}</strong>
                <br>
                <a href="/quizzes/{{ $quiz['id'] }}">Rozwiąż ten quiz -></a>
            </li>
        @endforeach
    </ul>
@endsection
