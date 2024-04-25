<?php

namespace App\Http\Controllers\Administration\Data;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Comprehension;
use App\Models\Grade;
use App\Models\Mcq;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Subtype;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($bookId, $chapterId)
    {
        //
        $book = Book::find($bookId);
        $chapter = Chapter::find($chapterId);
        $questions = Question::where('book_id', $bookId)
            ->where('chapter_no', $chapter->chapter_no)
            ->get();
        return view('administration.data.questions.index', compact('book', 'chapter', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($bookId, $chapterId)
    {
        //
        $book = Book::find($bookId);
        $chapter = Chapter::find($chapterId);
        $questions = Question::where('book_id', $bookId)
            ->where('chapter_no', $chapter->chapter_no)
            ->get();

        $types = Type::all();
        $subtypes = $book->subtypes(1); //objectives
        return view('administration.data.questions.create', compact('book', 'chapter', 'questions', 'types', 'subtypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $bookId, $chapterId)
    {
        //
        $request->validate([
            'chapter_no' => 'required|numeric',
            'exercise_no' => 'nullable|numeric',
            'statement' => 'required',
            'marks' => 'required|numeric',
            'bise_frequency' => 'required|numeric',
            'is_conceptual' => 'required|boolean',
            'type_id' => 'required',
        ]);

        $book = Book::find($bookId);
        $chapter = Chapter::find($chapterId);
        $request->merge([
            'book_id' => $bookId,
            'is_approved' => false,
            'user_id' => Auth::user()->id,
        ]);

        DB::beginTransaction();

        try {
            $subtype = Subtype::find($request->subtype_id);

            $question = Question::create([
                'user_id' => Auth::user()->id,
                'book_id' => $bookId,
                'type_id' => $request->type_id,
                'subtype_id' => $request->subtype_id,
                'chapter_no' => $chapter->chapter_no,
                'marks' => $request->marks,

                'statement' => $request->statement,
                'exercise_no' => $request->exercise_no,
                'is_conceptual' => $request->is_conceptual,
                'bise_frequency' => $request->bise_frequency,
                'is_approved' => false,
            ]);

            // mcqs
            if ($subtype->tagname == 'mcq') {
                $correct = '';
                if ($request->check_a) $correct = 'a';
                if ($request->check_b) $correct = 'b';
                if ($request->check_c) $correct = 'c';
                if ($request->check_d) $correct = 'd';

                $question->mcq()->create([
                    'choice_a' => $request->choice_a,
                    'choice_b' => $request->choice_b,
                    'choice_c' => $request->choice_c,
                    'choice_d' => $request->choice_d,
                    'correct' => $correct,
                ]);
            }

            // paraphrasing
            if ($subtype->tagname == 'paraphrasing') {
                foreach ($request->poetry_lines as $poetry_line) {
                    if ($poetry_line != '')
                        $question->paraphrasings()->create([
                            'poetry_line' => $poetry_line,
                        ]);
                }
            }

            //comprehension
            if ($subtype->tagname == 'comprehension') {
                foreach ($request->sub_questions as $subQuestion) {
                    if ($subQuestion != '')
                        $question->comprehensions()->create([
                            'sub_question' => $subQuestion,
                        ]);
                }
            }

            // commit if all ok
            DB::commit();
            return redirect()->back()->with(
                [
                    'type_id' => $request->type_id,
                    'subtype_id' => $request->subtype_id,
                    'marks' => $request->marks,
                    'exercise_no' => $request->exercise_no,
                    'bise_frequency' => $request->bise_frequency,
                    'is_conceptual' => $request->is_conceptual,
                    'subtypes' => $book->subtypes($request->type_id),
                    'success' => 'Successfully added',
                ]
            );
            // return redirect()->route('admin.book.chapter.questions.index', [$bookId, $chapterId])->with('success', 'Successfully added');;
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($bookId, $chapterId, $questionId)
    {
        //
        $book = Book::find($bookId);
        $chapter = Chapter::find($chapterId);
        $question = Question::find($questionId);
        return view('administration.data.questions.show', compact('book', 'chapter', 'question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($bookId, $chapterId, $questionId)
    {
        //
        $book = Book::find($bookId);
        $chapter = Chapter::find($chapterId);
        $question = Question::find($questionId);
        return view('administration.data.questions.edit', compact('book', 'chapter', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $bookId, $chapterId, $questionId)
    {
        //
        $request->validate([
            'chapter_no' => 'required|numeric',
            'exercise_no' => 'nullable|numeric',
            'statement' => 'required',
            'marks' => 'required|numeric',
            'bise_frequency' => 'required|numeric',
            'is_conceptual' => 'required|boolean',
        ]);

        $question = Question::find($questionId);

        DB::beginTransaction();

        try {
            $question->update([
                'marks' => $request->marks,
                'statement' => $request->statement,
                'exercise_no' => $request->exercise_no,
                'is_conceptual' => $request->is_conceptual,
                'bise_frequency' => $request->bise_frequency,
            ]);

            // mcqs
            if ($question->type->name == 'Objective') {
                $correct = '';
                if ($request->check_a) $correct = 'a';
                if ($request->check_b) $correct = 'b';
                if ($request->check_c) $correct = 'c';
                if ($request->check_d) $correct = 'd';

                $question->mcq()->update([
                    'choice_a' => $request->choice_a,
                    'choice_b' => $request->choice_b,
                    'choice_c' => $request->choice_c,
                    'choice_d' => $request->choice_d,
                    'correct' => $correct,
                ]);
            }

            // paraphrasing
            // if ($question->subtype->tagname == 'paraphrasing') {
            //     foreach ($request->poetry_lines as $poetry_line) {
            //         if ($poetry_line != '')
            //             $question->paraphrasings()->update([
            //                 'poetry_line' => $poetry_line,
            //             ]);
            //     }
            // }

            // //comprehension
            // if ($question->subtype->tagname == 'comprehension') {
            //     foreach ($request->sub_questions as $subQuestion) {
            //         if ($subQuestion != '')
            //             $question->comprehensions()->update([
            //                 'sub_question' => $subQuestion,
            //             ]);
            //     }
            // }

            // commit if all ok
            DB::commit();
            return redirect()->back()->with(
                [
                    'success' => 'Successfully updated',
                ]
            );
            // return redirect()->route('admin.book.chapter.questions.index', [$bookId, $chapterId])->with('success', 'Successfully added');;
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bookId, $chapterId, $questionId)
    {
        //
        try {
            $question = Question::find($questionId);
            $question->delete();
            return redirect()->back()->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
