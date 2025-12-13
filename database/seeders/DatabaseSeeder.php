<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tworzymy Administratora
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'), // Hasło musi być zahaszowane
        ]);

        // 2. Uruchamiamy seeder quizów (który stworzyłeś wcześniej)
        $this->call([
            QuizSeeder::class,
        ]);
    }
}
