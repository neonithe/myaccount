<?php

namespace App\Livewire\App\Dashboard;

use App\Models\econmony\CryptoInvestment;
use App\Models\econmony\Expense;
use App\Models\econmony\Income;
use App\Models\recipe\Ingredient;
use App\Models\recipe\Recipe;
use App\Models\todo\Todo;
use App\Models\workout\Workout;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use GuzzleHttp\Client;

class Dash extends Component
{
    // MyTodo
    public $pausedCount, $prioCount, $remindCount, $regularCount, $allCount, $meetingCount, $contactCount, $doneCount;
    // Crypto
    public $cryptoList = [];

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
        return Todo::where('user_id', Auth::id())->where($type, true)->get();
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

    /** Crypto ********************************************************************************************************/
    public function calc()
    {

        $this->cryptoList = [
        'usdToSek'=>10.50,//$data['usd']['sek'],  // Hämta kursen för USD till SEK
        'btc'=>60000,//$prices['bitcoin']['usd'], // Sätt kursen för bitcoin i USD
        'xrp'=>0.5,//$prices['ripple']['usd'],  // Sätt kursen för ripple i USD
        'eth'=>1300,//$prices['ethereum']['usd'],// Sätt kursen för ethereum i USD
        ];
        /** testing
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
         *  **/
    }

    /** Budget ********************************************************************************************************/
    public function getTotalIncomeSum() {
        return Income::where('user_id', Auth::id())->sum('sum');
    }
    public function getTotalExpenseSum() {
        return Expense::where('user_id', Auth::id())->sum('sum');
    }

    public function render()
    {
        $this->getTodoCount();
        return view('livewire.app.dashboard.dash',[
            'workouts'      =>  Workout::where('user_id', Auth::id())->get(),
            'recipeCount'   =>  Recipe::where('user_id', Auth::id())->count(),
            'ingCount'      =>  Ingredient::where('user_id', Auth::id())->count(),
            'investList'    =>  CryptoInvestment::where('user_id', Auth::id())->get(),
        ])->layout('layouts.app');
    }
}
