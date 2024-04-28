<?php

namespace App\Http\Controllers\DataEntry;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Grade;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;

class GradeBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $grades = Grade::all();
        $grade = Grade::find($id);
        return view('data-entry.books.index', compact('grades', 'grade'));
    }
}
