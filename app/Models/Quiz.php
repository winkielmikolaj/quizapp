<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //te pola MOZNA wypelnic
    protected $fillable = ['title'];

    //quiz ma wiele pytan
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
