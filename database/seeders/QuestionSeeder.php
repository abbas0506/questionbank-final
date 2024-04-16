<?php

namespace Database\Seeders;

use App\Models\Mcq;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Question::create([
            'user_id' => 1,
            'book_id' => 11,
            'topic_id' => null,

            'chapter_no' => 1,
            'exercise_no' => 0,

            'statement_en' => 'Define input devices',
            'marks' => 2,
            'bise_frequency' => 3,
            'is_conceptual' => 0,
            'is_approved' => 0,
            'questionable_type' => 'App\Models\Short'

        ]);

        Question::create([
            'user_id' => 1,
            'book_id' => 11,
            'topic_id' => null,

            'chapter_no' => 1,
            'exercise_no' => 0,

            'statement_en' => 'Define operating system',
            'marks' => 2,
            'bise_frequency' => 3,
            'is_conceptual' => 0,
            'is_approved' => 0,
            'questionable_type' => 'App\Models\Short',

        ]);

        Question::create([
            'user_id' => 1,
            'book_id' => 11,
            'topic_id' => null,

            'chapter_no' => 1,
            'exercise_no' => 0,

            'statement_en' => 'List 3 input devices',
            'marks' => 2,
            'bise_frequency' => 3,
            'is_conceptual' => 0,
            'is_approved' => 0,
            'questionable_type' => 'App\Models\Short'
        ]);

        $mcq = Mcq::create([
            'choice_a' => 'Input device',
            'choice_b' => 'Output device',
            'choice_c' => 'Storage device',
            'choice_d' => 'None',
            'correct' => 'a',
        ]);

        Question::create([
            'user_id' => 1,
            'book_id' => 11,
            'topic_id' => null,

            'chapter_no' => 1,
            'exercise_no' => 0,

            'statement_en' => 'What type of mouse is?',
            'marks' => 1,
            'bise_frequency' => 3,
            'is_conceptual' => 0,
            'is_approved' => 0,
            'questionable_type' => 'App\Models\Mcq',
            'questionable_id' => $mcq->id,
        ]);

        // question 2
        $mcq = Mcq::create([
            'choice_a' => 'CPU',
            'choice_b' => 'Processor',
            'choice_c' => 'main memory',
            'choice_d' => 'RAM',
            'correct' => 'a',
        ]);

        Question::create([
            'user_id' => 1,
            'book_id' => 11,
            'topic_id' => null,

            'chapter_no' => 1,
            'exercise_no' => 0,

            'statement_en' => 'Which performs processing',
            'marks' => 1,
            'bise_frequency' => 3,
            'is_conceptual' => 0,
            'is_approved' => 0,
            'questionable_type' => 'App\Models\Mcq',
            'questionable_id' => $mcq->id,
        ]);

        //q3
        $mcq = Mcq::create([
            'choice_a' => 'Hardware',
            'choice_b' => 'Software',
            'choice_c' => 'Program',
            'choice_d' => 'IO',
            'correct' => 'a',
        ]);

        Question::create([
            'user_id' => 1,
            'book_id' => 11,
            'topic_id' => null,

            'chapter_no' => 2,
            'exercise_no' => 0,

            'statement_en' => 'Printer is a type of',
            'marks' => 1,
            'bise_frequency' => 3,
            'is_conceptual' => 0,
            'is_approved' => 0,
            'questionable_type' => 'App\Models\Mcq',
            'questionable_id' => $mcq->id,
        ]);

        //q4
        $mcq = Mcq::create([
            'choice_a' => 'hardware',
            'choice_b' => 'Sfotware',
            'choice_c' => 'Storage',
            'choice_d' => 'None',
            'correct' => 'c',
        ]);

        Question::create([
            'user_id' => 1,
            'book_id' => 11,
            'topic_id' => null,

            'chapter_no' => 2,
            'exercise_no' => 0,

            'statement_en' => 'Hard disk serves as',
            'marks' => 1,
            'bise_frequency' => 3,
            'is_conceptual' => 0,
            'is_approved' => 0,
            'questionable_type' => 'App\Models\Mcq',
            'questionable_id' => $mcq->id,
        ]);
    }
}
