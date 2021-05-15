<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request, $id = null)
    {
        return view('notes.notes', [
            'id' => $id,
        ]);
    }
}
