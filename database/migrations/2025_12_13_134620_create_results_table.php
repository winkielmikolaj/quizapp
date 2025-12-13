<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            // Powiązanie z quizem (jak usuniesz quiz, wyniki też znikną)
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');

            // Opcjonalnie: Powiązanie z użytkownikiem (jeśli kiedyś dodasz logowanie)
            // $table->foreignId('user_id')->nullable()->constrained();

            $table->integer('score');           // Zdobyte punkty
            $table->integer('total_questions'); // Maksymalna liczba punktów
            $table->timestamps();               // Data wypełnienia (created_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
