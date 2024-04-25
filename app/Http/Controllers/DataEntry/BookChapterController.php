<?php

namespace App\Http\Controllers\DataEntry;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Chapter;
use Exception;
use Illuminate\Http\Request;

class BookChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($bookId)
    {
        //
        $book = Book::find($bookId);
        return view('data-entry.chapters.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($bookId)
    {
        //
        $book = Book::find($bookId);
        return view('data-entry.chapters.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $bookId)
    {
        //
        $request->validate([
            'name' => 'required',
            'chapter_no' => 'required|numeric',
        ]);

        $request->merge(['book_id' => $bookId]);

        try {
            Chapter::create($request->all());
            return redirect()->route('operator.book.chapters.index', $bookId)->with('success', 'Successfully added');;
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($bookId, string $id)
    {
        //
        $book = Book::find($bookId);
        $chapter = Chapter::find($id);
        return view('data-entry.chapters.edit', compact('book', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $bookId, $chapterId)
    {
        //
        $request->validate([
            'name' => 'required',
            'chapter_no' => 'required|numeric',
        ]);

        $chapter = Chapter::find($chapterId);

        try {
            $chapter->update($request->all());
            return redirect()->route('operator.book.chapters.index', $bookId)->with('success', 'Successfully updated');;
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bookId, string $id)
    {
        //
        $chapter = Chapter::find($id);
        try {
            $chapter->delete();
            return redirect()->back()->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
