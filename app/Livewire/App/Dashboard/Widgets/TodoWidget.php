<?php

namespace App\Livewire\App\Dashboard\Widgets;

use App\Models\econmony\CryptoInvestment;
use App\Models\econmony\Expense;
use App\Models\econmony\Income;
use App\Models\Settings;
use App\Models\todo\Todo;
use App\Models\workout\Workout;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TodoWidget extends Component
{
    use WithPagination;
    public $items = 10;

    // Show private or regular todos
    public $private = false;
    public $settings;
    public $dayName;
    public $cryptoList = [];

    // Set add new
    public $setPrivate, $setMeeting, $setContact, $setPrio, $setPause;
    public $todo, $comment, $link, $repeat, $remind_date, $remind_time, $remind_day;
    public $sliderListAddTodo = false;

    // List
    public $filterType, $filterPrivate, $search;

    // Edit
    public $showModal = false;
    public $sliderShow = false;
    public $tempTodo;


    public function mount() {
        $this->settings = Settings::where('user_id', Auth::id())->first();
        $this->private = $this->settings->private;
    }

    public function resetValues() {
        $this->setPrivate = false;  $this->setMeeting = false;  $this->setContact = false;  $this->setPrio = false;
        $this->setPause = false;    $this->todo = null;         $this->comment = null;      $this->link = null;
        $this->remind_day = null;   $this->remind_time = null;  $this->remind_date = null;  $this->repeat = null;
        $this->tempTodo = null;
    }

    /** Check TODO's **************************************************************************************************/
    public function checkTodo($id) {
        $todo = Todo::findOrFail($id);
        ($todo->done) ? $todo->done = false : $todo->done = true;
        $todo->done_date = date('Y-m-d');
        $todo->save();
        $this->dispatch('successmessage', 'Greate work', 'One more todo done!!');
    }

    public function returnTodo($id) {
        $todo = Todo::findOrFail($id);
        $todo->done = false;
        $todo->save();
        $this->dispatch('successmessage', 'Return todo', 'Todo returned successfully.');
    }

    public function deleteTodo($id, $slideDelete) {
        if (!$slideDelete) {
            Todo::findOrFail($id)->delete();
            $this->dispatch('successmessage', 'Todo', 'Todo deleted successfully.');
        } else {
            Todo::findOrFail($id)->delete();
            $this->dispatch('successmessage', 'Todo', 'Todo deleted successfully.');
            $this->closeEditModal();
        }
    }

    /** Add new *******************************************************************************************************/
    public function openListAdd() {
        $this->resetValues();
        $this->sliderListAddTodo = true;
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
            'meeting'     => $this->setMeeting,
            'contact'     => $this->setContact,
            'private'     => $this->setPrivate,
            'paused'      => $this->setPause,

            'repeat'      => ($this->remind_date != null) ? null : $this->repeat,
            'remind_time' => $this->remind_time,
            'remind_day'  => $this->remind_day,
        ]);
        $this->resetValues();
        $this->dispatch('successmessage', 'Todo', 'Todo created successfully.');
    }

    public function toggleStates($type) {
        if ($type == 'contact') {
            ($this->setContact == false) ? $this->setContact = true : $this->setContact = false;
        } else if ($type == 'meeting') {
            ($this->setMeeting == false) ? $this->setMeeting = true : $this->setMeeting = false;
        } else if ($type == 'private') {
            ($this->setPrivate == false) ? $this->setPrivate = true : $this->setPrivate = false;
        } else if ($type == 'pause') {
            ($this->setPause == false) ? $this->setPause = true : $this->setPause = false;
        } else {
            ($this->setPrio == false) ? $this->setPrio = true : $this->setPrio = false;
        }
    }

    /** Edit / Update *************************************************************************************************/
    public function openEditModal($id, $open) {
        $this->resetValues();
        $this->showModal = $open;

        $this->tempTodo     = Todo::findOrFail($id);
        $this->todo         = $this->tempTodo->todo;
        $this->comment      = $this->tempTodo->comment;
        $this->remind_date  = $this->tempTodo->remind_date;
        $this->remind_day   = $this->tempTodo->remind_day;
        $this->remind_time  = $this->tempTodo->remind_time;
        $this->repeat       = $this->tempTodo->repeat;
        $this->link         = $this->tempTodo->link;

        $this->setPause     = $this->tempTodo->paused;
        $this->setPrio      = $this->tempTodo->notice;
        $this->setPrivate   = $this->tempTodo->private;
        $this->setMeeting   = $this->tempTodo->meeting;
        $this->setContact   = $this->tempTodo->contact;
    }

    public function updateTodo() {
        $this->tempTodo->todo           = $this->todo;
        $this->tempTodo->comment        = $this->comment;
        $this->tempTodo->remind_date    = $this->remind_date;
        $this->tempTodo->remind_day     = $this->remind_day;
        $this->tempTodo->remind_time    = $this->remind_time;
        $this->tempTodo->repeat         = $this->repeat;
        $this->tempTodo->link           = $this->link;

        $this->tempTodo->paused     = $this->setPause;
        $this->tempTodo->private    = $this->setPrivate;
        $this->tempTodo->meeting    = $this->setMeeting;
        $this->tempTodo->contact    = $this->setContact;
        $this->tempTodo->notice     = $this->setPrio;

        $this->tempTodo->save();
        $this->resetValues();
        $this->dispatch('successmessage', 'Todo', 'Todo changed successfully.');
        $this->closeEditModal();
    }

    public function closeEditModal() {
        $this->showModal = false;
        $this->sliderShow = false;
        $this->resetValues();
    }

    /** Show Todo's ***************************************************************************************************/
    public function showTodo($id) {
        $this->sliderShow = true;
        $this->openEditModal($id, false);
    }

    /** Search ********************************************************************************************************/
    public function searchAndFilter() {
        $query = Todo::where('user_id', Auth::id());
        if ($this->search) {
            $query->where('todo', 'like', '%' . $this->search . '%');
        }
        if ($this->filterType) {
            if ($this->filterType == 'remind_date') {
                $query->whereNotNull('remind_date');
            } elseif ($this->filterType == 'repeat') {
                $query->whereNotNull('repeat');
            } else {
                $query->where($this->filterType, true);
            }
        }
        if ($this->filterPrivate) {
            $query->where('private', true);
        }
        return $query;
    }

    /** Get Todos *****************************************************************************************************/
    public function getTodos($type) {
        if ($type == 'meeting') {
            return Todo::where('user_id', Auth::id())
                ->where($type, true)
                ->where('done', false)
                ->orderByRaw("FIELD(remind_day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
                ->get();
        } else if($type == 'todo') {
            return Todo::where('user_id', Auth::id())
                ->where('done', false)
                ->whereNull('remind_date')
                ->whereNull('repeat')
                ->where('notice', false)
                ->where('paused', false)
                ->where('contact', false)
                ->where('meeting', false)->get();
        } else {
            return Todo::where('user_id', Auth::id())->where($type, true)->where('done', false)->get();
        }
    }

    public function getTodoReminders() {
        return Todo::where('user_id', Auth::id())->where('done', false)->whereNotNull('remind_date')->get();
    }
    public function getTodoRepeat() {
        return Todo::where('user_id', Auth::id())->where('done', false)->whereNotNull('repeat')->get();
    }

    public function repeatCheck($id) {
        $data = Todo::findOrFail($id);
        if ($data->repeat != null) {

            // Fånga och formatera nuvarande remind_date från databasen
            $currentReminderDate = Carbon::createFromFormat('Y-m-d', $data->repeat);

            // Lägg till en månad till nuvarande remind_date
            $newReminderDate = $currentReminderDate->addMonth();

            // Uppdatera remind_date med det nya datumet
            $data->repeat = $newReminderDate->format('Y-m-d');
            $data->save();
        }
    }

    public function getDaysTo($date) {
        $date = Carbon::parse($date);
        return number_format(Carbon::now()->diffInDays($date, false), 0, ',', ' ');
    }

    public function showDone() {
        ($this->filterType == 'done') ? $this->filterType = null : $this->filterType = 'done';
        $this->closeEditModal();
    }

    public function showList() {
        $this->filterType = null;
        $this->closeEditModal();
    }

    /** Crypto ********************************************************************************************************/
    public function calc()
    {

        $client = new Client();

        // Hämta växelkursen USD till SEK
        $response = $client->get('https://api.coingecko.com/api/v3/simple/price?ids=usd&vs_currencies=sek');
        $data = json_decode($response->getBody()->getContents(), true);

        // Hämta priset på BTC och XRP i USD
        $response = $client->get('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ripple,ethereum&vs_currencies=usd');
        $prices = json_decode($response->getBody()->getContents(), true);

        $this->cryptoList = [
            'usdToSek'=>$data['usd']['sek'],  // Hämta kursen för USD till SEK
            'btc'=>$prices['bitcoin']['usd'], // Sätt kursen för bitcoin i USD
            'xrp'=>$prices['ripple']['usd'],  // Sätt kursen för ripple i USD
            'eth'=>$prices['ethereum']['usd'],// Sätt kursen för ethereum i USD
        ];

    }

    /** Budget ********************************************************************************************************/
    public function getTotalIncomeSum() {
        return Income::where('user_id', Auth::id())->sum('sum');
    }
    public function getTotalExpenseSum() {
        return Expense::where('user_id', Auth::id())->sum('sum');
    }

    #[On('openTodo')]
    public function openTodo() {
        ($this->sliderListAddTodo) ? $this->sliderListAddTodo = false : $this->sliderListAddTodo = true;
    }

    /** RENDER ********************************************************************************************************/
    #[On('renderTodo')]
    public function render()
    {
        // Search and filter
        $query = $this->searchAndFilter();

        // Check if filter set to done else return only not done todos
        ($this->filterType == 'done') ? $query->where('done', true) : $query->where('done', false);

        $this->dayName  = Carbon::now()->locale('en')->isoFormat('dddd');

        return view('livewire.app.dashboard.widgets.todo-widget',[
            'todos'         =>  $query->paginate($this->items),
            'workoutDay'    =>  Workout::where('user_id', Auth::id())->where('day', $this->dayName)->get(),
            'investList'    =>  CryptoInvestment::where('user_id', Auth::id())->get(),
        ]);
    }
}
