<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprehension extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_a',
        'question_b',
        'question_c',
        'question_d',
        'question_e',
        'question_f',
        'question_g',
        'question_h',
    ];
}
