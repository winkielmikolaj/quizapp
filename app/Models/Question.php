<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'content'];

    // Relacja: Pytanie należy do quizu
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
