<?php

namespace App\Http\Controllers\OnlineQuizzes;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;

class SelfTestController extends Controller
{
    //
    public function index()
    {
        //
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('online-quizzes.self-tests.index', compact('grades', 'subjects'));
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
        $request->validate([
            'book_id' => 'required|numeric',
            'mcqs_count' => 'required|numeric',
            'chapter_no_array' => 'required',
        ]);


        try {
            // $test = Test::create($request->all());
            $chapterNoArray = array();
            $chapterNoArray = $request->chapter_no_array;
            session([
                'chapterNoArray' => $chapterNoArray,
                'mcqs_count' => $request->mcqs_count,

            ]);
            return redirect()->route('self-tests.show', $request->book_id);
        } catch (Exception $e) {
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
        $book = Book::find($id);

        $chapterNoArray = session('chapterNoArray');
        $mcqs_count = session('mcqs_count');

        $questions = Question::whereIn('chapter_no', $chapterNoArray)
            ->where('type_id', 1)
            ->get()
            ->random($mcqs_count);
        // echo $questions;

        // $chapters = Chapter::whereIn('id', $chapterNoArray)->get();
        // $questions = collect();
        // foreach ($chapterNoArray as $chapterNo) {
        //     $questionsFromThisChapter = Question::where('question_type', 'mcq')
        //         ->where('chapter_no', $chapterNo)
        //         ->get()
        //         ->random(
        //             round(20 / sizeOf($chapterNoArray), 0)
        //         );

        //     foreach ($questionsFromThisChapter as $question)
        //         $questions->add($question);
        // }
        // echo $questions;
        return view('online-quizzes.self-tests.show', compact('book', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book = Book::find($id);
        // $chapters = Chapter::where('subject_id', $id)
        //     ->whereHas('questions')
        //     ->get();
        return view('online-quizzes.self-tests.edit', compact('book'));
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
    public function destroy(string $id)
    {
        //
    }
}
