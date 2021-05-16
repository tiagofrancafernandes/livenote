<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ContactController, 
    NoteController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('contacts/{id?}', [ContactController::class, 'index'])->name('contacts.index');
Route::get('notes/{user_id?}', [NoteController::class, 'index'])->name('notes.index');
Route::get('note/{id?}', [NoteController::class, 'show'])->name('notes.show');
Route::get('uikit', [NoteController::class, 'uikit'])->name('note.uikit');