<?php

namespace App\Livewire\App\Dashboard;

use App\Models\econmony\CryptoInvestment;
use App\Models\econmony\Expense;
use App\Models\econmony\Income;
use App\Models\link\Cat;
use App\Models\link\Link;
use App\Models\link\SpeedButton;
use App\Models\link\Tag;
use App\Models\Note;
use App\Models\recipe\Ingredient;
use App\Models\recipe\Recipe;
use App\Models\Settings;
use App\Models\todo\Todo;
use App\Models\workout\Workout;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class Dash extends Component
{
    use WithPagination;

    // MyTodo
    public $pausedCount, $prioCount, $remindCount, $regularCount, $allCount, $meetingCount, $contactCount, $doneCount;
    // Crypto
    public $cryptoList = [];

    public $dayName;

    public $showLinks = 5, $search, $filterTag, $filterCat, $filterFav;

    public $note;

    // Edit mytodo
    public $editTodo, $editComment, $editLink;
    public $editModal = false, $todoItem;
    public $isPrio, $isPrivate;

    public function mount() {
        $this->note = Note::where('user_id', Auth::id())->where('firstpage', true)->first();
    }

    /** MyToDo ********************************************************************************************************/
    public function getTodoCount() {
        $this->allCount     = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->count();
        $this->pausedCount  = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('paused', true)->count();
        $this->prioCount    = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('notice', true)->count();
        $this->contactCount = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('contact', true)->count();
        $this->meetingCount = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->where('meeting', true)->count();
        $this->remindCount  = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)->whereNotNull('remind_date')->count();
        $this->regularCount = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', false)
            ->whereNull('remind_date')
            ->where('notice', false)
            ->where('paused', false)
            ->count();
        $this->doneCount = \App\Models\todo\Todo::where('user_id', Auth::id())->where('done', true)->count();
    }

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
        $data = \App\Models\todo\Todo::findOrFail($id);
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

    public function check($id) {
        $data = Todo::findOrFail($id);
        $data->done = true;
        $data->done_date = date('Y-m-d');
        $data->save();
    }

    /** Edit todo ******/
    public function updateTodo() {
        $this->validate([
            'editTodo'      =>  'required',
        ]);
        $this->todoItem->todo     = $this->editTodo;
        $this->todoItem->link     = $this->editLink;
        $this->todoItem->comment  = $this->editComment;
        $this->todoItem->save();
        $this->editModal    = false;
        $this->dispatch('successmessage', 'Todo', 'Todo is now updated.' );
        $this->render();
    }

    public function openEdit($id) {
        $this->todoItem = Todo::findOrFail($id);
        $this->editModal    = true;
        $this->editTodo     = $this->todoItem->todo;
        $this->editLink     = $this->todoItem->link;
        $this->editComment  = $this->todoItem->comment;
        $this->isPrio       = $this->todoItem->notice;
        $this->isPrivate    = $this->todoItem->private;
        $this->render();
    }

    public function cleanModal() {
        $this->editModal    = false;
        $this->editTodo     = null;
        $this->editLink     = null;
        $this->editComment  = null;
        $this->todoItem     = null;
        $this->isPrio       = null;
        $this->isPrivate    = null;
        $this->render();
    }

    public function editTodoPrio() {
        ($this->todoItem->notice) ? $this->todoItem->notice = false : $this->todoItem->notice = true;
        $this->todoItem->save();
        $this->editModal = false;
        $this->render();
    }

    public function editTodoPrivate() {
        ($this->todoItem->private) ? $this->todoItem->private = false : $this->todoItem->private = true;
        $this->todoItem->save();
        $this->editModal = false;
        $this->render();
    }

    /** Crypto ********************************************************************************************************/
    public function calc()
    {
        /** testing
        $this->cryptoList = [
        'usdToSek'=>10.50,//$data['usd']['sek'],  // Hämta kursen för USD till SEK
        'btc'=>60000,//$prices['bitcoin']['usd'], // Sätt kursen för bitcoin i USD
        'xrp'=>0.5,//$prices['ripple']['usd'],  // Sätt kursen för ripple i USD
        'eth'=>1300,//$prices['ethereum']['usd'],// Sätt kursen för ethereum i USD
        ];*  **/

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

    /** Links *********************************************************************************************************/
    public function getTag() {
        return Tag::where('user_id', Auth::id())->get();
    }

    public function getCat() {
        return Cat::where('user_id', Auth::id())->get();
    }

    public function changeFav($id) {
        $data = Link::findOrFail($id);
        ($data->fav) ? $data->fav = false : $data->fav = true;
        $data->save();
    }

    public function changeLink($id, $type, $value, $change) {
        $data = Link::findOrFail($id);
        $data->$type = $value;
        $data->save();

        $this->dispatch('successmessage', 'Links', $change.' is now changed.' );
        $this->render();
    }

    /** Speedbuttons **************************************************************************************************/
    public function getButtonLink($id) {
        $data = SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first();
        (!$data) ? $res = null : $res = Link::findOrfail($data->link_id)->id;
        return $res;
    }

    public function getOrder($id) {
        if ( $data = SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first() ) {
            return $data->order;
        } else {
            return 0;
        }
    }

    public function changeOrder($id, $orderNr) {
        $data = SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first();
        $data->order = $orderNr;
        $data->save();
        $this->dispatch('successmessage', 'Link button', 'Order has been changed.' );
    }

    public function setButtonLink($id, $linkId) {
        if (!$linkId) {
            SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first()->delete();
            $this->dispatch('successmessage', 'Link button', 'Button link is now removed.' );
        } else {
            if ( $data = SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first() ) {
                $data->link_id = $linkId;
                $data->save();
                $this->dispatch('successmessage', 'Link button', 'Button link is now changed.' );
            } else {
                SpeedButton::create(['user_id' => Auth::id(), 'button_id' => $id, 'link_id' => $linkId, 'order' => 1]);
                $this->dispatch('successmessage', 'Link button', 'Button link is now set.' );
            }
        }
    }

    public function getLink($id) {
        return Link::findOrFail($id)->link;
    }

    public function buttonAlign($value) {
        $data = Settings::where('user_id', Auth::id())->first();
        $data->button_align = $value;
        $data->save();
        $this->render();
    }

    public function getLinkName($id) {
        return Link::findOrFail($id)->name;
    }

    /** Notes *********************************************************************************************************/
    public function changeNote($id, $type, $value) {
        $data = Note::findOrFail($id);
        $data->$type = $value;
        $data->save();

        $this->dispatch('successmessage', 'Note', 'Note change successfully.');
        $this->mount();
        $this->render();
    }

    public function timeStamp() {
        $note = Note::findOrFail($this->note->id);
        $getNote = $note->note;
        $update = $getNote.' '.Carbon::now()->toDateTimeString().' ';
        $note->note = $update;
        $note->save();
        $this->mount();
        $this->render();
    }

    /** Settings ******************************************************************************************************/
    public function changeSettings($id, $type, $value) {
        $data = Settings::findOrFail($id);
        $data->$type = $value;
        $data->save();
    }

    public function test() {
        $this->dispatch('runloading');
    }

    public function render()
    {
        $this->getTodoCount();
        $this->dayName  = Carbon::now()->locale('en')->isoFormat('dddd');

        $query = Link::where('user_id', Auth::id())->orderBy('fav', 'desc');

        if ($this->search) {
            $query->where(function ($subquery) {
                $subquery->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterTag) {$query->where('tag_id', $this->filterTag);}
        if ($this->filterCat) {$query->where('cat_id', $this->filterCat);}
        if ($this->filterFav == 'fav') {
            $query->where('fav', true);
        } else if($this->filterFav == 'nofav') {
            $query->where('fav', false);
        }


        return view('livewire.app.dashboard.dash',[
            'settings'      =>  Settings::where('user_id', Auth::id())->first(),

            'cats'          =>  Cat::where('user_id', Auth::id())->get(),
            'tags'          =>  Tag::where('user_id', Auth::id())->get(),
            'links'         =>  $query->paginate($this->showLinks),
            'allLinks'      =>  \App\Models\link\Link::where('user_id', Auth::id())->get(),
            'buttons'       =>  SpeedButton::where('user_id', Auth::id())->orderBy('order', 'ASC')->get(),

            'workoutDay'    =>  Workout::where('user_id', Auth::id())->where('day', $this->dayName)->get(),
            'workouts'      =>  Workout::where('user_id', Auth::id())->get(),
            'recipeCount'   =>  Recipe::where('user_id', Auth::id())->count(),
            'ingCount'      =>  Ingredient::where('user_id', Auth::id())->count(),
            'investList'    =>  CryptoInvestment::where('user_id', Auth::id())->get(),
        ])->layout('layouts.app');
    }
}
