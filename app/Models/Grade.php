<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',          //one two three
        'grade_no',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function questions()
    {
        return $this->hasManyThrough(Question::class, Book::class);
    }
}
