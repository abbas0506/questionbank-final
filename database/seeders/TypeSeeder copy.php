<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Type::create([
            'name_en' => 'MCQ',
            'name_ur' => 'کثیر الانتخابی',
            'associated_model' => 'App\Models\Mcq'
        ]);
        Type::create([
            'name_en' => 'Short',
            'name_ur' => 'مختصر',
            'associated_model' => 'App\Models\Short'
        ]);
        Type::create([
            'name_en' => 'Long',
            'name_ur' => 'تفصیلی',
            'associated_model' => 'App\Models\Long'
        ]);

        Type::create([
            'name_en' => 'Paragraph Translation: English to Urdu',
            'name_ur' => 'انگش سے اردو',
            'associated_model' => 'App\Models\E2u',
        ]);
        Type::create([
            'name_en' => 'Paragraph Translation: Urdu to English',
            'name_ur' => 'اردو سے انگلش',
            'associated_model' => 'App\Models\U2e',
        ]);
        Type::create([
            'name_en' => 'Poem',
            'name_ur' => 'نظم',
            'associated_model' => 'App\Models\Poem'
        ]);
        Type::create([
            'name_en' => 'Ghazal',
            'name_ur' => 'غزل',
            'associated_model' => 'App\Models\Ghazal'
        ]);
        Type::create([
            'name_en' => 'Paraphrasing of poetry',
            'name_ur' => 'تشریح',
            'associated_model' => 'App\Models\Paraphrase'
        ]);
        Type::create([
            'name_en' => 'Letter',
            'name_ur' => 'خط',
            'associated_model' => 'App\Models\Letter'
        ]);
        Type::create([
            'name_en' => 'Essay',
            'name_ur' => 'مضمون',
            'associated_model' => 'App\Models\Essay'
        ]);
        Type::create([
            'name_en' => 'Story',
            'name_ur' => 'کہانی',
            'associated_model' => 'App\Models\Story'
        ]);
        Type::create([
            'name_en' => 'Dialogue',
            'name_ur' => 'مکالمہ',
            'associated_model' => 'App\Models\Dialogue'
        ]);
        Type::create([
            'name_en' => 'Synonyms',
            'name_ur' => 'مترادف',
            'associated_model' => 'App\Models\Synonym'
        ]);
        Type::create([
            'name_en' => 'Antonyms',
            'name_ur' => 'متضاد',
            'associated_model' => 'App\Models\Antonym'
        ]);
        Type::create([
            'name_en' => 'Pair of words',
            'name_ur' => 'الفاظ کے جوڑے',
            'associated_model' => 'App\Models\Pair'
        ]);
        Type::create([
            'name_en' => 'Idiom',
            'name_ur' => 'محاورے',
            'associated_model' => 'App\Models\Idiom'
        ]);
        Type::create([
            'name_en' => 'Direct indirect',
            'name_ur' => 'ڈائریکٹ اِن ڈائریکٹ',
            'associated_model' => 'App\Models\Direct'
        ]);
        Type::create([
            'name_en' => 'Active Passive',
            'name_ur' => 'ایکٹو پیسو',
            'associated_model' => 'App\Models\Active'
        ]);
        Type::create([
            'name_en' => 'Sentence translation: english to urdu',
            'name_ur' => ' جملے کا ترجمہ',
            'associated_model' => 'App\Models\SentenceE2U'
        ]);
        Type::create([
            'name_en' => 'Sentence correction',
            'name_ur' => 'جملے کی درستگی',
            'associated_model' => 'App\Models\Correction'
        ]);
        Type::create([
            'name_en' => 'Sentence completion',
            'name_ur' => 'جملے کی تکمیل',
            'associated_model' => 'App\Models\Completion'
        ]);

        Type::create([

            'name_ur' => 'تشبیہ',
            'name_ur' => 'تشبیہ',
            'name_ur' => 'استعارہ',
            'name_ur' => 'تلمیح',
            'name_ur' => 'تشبیہ',
            'name_ur' => ' تشبیہ',
            'name_ur' => ' تشبیہ',
        ]);
    }
}
