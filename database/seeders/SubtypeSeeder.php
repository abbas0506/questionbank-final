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

        Subtype::create([
            'name' => 'MCQs',
            'type_id' => 1,
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'Short',
            'type_id' => 2,
        ]);
        Subtype::create([
            'name' => 'Long',
            'type_id' => 2,
        ]);

        //English 9, MCQ subtypes
        Subtype::create([
            'name' => 'Correct form of verb',
            'type_id' => 1,
            'language' => 'en',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'Correct spelling',
            'type_id' => 1,
            'language' => 'en',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'Meaning of words',
            'type_id' => 1,
            'language' => 'en',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'Correct grammar',
            'type_id' => 1,
            'language' => 'en',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'MCQs (Lesson)',
            'type_id' => 1,
            'language' => 'en',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'MCQs (Play)',
            'type_id' => 1,
            'language' => 'en',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'MCQs (Novel)',
            'type_id' => 1,
            'language' => 'en',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'Correct grammar',
            'type_id' => 1,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Short (Lesson)',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Short (Poem)',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Short (Novel)',
            'type_id' => 2,
            'language' => 'en',
        ]);

        Subtype::create([
            'name' => 'English to Urdu (Para)',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Urdu to English (Para)',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Summary of Poem',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Paraphrasing of poetry',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Comprehension',
            'type_id' => 2,
            'language' => 'en',
            'questionable_type' => 'App\Models\Comprehension',
        ]);
        Subtype::create([
            'name' => 'Idioms/Phrases',
            'type_id' => 2,
            'language' => 'en'
        ]);
        Subtype::create([
            'name' => 'Letter',
            'type_id' => 2,
            'language' => 'en'
        ]);
        Subtype::create([
            'name' => 'Story',
            'type_id' => 2,
            'language' => 'en'
        ]);
        Subtype::create([
            'name' => 'Dialogue',
            'type_id' => 2,
            'language' => 'en'
        ]);
        Subtype::create([
            'name' => 'Essay',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Paragraph writing',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Idioms/Phrases',
            'type_id' => 2,
            'language' => 'en'
        ]);
        Subtype::create([
            'name' => 'Active/Passive',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Direct/indirect',
            'type_id' => 2,
            'language' => 'en',
        ]);
        Subtype::create([
            'name' => 'Pair of words',
            'type_id' => 2,
            'language' => 'en',
        ]);

        // urdu subtypes
        Subtype::create([
            'name' => ' نصابی کثیرالانتخاب ',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'تشبیہ',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'استعارہ',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'تلمیح',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'مطلع',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'قافیہ',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'ردیف',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'تذکیرو تانیث',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'امدادی فعل',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'رموزاوقاف',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'جملہ کی درستی',
            'type_id' => 1,
            'language' => 'ur',
            'questionable_type' => 'App\Models\Mcq',
        ]);
        Subtype::create([
            'name' => 'اشعار کی تشریح:نظم',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'اشعار کی تشریح:غزل',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'سبقی پیرا گراف کی تشریح',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'سبق کا خلاصہ',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'نظم کا خلاصہ',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'روداد',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'روزنامچہ',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'مکالمہ نگاری',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'خط',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'درخواست',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'آپ بیتی',
            'type_id' => 2,
            'language' => 'ur',
        ]);
        Subtype::create([
            'name' => 'مضمون',
            'type_id' => 2,
            'language' => 'ur',
        ]);
    }
}
