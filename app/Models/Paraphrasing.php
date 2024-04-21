<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paraphrasing extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'poetry_line',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
