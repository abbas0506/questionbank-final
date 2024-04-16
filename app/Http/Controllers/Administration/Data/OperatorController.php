<?php

namespace App\Http\Controllers\DataManagement;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    //
    public function index()
    {
        $questions = Question::all();
        return view('data-management.index');
    }
}
