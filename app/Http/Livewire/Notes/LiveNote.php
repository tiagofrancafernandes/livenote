<?php

namespace App\Http\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;

use Auth;
use Arr;
use Str;

class LiveNote extends Component
{
    public $edit         = true;
    public $note_content = "";
    public $encrypted    = false;

    public $note;
    public $title;
    public $original_title;

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->init($this->note);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'title'  => 'required|min:3',
        ]);
    }

    public function render()
    {
        // return view('livewire.notes.live-note', [
        //     'note'         => $this->note,
        //     'note_content' => $this->note_content,
        // ])->layout('uikit_note.note');

        return view('livewire.notes.live-note')->layout('layouts.app2');
    }

    public function restoreOriginalValues()
    {
        $this->title     = $this->original_title;
    }

    public function editNote()
    {
        $this->edit = $this->edit ? false : true;
    }

    public function cancelEditNote()
    {
        if($this->edit)
        {
            $this->edit = false;
            $this->restoreOriginalValues();
        }
    }

    public function saveEditedNote()
    {
        $this->validate([
            'title'  => 'required|min:3',
        ]);

        $new_data = [];

        if($this->title != $this->original_title)
            $new_data = array_merge($new_data, ['title' =>  $this->title]);

        if(count($new_data) > 0)
        {
            $note_was_updated = $this->note->update($new_data);

            if($note_was_updated)
            {
                $this->original_title  = $this->note->title;
                $this->init($this->note);
            }

        }

        $this->cancelEditNote();
    }

    private function init($note)
    {
        $this->note      = $note;
        $this->encrypted = !! $note->encrypted;
        $this->title     = $note->title ?? $this->original_title;

        $this->updateNoteContent($note);
    }

    private function updateNoteContent(Note $note)
    {
        //TODO colocar ou chamar lógica de decriptação aqui
        $note_content = $note->note;

        $this->note_content = $note_content;
    }
}
