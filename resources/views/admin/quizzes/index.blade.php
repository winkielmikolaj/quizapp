@extends('layouts.app')

@section('title', 'Panel Admina - Quizy')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Zarządzanie Quizami</h1>
        <a href="{{ route('quizzes.create') }}" style="background: green; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">+ Dodaj Nowy Quiz</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr style="background: #f0f0f0;">
            <th>ID</th>
            <th>Tytuł</th>
            <th>Liczba pytań</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quizzes as $quiz)
            <tr>
                <td>{{ $quiz->id }}</td>
                <td>{{ $quiz->title }}</td>
                <td>{{ $quiz->questions_count }}</td>
                <td>
                    <a href="{{ route('admin.quiz.questions', $quiz->id) }}" style="color: blue; margin-right: 10px;">Pytania</a>

                    <a href="{{ route('quizzes.edit', $quiz) }}" style="color: orange; margin-right: 10px;">Edytuj</a> |

                    <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" style="display:inline;" onsubmit="return confirm('Czy na pewno usunąć ten quiz?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: red; border: none; background: none; cursor: pointer; text-decoration: underline;">Usuń</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
