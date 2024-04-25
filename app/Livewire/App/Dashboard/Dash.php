<?php

namespace App\Livewire\App\Dashboard;

use App\Models\econmony\CryptoInvestment;
use App\Models\econmony\Expense;
use App\Models\econmony\Income;
use App\Models\link\Cat;
use App\Models\link\Link;
use App\Models\link\SpeedButton;
use App\Models\link\Tag;
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
                ->orderByRaw("FIELD(remind_day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
                ->get();
        } else if($type == 'todo') {
            return Todo::where('user_id', Auth::id())
                ->where('done', false)
                ->whereNull('remind_date')
                ->whereNull('repeat')
                ->where('notice', false)
                ->where('paused', false)
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

    /** Cycle *********************************************************************************************************/
    public function generateCycleList() {
        $start_date = '2024-03-25';  // Vi antar att detta är en måndag
        $cycle_length_in_weeks = 2;
        $duration_in_months = 6;
        $nr_cycle = 13;  // Vi börjar räkna från cykel 1

        $cycles = [];
        $start_date = new DateTime($start_date);
        $end_date = clone $start_date;
        $end_date->modify("+{$duration_in_months} months");
        $cycle_length = new DateInterval("P{$cycle_length_in_weeks}W");

        while ($start_date < $end_date) {
            $cycle_end = clone $start_date;
            $cycle_end->add($cycle_length)->modify('-3 days');  // Flytta till fredagen

            // Lägger till cykeln till listan
            $cycles[] = [
                'Startdatum' => $start_date->format('Y-m-d'),
                'Slutdatum' => $cycle_end->format('Y-m-d'),
                'Cykel nr' => $nr_cycle,
            ];

            // Uppdatera startdatum för nästa cykel
            $start_date->add($cycle_length);
            $nr_cycle++;
        }

        return $cycles;
    }

    public function getCurrentCycle() {
        $today = new DateTime(); // Dagens datum
        $start_date = new DateTime('2024-03-25');
        $cycle_length_in_weeks = 2;
        $nr_cycle = 13;
        $cycle_length = new DateInterval("P{$cycle_length_in_weeks}W");

        // Räkna ut vilket cykelnummer det är baserat på startdatum och dagens datum
        while ($start_date <= $today) {
            $cycle_end = clone $start_date;
            $cycle_end->add($cycle_length)->modify('-3 days'); // Slutdatum är fredagen

            if ($today >= $start_date && $today <= $cycle_end) {
                // Vi har hittat den nuvarande cykeln
                return [
                    'Dagens datum' => $today->format('Y-m-d'),
                    'Cykel nr' => $nr_cycle,
                    'Cykel Start' => $start_date->format('Y-m-d'),
                    'Cykel Slut' => $cycle_end->format('Y-m-d'),
                ];
            }

            // Gå till nästa cykel
            $start_date->add($cycle_length);
            $nr_cycle++;
        }

        // Om ingen cykel matchade, returnera null eller någon indikation på att cykeln inte pågår
        return null;
    }


    /** Settings ******************************************************************************************************/
    public function changeSettings($id, $type, $value) {
        $data = Settings::findOrFail($id);
        $data->$type = $value;
        $data->save();
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
