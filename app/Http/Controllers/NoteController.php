<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    //TODO fazer aqui a listagem das notas
    public function index(Request $request, $id = null)
    {
        return view('notes.notes', [
            'id' => $id,
        ]);
    }

    public function show(Request $request, $id = null)
    {
        return view('notes.notes', [
            'id' => $id,
        ]);
    }

    public function uikit()
    {
        return view('uikit_note.note', [
            'note' => Note::first(),
        ]);
    }
}
