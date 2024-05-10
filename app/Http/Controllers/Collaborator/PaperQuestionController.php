<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Paper;
use App\Models\PaperQuestion;
use App\Models\PaperQuestionPart;
use App\Models\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaperQuestionController extends Controller
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
    public function store(Request $request, $paperId)
    {
        //


        $request->validate([

            'type_id' => 'required|numeric',
            'subtype_id' => 'nullable|numeric',
            'question_title' => 'nullable|max:100',
            'question_nature' => 'required',
            'exercise_ratio' => 'required|numeric',
            'conceptual_ratio' => 'required|numeric',
            'frequency' => 'required|numeric',
            'choices' => 'required|numeric',
            // 'number_style' => 'required',
            // 'display_cols' => 'required|numeric',
            // 'position_no' => 'required|numeric',
            'chapter_ids_array' => 'required',
            'parts_count_array' => 'required',

        ]);

        $paper = Paper::find($paperId);
        DB::beginTransaction();
        try {
            //create paper question instance
            $paperQuestion = $paper->paperQuestions()->create([
                'type_id' => $request->type_id,
                'question_title' => $request->question_title,
                'question_nature' => $request->question_nature,
                'exercise_ratio' => $request->exercise_ratio,
                'conceptual_ratio' => $request->conceptual_ratio,
                'frequency' => $request->frequency,
                'choices' => $request->choices,
                // 'number_style' => $request->num,
                // 'display_cols' => 'required|numeric',
                // 'position_no' => 'required|numeric',
            ]);
            //randomly select question parts from each chapter and save them
            $chaperIds = array();
            $partsCount = array();
            $chaperIds = $request->chapter_ids_array;
            $partsCount = $request->parts_count_array;
            $chapters = Chapter::whereIn('id', $chaperIds)->get();

            $i = 0; //for iterating numOfparts
            // echo $threshold;
            foreach ($chapters as $chapter) {

                $randomQuestions = Question::where('type_id', $request->type_id)
                    ->where('chapter_id', $chapter->id)
                    // ->where('is_from_exercise', $request->exercise_only)
                    ->where('frequency', '>=', $request->frequency)
                    ->get()
                    ->random($partsCount[$i]);

                echo $chapter->id . ":" . $request->type_id . "," . $request->frequency . "-" . $partsCount[$i] . "<br>";

                foreach ($randomQuestions as $question) {
                    $paperQuestion->paperQuestionParts()->create([
                        'question_id' => $question->id,
                    ]);
                }

                $i++;
            }
            DB::commit();

            return redirect()->route('collaborator.papers.show', $paper)->with('success', 'Question successfully added!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $paperId, $paperQuestionId)
    {
        //
        try {
            $paperQuestion = Question::find($paperQuestionId);
            $paperQuestion->delete();
            return redirect()->back()->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
