<?php

namespace Database\Seeders;

use App\Models\Subtype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Subtype::create([
            'name_en' => 'Program',
            'name_ur' => 'پروگرام'
        ]);
        Subtype::create([
            'name_en' => 'Program Output',
            'name_ur' => 'پروگرام آوٹ پُٹ',
        ]);
        Subtype::create([
            'name_en' => 'Syntax Correction',
            'name_ur' => 'سینٹیکس کوریکشن',
        ]);
        Subtype::create([
            'name_en' => 'Numerical',
            'name_ur' => 'نمیریکل'
        ]);
        Subtype::create([
            'name_en' => 'Theorem',
            'name_ur' => 'تھیورم'
        ]);
    }
}
