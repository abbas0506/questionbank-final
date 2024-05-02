<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        //
        // $grades = Grade::all();
        // $questions = Question::all();

        // $bookIds = Book::where('subject_id', Auth::user()->teacher->subject_id)->pluck('id');
        // // $questions = Question::whereIn('book_id', $bookIds)->where('is_approved', false)->get();
        // $subject = Auth::user()->teacher->subject;
        // $subjects = Subject::with(['books.questions' => function ($query) {
        //     $query->where('is_approved', true);
        // }])->where('id', Auth::user()->teacher->subject_id)
        //     ->get();


        // $subjects = Subject::with(['books' => function ($book) {
        //     $book->with(['questions' => function ($question) {
        //         $question->where('is_approved', true);
        //     }])->where('grade_id', 2);
        // }])->where('id', Auth::user()->teacher->subject_id)
        //     ->get();

        $subjectId = Auth::user()->teacher->subject_id;

        $questions = Question::whereRelation('chapter', function ($query) use ($subjectId) {
            $query->whereRelation('book', function ($query) use ($subjectId) {
                $query->where('subject_id', $subjectId);
            });
        })->get();


        // $questions = Auth::user()->teacher->subjectRelatedQuestions();
        // foreach ($subjects as $subject) {
        //     foreach ($subject->books as $book) {
        // echo $book->questions->count() . "<br>";
        // echo $questions->count();
        // foreach ($questions as $question) {
        //     echo $question->statement . "<br>";
        // }
        //     }
        // }

        // foreach ($questions->get() as $question) {
        //     echo $question->statement . "<br>";
        // }
        return view('collaborator.dashboard', compact('questions'));
    }
}
