<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $question = Question::find($id);

        $statement = Str::lower($question->statement);

        $punctuationMarks = ['.', ',', '?', ':',];

        //too short automatically skippped words
        // 'who', 'how','is', 'am', 'are', 'was', 'can', 'of', 'the','has',  'had',
        // 'in', 'out', 'on', 'at', 'as', 'any', 'one', 'two', 'or''i', 'we', 'our', 'us', 'you', 
        // 'he', 'she', 'it', 'its', 'his', 'him', 'her', 

        $wordsToRemove = [
            'define', 'explain', 'describe', 'write', 'down',
            'what', 'which', 'where', 'whose', 'when',
            'were', 'shall', 'will', 'would', 'should',
            'could', 'might', 'here', 'there',  'have',
            'this', 'that', 'such', 'with',
            'three', 'four', 'five', 'seven', 'eight', 'nine',
            'your', 'they', 'their', 'them', 'differentiate', 'between', 'find'

        ];

        // remove puncutation marks
        foreach ($punctuationMarks as $punctuationMark) {
            $statement = Str::replace($punctuationMark, '', $statement);
        }
        // Optionally, trim extra spaces after removing words
        $statement = trim($statement);

        // skip  too short words, pick atleast 4 chracters word
        preg_match_all("/\b\w{4,}\b/", $statement, $wordsArray);

        $wordsArray = $wordsArray[0];

        // remove duplicated words
        $wordsArray = array_unique($wordsArray);

        // Remove specific words from the array
        $shortListedWordsArray = array_diff($wordsArray, $wordsToRemove);

        // reset the index values of array
        $shortListedWordsArray = array_values($shortListedWordsArray);

        if (count($shortListedWordsArray)) {
            $similarQuestions = Question::whereNot('id', $question->id)
                ->where('type_id', $question->type_id)
                ->where('statement', 'like', '%' . $shortListedWordsArray[0] . '%')
                ->whereRelation('chapter', function ($query) use ($question) {
                    $query->where('book_id', $question->chapter->book_id)
                        ->whereRelation('book', function ($query) use ($question) {
                            $query->where('subject_id', $question->chapter->book->subject_id);
                        });
                });

            if (count($shortListedWordsArray) > 1) {
                $similarQuestions = $similarQuestions->where('statement', 'like', '%' . $shortListedWordsArray[1] . '%');
            }
            // if (count($shortListedWordsArray) > 2) {
            //     $similarQuestions = $similarQuestions->where('statement', 'like', '%' . $shortListedWordsArray[2] . '%');
            // }

            $similarQuestions = $similarQuestions->get();
        }

        return view('collaborator.approval.edit', compact('question', 'similarQuestions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $questionId)
    {
        //
        $request->validate([
            'exercise_no' => 'nullable|numeric',
            'statement' => 'required',
            'marks' => 'required|numeric',
            'frequency' => 'required|numeric',
            'is_conceptual' => 'required|boolean',
        ]);

        $question = Question::find($questionId);

        DB::beginTransaction();

        try {
            $question->update([
                'marks' => $request->marks,
                'statement' => $request->statement,
                'exercise_no' => $request->exercise_no,
                'is_conceptual' => $request->is_conceptual,
                'frequency' => $request->frequency,
                'is_approved' => true,
            ]);

            // mcqs
            if ($question->type->name == 'Objective') {
                $correct = '';
                if ($request->check_a) $correct = 'a';
                if ($request->check_b) $correct = 'b';
                if ($request->check_c) $correct = 'c';
                if ($request->check_d) $correct = 'd';

                $question->mcq()->update([
                    'choice_a' => $request->choice_a,
                    'choice_b' => $request->choice_b,
                    'choice_c' => $request->choice_c,
                    'choice_d' => $request->choice_d,
                    'correct' => $correct,
                ]);
            }

            // paraphrasing
            // if ($question->subtype->tagname == 'paraphrasing') {
            //     foreach ($request->poetry_lines as $poetry_line) {
            //         if ($poetry_line != '')
            //             $question->paraphrasings()->update([
            //                 'poetry_line' => $poetry_line,
            //             ]);
            //     }
            // }

            // //comprehension
            // if ($question->subtype->tagname == 'comprehension') {
            //     foreach ($request->sub_questions as $subQuestion) {
            //         if ($subQuestion != '')
            //             $question->comprehensions()->update([
            //                 'sub_question' => $subQuestion,
            //             ]);
            //     }
            // }

            // commit if all ok
            DB::commit();
            return redirect('/')->with(
                [
                    'success' => 'Successfully updated',
                ]
            );
            // return redirect()->route('admin.chapter.questions.index', [$bookId, $chapterId])->with('success', 'Successfully added');;
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $question = Question::find($id);
            $question->delete();
            return redirect('/')->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
