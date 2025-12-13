<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['quiz_id', 'score', 'total_questions'];

    // Relacja: Wynik należy do konkretnego quizu
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
