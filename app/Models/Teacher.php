<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation_type',
        'subject_id',
        'phone',
        'institution',
        'logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subjectRelatedQuestions()
    {
        // return Question::whereRelation('chapter', function ($query) {
        //     $query->whereRelation('book', function ($query) {
        //         $query->where('subject_id', $this->id);
        //     });
        // });
    }
}
