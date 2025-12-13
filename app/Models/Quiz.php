<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    // Pozwalamy na wypełnianie tych pól
    protected $fillable = ['title'];

    // Relacja: Quiz ma wiele pytań
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
