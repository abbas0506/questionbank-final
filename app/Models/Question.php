<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', //owner id
        'book_id',
        'type_id',
        'subtype_id',
        'topic_id',

        'chapter_no',
        'exercise_no',

        'statement_en',
        'statement_ur',
        'marks',
        'bise_frequency',
        'is_conceptual',
        'is_approved',
        'questionable_type',
        'questionable_id',
    ];


    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function subtype()
    {
        return $this->belongsTo(Subtype::class);
    }
    public function questionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeMcqs($query)
    {
        return $query->where('question_type', 'mcq');
    }
    public function scopeShort($query)
    {
        return $query->where('question_type', 'short');
    }
    public function scopeLong($query)
    {
        return $query->where('question_type', 'long');
    }
    public function scopeToday($query)
    {
        return $query->whereDate('questions.created_at', today());
    }
}
