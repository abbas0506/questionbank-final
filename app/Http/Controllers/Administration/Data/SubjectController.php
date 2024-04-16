<?php

namespace App\Http\Controllers\Administration\Data;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subjects = Subject::all();
        return view('administration.data.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('administration.data.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name_en' => 'required',
            'name_ur' => 'required',
            'is_language' => 'boolean|required',
            'display_order' => 'required',
        ]);

        try {
            Subject::create($request->all());
            return redirect()->route('admin.subjects.index')->with('success', 'Successfully added');;
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
        $subject = Subject::find($id);
        return view('administration.data.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $subject = Subject::find($id);
        return view('administration.data.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name_en' => 'required',
            'name_ur' => 'required',
            'is_language' => 'boolean|required',
            'display_order' => 'required',
        ]);

        try {
            $subject = Subject::find($id);
            $subject->update($request->all());
            return redirect()->route('admin.subjects.index')->with('success', 'Successfully updated!');;
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
        $subject = Subject::find($id);
        try {
            $subject = Subject::find($id);
            $subject->delete();
            return redirect()->back()->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
