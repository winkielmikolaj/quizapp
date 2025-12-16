@extends('layouts.app')

@section('title', 'Pytania - ' . $quiz->title)

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Pytania do: {{ $quiz->title }}</h1>
        <div>
            <a href="{{ route('admin.quiz.questions.create', $quiz->id) }}" style="background: green; color: white; padding: 10px; text-decoration: none; margin-right: 10px; border-radius: 5px;">+ Dodaj Pytanie</a>
            <a href="{{ route('quizzes.index') }}" style="background: grey; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">Wróć do Quizów</a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr style="background: #f0f0f0;">
            <th>Pytanie</th>
            <th>Poprawna odp.</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        @forelse($quiz->questions as $question)
            <tr>
                <td>{{ $question->content }}</td>
                <td>{{ $question->answer }}</td>
                <td>
                    <a href="{{ route('admin.questions.edit', $question->id) }}" style="color: orange; margin-right: 10px;">Edytuj</a>

                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Usunąć to pytanie?');">
                        @csrf
                        @method('DELETE')
                        <button style="color: red; border: none; background: none; cursor: pointer; text-decoration: underline;">Usuń</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="text-align: center;">Brak pytań. Dodaj pierwsze!</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
