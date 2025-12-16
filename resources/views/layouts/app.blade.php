<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>QuizApp - @yield('title')</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        nav { margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px; }
        nav a { margin-right: 15px; text-decoration: none; color: blue; }
        /* Styl dla linku admina */
        nav a.admin-link { color: red; font-weight: bold; }
    </style>
</head>
<body>
admin@test.com
password
<header>
    <nav>
        <a href="/">Strona Główna</a>
        <a href="/quizzes">Lista Quizów</a>

        <a href="/admin/quizzes" class="admin-link">Panel Admina</a>
    </nav>
</header>

<main>
    @yield('content')
</main>
</body>
</html>
