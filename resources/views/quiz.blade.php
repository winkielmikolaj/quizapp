@extends('layouts.app')

@section('title', $quiz->title)

@section('content')
    <h1>{{ $quiz->title }}</h1>

    {{-- Wyświetl ogólny komunikat sukcesu, jeśli istnieje --}}
    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <p>Odpowiedz na poniższe pytania:</p>

    {{-- Otwieramy formularz metodą POST --}}
    <form action="/quizzes/{{ $quiz->id }}" method="POST">
        {{-- Bardzo ważne: Token bezpieczeństwa przed atakami CSRF --}}
        @csrf

        <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
            <ol>
                @foreach($quiz->questions as $question)
                    <li style="margin-bottom: 20px;">
                        <label for="q{{ $question->id }}">{{ $question->content }}</label>
                        <br>

                        {{-- Input z nazwą tablicową: answers[ID_PYTANIA] --}}
                        {{-- value="{{ old(...) }}" sprawia, że wpisany tekst nie znika po błędzie walidacji --}}
                        <input type="text"
                               id="q{{ $question->id }}"
                               name="answers[{{ $question->id }}]"
                               value="{{ old('answers.'.$question->id) }}"
                               placeholder="Twoja odpowiedź..."
                               style="padding: 5px; width: 300px;">

                        {{-- Wyświetlanie błędu dla konkretnego pola --}}
                        @error('answers.'.$question->id)
                        <div style="color: red; font-size: 0.9em; margin-top: 5px;">
                            {{ $message }}
                        </div>
                        @enderror
                    </li>
                @endforeach
            </ol>
        </div>

        <br>
        <button type="submit" style="padding: 10px 20px; background-color: blue; color: white; border: none; cursor: pointer;">
            Wyślij odpowiedzi
        </button>
    </form>

    <br>
    <a href="/quizzes">Wróć do listy quizów</a>

    <hr style="margin: 30px 0;">

    <h3>Ostatnie wyniki tego quizu:</h3>

    @if($history->isEmpty())
        <p>Brak wyników. Bądź pierwszy!</p>
    @else
        <ul>
            @foreach($history as $result)
                <li>
                    {{-- Formatujemy datę (Dzień.Miesiąc Godzina:Minuta) --}}
                    <small>{{ $result->created_at->format('d.m.Y H:i') }}</small>
                    –
                    <strong>Wynik: {{ $result->score }} / {{ $result->total_questions }}</strong>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
