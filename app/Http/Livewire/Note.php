<?php

namespace App\Http\Livewire;

use App\Models\Note as NoteModel;

use Livewire\Component;
use Illuminate\Support\Facades\Config;
use Str;

class Note extends Component
{
    public $data, $title, $note, $selected_id, $original_title, $original_note;
    public $updateMode             = false;
    public $need_confirm_to_delete = true;
    public $need_confirm_to_reset  = true;

    //TODO mudar de id para slug
    public function mount($id = null)
    {
        $this->need_confirm_to_delete = Config::get('notes.confirm_to_delete', true);
        $this->need_confirm_to_reset  = Config::get('notes.confirm_to_reset', true);

        if($id)
            $this->edit($id);

        // if($id)
        //     $this->updateMode = true;

        // if($id)
        //     $this->selected_id = $id;

    }

    public function render($id = null)
    {
        $this->data = NoteModel::orderBy('id', 'DESC')->get();//TODO usar o paginate do livewire
        return view('notes.note')->layout('layouts.app2');
    }

    public function resetInput()
    {
        $this->title = $this->original_title ?? null;
        $this->note  = $this->original_note ?? null;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:5',
            'note'  => 'required|min:3'
        ]);

        $slug = Str::slug($this->title);

        $new_note = NoteModel::create([
            'title' => $this->title,
            'note'  => $this->note,
            '$slug' => $slug,
        ]);

        if($new_note)
        {
            $this->original_title   = $this->title  ?? null;
            $this->original_note    = $this->note   ?? null;

            if($new_note->id)
                $this->updateMode = true;

            if($new_note->id)
                $this->selected_id = $new_note->id;

            $this->edit($new_note->id);
        }

        // $this->resetInput();
    }

    public function edit($id)
    {
        $record = NoteModel::find($id);

            if(!$record)
            {
                session()->flash('error', 'Note not found');
                return redirect(route('notes.index'));
            }
            else
            {
                $this->selected_id = $id;
                $this->title       = $this->original_title   = $record->title;
                $this->note        = $this->original_note    = $record->note;
                $this->updateMode  = true;
            }
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'title'       => 'required|min:5',
            'note'        => 'required|min:3'
        ]);

        if ($this->selected_id)
        {
            $record   = NoteModel::find($this->selected_id);

            if(!$record)
            {
                session()->flash('error', 'Note not found');
                return redirect(route('notes.index'));
            }

            $updated = $record->update([
                'title' => $this->title,
                'note' => $this->note
            ]);

            if($updated)
            {
                $this->original_title   = $this->title  ?? null;
                $this->original_note    = $this->note   ?? null;
                session()->flash('success', 'Note updated successfuly');
            }

            // $this->resetInput();

            // $this->updateMode = false;
        }
    }

    public function confirm($callback, string $message = null,  ...$argv)
    {
        $this->emit('confirm', compact('callback', 'message', 'argv'));
    }

    public function destroy($id)
    {
        if ($id) {
            $record = NoteModel::where('id', $id);
            $record->delete();
        }
    }
}
