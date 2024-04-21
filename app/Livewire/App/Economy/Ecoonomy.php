<?php

namespace App\Livewire\App\Economy;

use App\Models\econmony\CryptoInvestment;
use App\Models\econmony\EcoCategory;
use App\Models\econmony\Expense;
use App\Models\econmony\Income;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use GuzzleHttp\Client;

class Ecoonomy extends Component
{
    public $income_name, $income_sum;
    public $expense_name, $expense_sum, $expense_cat;
    public $crytoName, $cryptoValue, $cryptoComment, $cryptoSekValue;

    public $search, $filterCat;
    public $list = [];

    /** Functions *****************************************************************************************************/
    public function resetValue() {
        $this->income_sum = null; $this->income_name = null;
        $this->expense_sum = null; $this->expense_cat = null; $this->expense_name = null;
    }

    /** Income ********************************************************************************************************/
    public function addIncome() {

        $this->validate([
            'income_name'   =>  'required',
            'income_sum'    =>  'required',
        ]);

        Income::create([
            'user_id'   => Auth::id(),
            'name'      => $this->income_name,
            'sum'       => $this->income_sum,
        ]);
        $this->dispatch('successmessage', 'Income', 'Income successfully created.');
        $this->resetValue();
        $this->render();
    }

    public function deleteIncome($id) {
        Income::findOrFail($id)->delete();
        $this->dispatch('successmessage', 'Income', 'Income successfully deleted.');
        $this->render();
    }

    public function changeIncome($id, $type, $value) {
        if ($value === null || $value === '') {
            $this->dispatch('successmessage', 'Income', 'Must enter a value, cannot leave empty.', true);
            return;
        }

        $data = Income::findOrFail($id);
        if ($type == 'sum') {
            $value = abs($value);
        }

        $data->$type = $value;
        $data->save();
        $this->dispatch('successmessage', 'Income', 'Income successfully changed.');
        $this->render();
    }

    /** Expense *******************************************************************************************************/
    public function addExpense() {

        $this->validate([
            'expense_name'   =>  'required',
            'expense_sum'    =>  'required',
            'expense_cat'    =>  'required',
        ]);

        Expense::create([
            'user_id'   => Auth::id(),
            'name'      => $this->expense_name,
            'sum'       => $this->expense_sum,
            'cat_id'    => $this->expense_cat,
        ]);
        $this->dispatch('successmessage', 'Expense', 'Expense successfully created.');
        $this->resetValue();
        $this->render();
    }

    public function deleteExpense($id) {
        Expense::findOrFail($id)->delete();
        $this->dispatch('successmessage', 'Expense', 'Expense successfully deleted.');
        $this->render();
    }

    public function changeExpense($id, $type, $value) {
        if ($value === null || $value === '') {
            $this->dispatch('successmessage', 'Expense', 'Must enter a value, cannot leave empty.', true);
            return;
        }

        $data = Expense::findOrFail($id);
        if ($type == 'sum') {
            ($value > 0) ? $value = -abs($value) : 0;
        }

        $data->$type = $value;
        $data->save();
        $this->dispatch('successmessage', 'Expense', 'Expense successfully changed.');
        $this->render();
    }

    /** Calculations **************************************************************************************************/
    /** Income **/
    public function getTotalIncomeSum() {
        return Income::where('user_id', Auth::id())->sum('sum');
    }
    public function getTotalIncomeCount() {
        return Income::where('user_id', Auth::id())->count();
    }
    /** Expense **/
    public function getTotalExpenseSum() {
        return Expense::where('user_id', Auth::id())->sum('sum');
    }
    public function getTotalExpenseCount() {
        return Expense::where('user_id', Auth::id())->count();
    }

    /** Category **/
    public function getCatSum($id) {
        return Expense::where('user_id', Auth::id())->where('cat_id', $id)->sum('sum');
    }

    /** Crypto ********************************************************************************************************/
    public function calc()
    {
        /** testing
        $this->list = [
            'usdToSek'=>10.50,//$data['usd']['sek'],  // Hämta kursen för USD till SEK
            'btc'=>60000,//$prices['bitcoin']['usd'], // Sätt kursen för bitcoin i USD
            'xrp'=>0.5,//$prices['ripple']['usd'],  // Sätt kursen för ripple i USD
            'eth'=>1300,//$prices['ethereum']['usd'],// Sätt kursen för ethereum i USD
        ];
         **/
        $client = new Client();

        // Hämta växelkursen USD till SEK
        $response = $client->get('https://api.coingecko.com/api/v3/simple/price?ids=usd&vs_currencies=sek');
        $data = json_decode($response->getBody()->getContents(), true);

        // Hämta priset på BTC och XRP i USD
        $response = $client->get('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ripple,ethereum&vs_currencies=usd');
        $prices = json_decode($response->getBody()->getContents(), true);

        $this->list = [
            'usdToSek'=>$data['usd']['sek'],  // Hämta kursen för USD till SEK
            'btc'=>$prices['bitcoin']['usd'], // Sätt kursen för bitcoin i USD
            'xrp'=>$prices['ripple']['usd'],  // Sätt kursen för ripple i USD
            'eth'=>$prices['ethereum']['usd'],// Sätt kursen för ethereum i USD
        ];

    }

    public function addToList() {
        $this->validate([
            'crytoName'     =>  'required',
            'cryptoValue'   =>  'required',
        ]);

        CryptoInvestment::create([
            'user_id'       =>  Auth::id(),
            'name'          =>  $this->crytoName,
            'comment'       =>  $this->cryptoComment,
            'buy_value_sek' =>  $this->cryptoSekValue,
            'value'         =>  $this->cryptoValue,
        ]);
    }

    public function changeCryptoValue($id, $type, $value) {
        if ($value === null || $value === '') {
            $this->dispatch('successmessage', 'Crypto', 'Must enter a value, cannot leave empty.', true);
            return;
        }

        $data = CryptoInvestment::findOrFail($id);
        $data->$type = $value;
        $data->save();
        $this->dispatch('successmessage', 'Crypto', 'Crypto successfully changed.');
        $this->render();
    }

    public function render()
    {
        $query = Expense::where('user_id', Auth::id())->orderBy('cat_id', 'asc');

        if ($this->search) {
            $query->where(function ($subquery) {
                $subquery->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterCat) {
            $query->where('cat_id', $this->filterCat);
        }

        return view('livewire.app.economy.ecoonomy',[
            'category'  =>  EcoCategory::all(),
            'income'    =>  Income::where('user_id', Auth::id())->get(),
            'expense'   =>  $query->get(),
            'cryptoList'=>  CryptoInvestment::where('user_id', Auth::id())->get(),
        ])->layout('layouts.app');
    }
}
