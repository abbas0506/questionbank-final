<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'paper_id',
        'subtype_id',
        'question_title',
        'question_nature',
        'exercise_ratio',
        'conceptual_ratio',
        'frequency',
        'choices',
        'number_style',
        'display_cols',
        'position_no'
    ];

    public function  paper()
    {
        return $this->belongsTo(Paper::class);
    }
    public function  subtype()
    {
        return $this->belongsTo(Subtype::class);
    }

    public function  paperQuestionParts()
    {
        return $this->hasMany(PaperQuestionPart::class);
    }
}
