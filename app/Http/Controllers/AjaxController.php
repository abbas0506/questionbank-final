<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Subtype;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function fetchSubtypesByTypeId(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'book_id' => 'required',
        ]);
        $book = Book::find($request->book_id);

        $text = '';

        $subtypes = $book->subtypes($request->type_id);

        foreach ($subtypes as $subtype) {
            $text .= "<option value='" . $subtype->id . "'>" . $subtype->name . "</option>";
        }

        return response()->json([
            'options' => $text,
        ]);
    }
}
