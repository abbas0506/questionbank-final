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
        $grade = Grade::find($id);
        $books = $grade->books;
        return view('data-entry.books.index', compact('grade'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $grade = Grade::find($id);
        $subjects = Subject::all();
        return view('data-entry.books.create', compact('grade', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'grade_id' => 'nullable|numeric',
            'subject_id' => 'required|numeric',
        ]);
        $grade = Grade::find($id);
        try {
            Book::create($request->all());
            return redirect()->route('operator.grade.books.index', $grade)->with('success', 'Successfully added');;
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
        return view('data-entry.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book = Book::find($id);
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('data-entry.books.edit', compact('book', 'grades', 'subjects'));
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
            return redirect()->route('admin.books.index')->with('success', 'Successfully updated!');;
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book = Book::find($id);
        try {
            $book = Book::find($id);
            $book->delete();
            return redirect()->back()->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
