<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'paper_id',
        'type_id',
        'question_title',
        'display_style',
        'exercise_ratio',
        'conceptual_ratio',
        'frequency',
        'choices',
        'number_style',
        'display_cols',
        'position'
    ];

    public function  paper()
    {
        return $this->belongsTo(Paper::class);
    }
    public function  type()
    {
        return $this->belongsTo(Type::class);
    }

    public function  paperQuestionParts()
    {
        return $this->hasMany(PaperQuestionPart::class);
    }
}
