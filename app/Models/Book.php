<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'grade_id',
        'name',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function questions()
    {
        return $this->hasManyThrough(Question::class, Chapter::class);
    }
    public function  subtypes($type_id)
    {
        $subtypes = $this->subject->subtypes()->where('type_id', $type_id);
        return $subtypes;
    }
}
