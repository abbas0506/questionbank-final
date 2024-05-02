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
        'chapter_id',
        'type_id',
        'subtype_id',
        'topic_id',

        'statement',
        'exercise_no',
        'frequency',
        'marks',
        'is_conceptual',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function subtype()
    {
        return $this->belongsTo(Subtype::class);
    }

    public function mcq()
    {
        return $this->hasOne(Mcq::class);
    }
    public function comprehensions()
    {
        return $this->hasMany(Comprehension::class);
    }
    public function paraphrasings()
    {
        return $this->hasMany(Paraphrasing::class);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('questions.created_at', today());
    }
    public function scopeObjective($query)
    {
        return $query->where('type_id', 1);
    }
    public function scopeSubjective($query)
    {
        return $query->where('type_id', 2);
    }
    public function scopeChapter($query, $chapter_no)
    {
        return $query->where('chapter_no', $chapter_no);
    }
    public function scopeApproved($query, $isApproved)
    {
        return $query->where('is_approved', $isApproved);
    }
}
