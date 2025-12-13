<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // Quiz 1: Dodawanie
        $quiz1 = Quiz::create(['title' => 'Matematyka: Dodawanie']);

        $quiz1->questions()->createMany([
            ['content' => 'Ile to jest 2 + 2?'],
            ['content' => 'Ile to jest 15 + 25?'],
            ['content' => 'Jaki jest wynik 100 + 0?'],
        ]);

        // Quiz 2: Mnożenie
        $quiz2 = Quiz::create(['title' => 'Matematyka: Mnożenie']);

        $quiz2->questions()->createMany([
            ['content' => 'Ile to jest 3 * 3?'],
            ['content' => 'Ile to jest 7 * 8?'],
            ['content' => 'Jaki jest wynik 10 * 10?'],
        ]);
    }
}
