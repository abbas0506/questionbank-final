<?php

namespace Database\Seeders;

use App\Models\SubtypeMapping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubtypeMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //21: english 9, 
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 1, 'subtype_id' => 1,]);  //form of verb
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 1, 'subtype_id' => 2,]);  //correct spelling
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 1, 'subtype_id' => 3,]);  //meanings 
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 1, 'subtype_id' => 4,]);  //correct grammar  

        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 7,]);  //eng to urdu
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 9,]);  //summary of poem
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 11,]); //comprehension
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 12,]);  //letter
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 13,]);  //story
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 14,]);  //dialogue
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 16,]);  //paragraph writing
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 17,]);  //idioms
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 18,]);  //active passive
        SubtypeMapping::create(['book_id' => 21, 'type_id' => 3, 'subtype_id' => 21,]);  //urdu sentences to eng

        //22: english 10,
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 1, 'subtype_id' => 1,]);  //form of verb
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 1, 'subtype_id' => 2,]);  //correct spelling
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 1, 'subtype_id' => 4,]);  //correct grammar
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 1, 'subtype_id' => 22,]); //synonys/antonyms

        SubtypeMapping::create(['book_id' => 22, 'type_id' => 3, 'subtype_id' => 7,]);  //eng to urdu
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 3, 'subtype_id' => 8,]);  //urdu to eng para
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 3, 'subtype_id' => 9,]);  //summary of poem
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 3, 'subtype_id' => 10,]); //paraphrasing poetry
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 3, 'subtype_id' => 15,]);  //essay
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 3, 'subtype_id' => 16,]);  //paragraph writing
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 3, 'subtype_id' => 19,]);  //direct indirect
        SubtypeMapping::create(['book_id' => 22, 'type_id' => 3, 'subtype_id' => 20,]);  //pair of words

        //23: english 11,
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 1, 'subtype_id' => 1,]);  //form of verb
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 1, 'subtype_id' => 3,]);  //meanings

        SubtypeMapping::create(['book_id' => 23, 'type_id' => 3, 'subtype_id' => 7,]);   //eng to urdu
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 3, 'subtype_id' => 12,]);  //letter
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 3, 'subtype_id' => 23,]);  //application
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 3, 'subtype_id' => 13,]);  //story
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 3, 'subtype_id' => 15,]);  //essay
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 3, 'subtype_id' => 19,]);  //direct indirect
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 3, 'subtype_id' => 20,]);  //pair of words
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 3, 'subtype_id' => 24,]);  //punctuation
        SubtypeMapping::create(['book_id' => 23, 'type_id' => 3, 'subtype_id' => 25,]);  //paragraph explanation


        //24: english 12,

        SubtypeMapping::create(['book_id' => 24, 'type_id' => 1, 'subtype_id' => 3,]); //meanings
        SubtypeMapping::create(['book_id' => 24, 'type_id' => 1, 'subtype_id' => 4,]); //correct grammar
        SubtypeMapping::create(['book_id' => 24, 'type_id' => 1, 'subtype_id' => 5,]); //proposition
        SubtypeMapping::create(['book_id' => 24, 'type_id' => 1, 'subtype_id' => 6,]); //senetence correction

        SubtypeMapping::create(['book_id' => 24, 'type_id' => 3, 'subtype_id' => 8,]);  //urdu to eng para
        SubtypeMapping::create(['book_id' => 24, 'type_id' => 3, 'subtype_id' => 15,]);  //essay
        SubtypeMapping::create(['book_id' => 24, 'type_id' => 3, 'subtype_id' => 17,]);  //idioms
    }
}
