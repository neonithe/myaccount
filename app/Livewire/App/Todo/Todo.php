<?php

namespace App\Livewire\App\Todo;

use App\Models\todo\TodoState;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Todo extends Component
{
    Use WithPagination;
    public $pages = 8;

    public $todo, $remind_date, $link, $comment, $repeat, $time;
    public $setPrio = false;
    public $search;

    public function resetAll() {
        $this->remind_date = null; $this->setPrio = false; $this->todo = null;
        $this->dispatch('update-todo-count');
    }

    public function addTodo() {
        $this->validate([
            'todo'  =>  'required'
        ]);
        \App\Models\todo\Todo::create([
            'user_id'     => Auth::id(),
            'todo'        => $this->todo,
            'remind_date' => ($this->repeat != null) ? null : $this->remind_date,
            'comment'     => $this->comment,
            'link'        => $this->link,
            'notice'      => $this->setPrio,
            'repeat'      => ($this->remind_date != null) ? null : $this->repeat,
            'remind_time' => $this->time,
        ]);
        $this->resetAll();
    }

    public function inputAddTodo($value) {
        $this->validate([
            'todo'  =>  'required'
        ]);
        \App\Models\todo\Todo::create([
            'user_id'     => Auth::id(),
            'todo'        => $this->todo,
            'remind_date' => ($this->repeat != null) ? null : $this->remind_date,
            'comment'     => $this->comment,
            'link'        => $this->link,
            'notice'      => $this->setPrio,
            'repeat'      => ($this->remind_date != null) ? null : $this->repeat,
            'remind_time' => $this->time,
        ]);
        $this->resetAll();
    }

    public function todoCheck($id) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        if ($data->done == false) {
            if ($data->repeat != null) {
                // Fånga och formatera nuvarande remind_date från databasen
                $currentReminderDate = Carbon::createFromFormat('Y-m-d', $data->repeat);

                // Lägg till en månad till nuvarande remind_date
                $newReminderDate = $currentReminderDate->addMonth();

                // Uppdatera remind_date med det nya datumet
                $data->repeat = $newReminderDate->format('Y-m-d');
            } else {
                $data->done = true;
            }
            $data->done_date = date('Y-m-d');
        } else {
            $data->done = false;
            $data->done_date = null;
        }

        $data->save();
    }

    public function changeRepeat($id, $value) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        $data->repeat = $value;
        $data->save();
    }

    public function changeTime($id, $value) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        $data->remind_time = $value;
        $data->save();
    }

    public function changeToDo($id, $value) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        $data->todo = $value;
        $data->save();
    }

    public function changeLinkToDo($id, $value) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        $data->link = $value;
        $data->save();
    }

    public function changeCommentToDo($id, $value) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        $data->comment = $value;
        $data->save();
    }

    public function setPrioToggle() {
        ($this->setPrio == false) ? $this->setPrio = true : $this->setPrio = false;
    }

    public function changeRemDate($id, $value) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        $data->remind_date = $value;
        $data->save();
    }

    public function deleteTodo($id) {
        \App\Models\todo\Todo::findOrFail($id)->delete();
    }

    public function removeDate($id) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        $data->remind_date = null;
        $data->save();
    }

    public function removeRepeat($id) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        $data->repeat = null;
        $data->save();
    }

    public function removeTime($id) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        $data->remind_time = null;
        $data->save();
    }

    /** States ********************************************************************************************************/
    public function toggleState($id, $type) {
        $data = \App\Models\todo\Todo::findOrFail($id);
        switch ($type) {
            case 'prio': ($data->notice == false) ? $data->notice = true : $data->notice = false; break;
            case 'pause': ($data->paused == false) ? $data->paused = true : $data->paused = false; break;
            case 'meeting': ($data->meeting == false) ? $data->meeting = true : $data->meeting = false; break;
            case 'contact': ($data->contact == false) ? $data->contact = true : $data->contact = false; break;
        }
        $data->save();
        $this->dispatch('update-todo-count');
    }

    public function resetTodoList() {
        $this->paused = false; $this->prio = false; $this->remind = null;
        $this->regular = null; $this->meeting = null; $this->contact = null;
    }

    public function showListByFilter($type) {
        $this->resetTodoList();
        switch ($type) {
            case 'prio': $this->prio = true; break;
            case 'paused': $this->paused = true; break;
            case 'remind': $this->remind = true; break;
            case 'regular': $this->regular = true; break;
            case 'contact': $this->contact = true; break;
            case 'meeting': $this->meeting = true; break;
        }
        $this->render();
    }

    public function getCount() {
        $this->allCount     = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->count();
        $this->pausedCount  = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('paused', true)->count();
        $this->prioCount    = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('notice', true)->count();
        $this->contactCount = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('contact', true)->count();
        $this->meetingCount = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('meeting', true)->count();
        $this->remindCount  = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)
            ->where(function ($query) {
                $query->whereNotNull('remind_date')
                      ->orWhereNotNull('repeat');})->count();
        $this->regularCount = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)
            ->whereNull('remind_date')
            ->where('notice', false)
            ->where('paused', false)
            ->count();
        $this->doneCount = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', true)->count();

    }

    public $paused = false, $prio = false, $remind = null, $regular = true, $meeting = false, $contact = false;
    public $pausedCount, $prioCount, $remindCount, $regularCount, $allCount, $meetingCount, $contactCount, $doneCount;

    public function test() {
        dd(\App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('contact', true)->count(), $this->contactCount);
    }

    public function render()
    {
        $this->getCount();
        foreach (\App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->get() as $todo) {
            if ($todo->remind_date == date('Y-m-d')) {
                $todo->notice = true;
                $todo->save();
            }
        }

        $query = \App\Models\todo\Todo::where('user_id', Auth::id())
            ->where('done', false);

        // Sökning
        if ($this->search) {
            $query->where('todo', 'like', '%' . $this->search . '%');
        }

        // Sortera så att poster med 'notice' = true kommer först
        $query->orderByRaw('`notice` DESC');

        if ($this->paused) {$query->where('paused', $this->paused);}
        if ($this->prio) { $query->where('notice', $this->prio); }
        if ($this->meeting) { $query->where('meeting', $this->meeting); }
        if ($this->contact) { $query->where('contact', $this->contact); }
        if ($this->remind) {$query->where(function ($query) {
                    $query->whereNotNull('remind_date')
                        ->orWhereNotNull('repeat');})->get();
        }
        if ($this->regular) { $query->whereNull('remind_date')->where('notice', false)->where('paused', false); }

        // Paginering
        $searchResult = $query->get();

        $reminder1 = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->whereNotNull('remind_date');
        $reminder2 = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->whereNotNull('repeat');

        return view('livewire.app.todo.todo',[
            'openTodos' => $searchResult,
            'prioTodos' => \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('notice', true)->get(),
            'doneTodos' => \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', true)->paginate($this->pages),
        ])->layout('layouts.app');
    }
}
