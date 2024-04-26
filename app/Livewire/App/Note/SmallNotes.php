<?php

namespace App\Livewire\App\Note;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function Livewire\Volt\mount;

class SmallNotes extends Component
{

    public $name, $note, $firstpage = false;
    public $showNote;

    public function mount() {
        $this->showNote = Note::where('user_id', Auth::id())->where('firstpage', true)->first();
    }

    public function toggleFirstpage() {
        ($this->firstpage) ? $this->firstpage = false : $this->firstpage = true;
    }

    public function setSelected($id) {
        if ($id) {
            $list = Note::where('user_id', Auth::id())->get();
            foreach ($list as $item) {
                $item->firstpage = false;
                $item->save();
            }
            $note = Note::findOrFail($id);
            $note->firstpage = true;
            $note->save();
            $this->mount();
        }
        $this->dispatch('successmessage', 'Note', 'Note selected successfully.');
    }

    public function saveNote() {

        if (Note::where('user_id', Auth::id())->count() == 0) { $this->firstpage = true; }

        $this->validate(['name'=>'required']);

        Note::create([
            'user_id'   =>  Auth::id(),
            'name'      =>  $this->name,
            'note'      =>  $this->note,
            'firstpage' =>  $this->firstpage
        ]);
        $this->name = null; $this->note = null; $this->firstpage = false;
        $this->mount();
        $this->dispatch('successmessage', 'Note', 'Note created successfully.');
    }

    public function deleteNote($id) {
        $data = Note::findOrFail($id);
        if ($data->firstpage == false) {
            $data->delete();
            $this->render();
            $this->dispatch('successmessage', 'Note', 'Note deleted successfully.');
        }
        $this->dispatch('successmessage', 'Note', 'Note cannot be deleted, cannot be a selected note.', true);
    }

    public function changeNote($id, $type, $value) {
        $data = Note::findOrFail($id);
        $data->$type = $value;
        $data->save();
        $this->dispatch('successmessage', 'Note', 'Note change successfully.');
    }

    public function render()
    {
        return view('livewire.app.note.small-notes',[
            'notes'     =>  Note::where('user_id', Auth::id())->get(),
        ])->layout('layouts.app');
    }
}
