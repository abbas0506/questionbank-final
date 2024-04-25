<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'chapter_no',
        'name',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function questions()
    {
        // return $this->book->questions->where()
    }
}
