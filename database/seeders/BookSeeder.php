<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //physics

        Book::create(['name' => 'Physics 9', 'subject_id' => 1, 'grade_id' => 1, 'language' => 'mx',]);
        Book::create(['name' => 'Physics 10', 'subject_id' => 1, 'grade_id' => 2, 'language' => 'mx']);
        Book::create(['name' => 'Physics 11', 'subject_id' => 1, 'grade_id' => 3, 'language' => 'en',]);
        Book::create(['name' => 'Physics 12', 'subject_id' => 1, 'grade_id' => 4, 'language' => 'en']);

        //math
        Book::create(['name' => 'Mathematics 9', 'subject_id' => 2, 'grade_id' => 1, 'language' => 'mx']);
        Book::create(['name' => 'Mathematics 10', 'subject_id' => 2, 'grade_id' => 2, 'language' => 'mx']);
        Book::create(['name' => 'Mathematics 11', 'subject_id' => 2, 'grade_id' => 3, 'language' => 'en']);
        Book::create(['name' => 'Mathematics 12', 'subject_id' => 2, 'grade_id' => 4, 'language' => 'en']);

        //computer sc
        Book::create(['name' => 'Computer Sc 9', 'subject_id' => 3, 'grade_id' => 1, 'language' => 'mx']);
        Book::create(['name' => 'Computer Sc 10', 'subject_id' => 3, 'grade_id' => 2, 'language' => 'mx']);
        Book::create(['name' => 'Computer Sc 11', 'subject_id' => 3, 'grade_id' => 3, 'language' => 'en']);
        Book::create(['name' => 'Computer Sc 12', 'subject_id' => 3, 'grade_id' => 4, 'language' => 'en']);

        //chemistry
        Book::create(['name' => 'Chemistry 9', 'subject_id' => 4, 'grade_id' => 1, 'language' => 'mx']);
        Book::create(['name' => 'Chemistry 10', 'subject_id' => 4, 'grade_id' => 2, 'language' => 'mx']);
        Book::create(['name' => 'Chemistry 11', 'subject_id' => 4, 'grade_id' => 3, 'language' => 'en']);
        Book::create(['name' => 'Chemistry 12', 'subject_id' => 4, 'grade_id' => 4, 'language' => 'en']);

        //biology
        Book::create(['name' => 'Biology 9', 'subject_id' => 5, 'grade_id' => 1, 'language' => 'mx']);
        Book::create(['name' => 'Biology 10', 'subject_id' => 5, 'grade_id' => 2, 'language' => 'mx']);
        Book::create(['name' => 'Biology 11', 'subject_id' => 5, 'grade_id' => 3, 'language' => 'en']);
        Book::create(['name' => 'Biology 12', 'subject_id' => 5, 'grade_id' => 4, 'language' => 'en']);

        //english
        Book::create(['name' => 'English 9', 'subject_id' => 6, 'grade_id' => 1, 'language' => 'en']);
        Book::create(['name' => 'English 10', 'subject_id' => 6, 'grade_id' => 2, 'language' => 'en']);
        Book::create(['name' => 'English 11', 'subject_id' => 6, 'grade_id' => 3, 'language' => 'en']);
        Book::create(['name' => 'English 12', 'subject_id' => 6, 'grade_id' => 4, 'language' => 'en']);

        //urdu
        Book::create(['name' => 'Urdu 9', 'subject_id' => 7, 'grade_id' => 1, 'language' => 'ur']);
        Book::create(['name' => 'Urdu 10', 'subject_id' => 7, 'grade_id' => 2, 'language' => 'ur']);
        Book::create(['name' => 'Urdu 11', 'subject_id' => 7, 'grade_id' => 3, 'language' => 'ur']);
        Book::create(['name' => 'Urdu 12', 'subject_id' => 7, 'grade_id' => 4, 'language' => 'ur']);

        //islamic studies
        Book::create(['name' => 'Islamic Studies 9', 'subject_id' => 8, 'grade_id' => 1, 'language' => 'ur']);
        Book::create(['name' => 'Islamic Studies 10', 'subject_id' => 8, 'grade_id' => 2, 'language' => 'ur']);
        Book::create(['name' => 'Islamic Studies 11', 'subject_id' => 8, 'grade_id' => 3, 'language' => 'ur']);
        Book::create(['name' => 'Islamic Studies 12', 'subject_id' => 8, 'grade_id' => 4, 'language' => 'ur']);

        //pak studies
        Book::create(['name' => 'Pak Studies 9', 'subject_id' => 9, 'grade_id' => 1, 'language' => 'ur']);
        Book::create(['name' => 'Pak Studies 10', 'subject_id' => 9, 'grade_id' => 2, 'language' => 'ur']);
        Book::create(['name' => 'Pak Studies 11', 'subject_id' => 9, 'grade_id' => 3, 'language' => 'ur']);
        Book::create(['name' => 'Pak Studies 12', 'subject_id' => 9, 'grade_id' => 4, 'language' => 'ur']);

        //gen science
        Book::create(['name' => 'General Sc 9', 'subject_id' => 10, 'grade_id' => 1, 'language' => 'mx']);
        Book::create(['name' => 'General Sc 10', 'subject_id' => 10, 'grade_id' => 2, 'language' => 'mx']);
    }
}
