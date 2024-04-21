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
    public function  subtypes($type_id)
    {
        if ($this->subject->name_en == 'English')
            $subtypes = Subtype::where('type_id',  $type_id)
                ->where('language', 'en')
                ->get();
        else if ($this->subject->name_en == 'Urdu')
            $subtypes = Subtype::where('type_id', $type_id)
                ->where('language', 'ur')
                ->get();
        else
            $subtypes = Subtype::where('type_id',  $type_id)
                ->whereNull('language')
                ->get();

        return $subtypes;
    }
}
