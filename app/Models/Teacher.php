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
        'institution',
        'logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
