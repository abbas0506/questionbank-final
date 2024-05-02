<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ur',
        'display_order',
        'thumbnail',
        'text_direction',
    ];

    public function  grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function subtypes()
    {
        // if subject english:6, or urdu:7, return subject related subtypes
        // else return general subtypes
        if (in_array($this->id, [6, 7]))
            return Subtype::where('subject_id', $this->id)->get();
        else
            return Subtype::whereNull('subject_id')->get();
    }
    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function questions()
    {
    }
}
