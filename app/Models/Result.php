<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //mowienie laravelovi, ze te kolumny MOZNA wypelnic
    protected $fillable = ['quiz_id', 'score', 'total_questions'];

    //wynik nalezy do konkretnego quizu
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
