<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Question;
use App\Models\Subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //
    public function fetchSubtypesByTypeId(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'book_id' => 'required',
        ]);
        $book = Book::find($request->book_id);

        $text = '';

        $subtypes = $book->subtypes($request->type_id);

        foreach ($subtypes as $subtype) {
            $text .= "<option value='" . $subtype->id . "'>" . $subtype->name . "</option>";
        }

        return response()->json([
            'options' => $text,
        ]);
    }

    public function findSimilarQuestions(Request $request)
    {
        $request->validate([
            // 'str' => 'required',
            'question_id' => 'required|numeric',
        ]);

        $question = Question::find($request->question_id);
        $statement = Str::lower($question->statement);

        $wordsToRemove = ['define', 'what', 'is', 'am', 'are', 'was', 'were', 'of', 'describe', '.', ',', '?'];

        foreach ($wordsToRemove as $word) {
            $statement = Str::replace($word, '', $statement);
        }

        // Optionally, trim extra spaces after removing words
        $statement = trim($statement);
        $parts = explode(" ", $statement);
        $str = $parts[0];

        $text = '';


        $questions = Question::where('statement', 'like', '%' . $str . '%')
            ->whereRelation('chapter', function ($query) use ($question) {
                $query->where('book_id', $question->chapter->book_id)
                    ->whereRelation('book', function ($query) use ($question) {
                        $query->where('subject_id', $question->chapter->book->subject_id);
                    });
            })->get();

        $text .= "<p>" . $str . "-" . $questions->count() . "</p>";
        if ($questions->count()) {
            foreach ($questions as $question) {
                $text .= "<p>" . $question->statement . "</div>";
                // $text .= "<p>" . $str . "</p>";
            }
        }


        return response()->json([
            'options' => $text,
        ]);
    }
}
