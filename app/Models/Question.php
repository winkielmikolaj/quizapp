<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //te pola MOZNA wypelnic
    protected $fillable = ['quiz_id', 'content', 'answer'];

    //pytanie nalezy do jednego quizu
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
