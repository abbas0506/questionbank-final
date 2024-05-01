<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        //
        $grades = Grade::all();
        $questions = Question::all();
        $grade = Grade::find(2);

        return view('operator.dashboard', compact('grades', 'questions'));
    }
}
