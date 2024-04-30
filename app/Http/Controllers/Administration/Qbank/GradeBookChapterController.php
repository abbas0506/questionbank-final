<?php

namespace App\Http\Controllers\Administration\Qbank;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeBookChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($gradeId, $bookId)
    {
        //
        $grades = Grade::all();
        $grade = Grade::find($gradeId);
        if ($bookId)
            $book = Book::find($bookId);
        else
            $book = $grade->books->first();
        return view('administration.qbank.chapters.index', compact('grades', 'grade', 'book'));
    }
}
