<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Dodajemy 'answer' do listy dozwolonych pól
    protected $fillable = ['quiz_id', 'content', 'answer'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
