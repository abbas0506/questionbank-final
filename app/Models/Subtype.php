<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtype extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id',
        'name',
        'language',
        'tagname',
    ];
}
