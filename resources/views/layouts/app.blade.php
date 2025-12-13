<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>QuizApp - @yield('title')</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        nav { margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px; }
        nav a { margin-right: 15px; text-decoration: none; color: blue; }
    </style>
</head>
<body>
<header>
    <nav>
        <a href="/">Strona Główna</a>
        <a href="/quizzes">Lista Quizów</a>
    </nav>
</header>

<main>
    @yield('content')
</main>
</body>
</html>
