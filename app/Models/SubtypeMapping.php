<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubtypeMapping extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'type_id',
        'subtype_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function subtype()
    {
        return $this->belongsTo(Subtype::class);
    }
}
