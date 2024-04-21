<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtype extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_id',
        'language',
        'questionable_type',
    ];
}
