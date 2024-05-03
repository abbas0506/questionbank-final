<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Grade;
use App\Models\Paper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $grades = Grade::all();
        return view('collaborator.papers.index', compact('grades'));
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
            'paper_date' => 'required|date',
            'title' => 'required|max:255',
            'chapter_ids_array' => 'required',
        ]);



        try {
            $user = Auth::user();
            $paper = $user->papers()->create([
                'paper_date' => $request->paper_date,
                'title' => $request->title,
            ]);

            $chapterIdsArray = array();
            $chapterIdsArray = $request->chapter_ids_array;
            // $chapters = Chapter::whereIn('id', $chapterIdsArray)->get();
            session([
                'chapterIdsArray' => $chapterIdsArray,
            ]);
            return redirect()->route('collaborator.papers.show', $paper);
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
        $paper = Paper::find($id);
        return view('collaborator.papers.show', compact('paper'));
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
    public function destroy(string $id)
    {
        //
    }
}
