<?php

namespace App\Http\Controllers\Administration\Qbank;

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
        return view('administration.qbank.books.index', compact('grades', 'grade'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($gradeId)
    {
        //
        $grade = Grade::find($gradeId);
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('administration.data.books.create', compact('grades', 'subjects', 'grade'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'grade_id' => 'nullable|numeric',
            'subject_id' => 'required|numeric',
        ]);

        try {
            Book::create($request->all());
            return redirect()->route('admin.books.index')->with('success', 'Successfully added');;
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $book = Book::find($id);
        return view('administration.grade.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $gradeId, $bookId)
    {
        //
        $book = Book::find($bookId);
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('administration.qbank.books.edit', compact('book', 'grades', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'grade_id' => 'nullable|numeric',
            'subject_id' => 'required|numeric',
        ]);

        try {
            $book = Book::find($id);
            $book->update($request->all());
            return redirect()->route('admin.grade.books.index', $book->grade)->with('success', 'Successfully updated!');;
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($gradeId, $bookId)
    {
        //
        $book = Book::find($bookId);
        $grade = $book->grade;
        try {
            $book->delete();
            return redirect()->route('admin.grade.books.index', compact('grade'))->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
