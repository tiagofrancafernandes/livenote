<?php

namespace App\Http\Livewire;

use App\Models\Contact as ContactModel;

use Livewire\Component;

class Contact extends Component
{
    public $data, $name, $email, $selected_id;
    public $updateMode = false;

    public function mount($id = null)
    {
        if($id)
            $this->edit($id);

        // if($id)
        //     $this->updateMode = true;

        // if($id)
        //     $this->selected_id = $id;

    }

    public function render($id = null)
    {
        $this->data = ContactModel::all();
        return view('livewire.contact')->layout('layouts.app2');
    }

    private function resetInput()
    {
        $this->name = null;
        $this->email = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:5',
            'email' => 'required|email:rfc,dns'
        ]);
        ContactModel::create([
            'name' => $this->name,
            'email' => $this->email
        ]);
        $this->resetInput();
    }

    public function edit($id)
    {
        $record = ContactModel::find($id);

            if(!$record)
            {
                session()->flash('error', 'Contact not found');
                return redirect(route('contacts.index'));
            }
            else
            {
                $this->selected_id = $id;
                $this->name        = $record->name;
                $this->email       = $record->email;
                $this->updateMode  = true;
            }
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'name' => 'required|min:5',
            'email' => 'required|email:rfc,dns'
        ]);
        if ($this->selected_id) {
            $record = ContactModel::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'email' => $this->email
            ]);
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function confirm($callback, ...$argv)
    {
        $this->emit('confirm', compact('callback', 'argv'));
    }

    public function destroy($id)
    {
        if ($id) {
            $record = ContactModel::where('id', $id);
            $record->delete();
        }
    }
}
