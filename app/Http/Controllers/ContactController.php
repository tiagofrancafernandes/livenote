<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request, $id = null)
    {
        return view('users.contacts', [
            'id' => $id,
        ]);
    }
}
