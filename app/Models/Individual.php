<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'subject_id',
        'institution_id',
        'is_active',
    ];
}
