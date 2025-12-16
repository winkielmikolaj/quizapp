<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run()
    {
        $quiz1 = Quiz::create(['title' => 'Matematyka: Dodawanie']);

        $quiz1->questions()->createMany([
            ['content' => 'Ile to jest 2 + 2?', 'answer' => 4],
            ['content' => 'Ile to jest 15 + 25?', 'answer' => 40],
            ['content' => 'Jaki jest wynik 100 + 0?', 'answer' => 100],
        ]);

        $quiz2 = Quiz::create(['title' => 'Matematyka: Mnożenie']);

        $quiz2->questions()->createMany([
            ['content' => 'Ile to jest 3 * 3?', 'answer' => 9],
            ['content' => 'Ile to jest 7 * 8?', 'answer' => 56],
            ['content' => 'Jaki jest wynik 10 * 10?', 'answer' => 100],
        ]);
    }
}
