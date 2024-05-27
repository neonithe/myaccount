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
use Livewire\Attributes\On;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;
use Illuminate\Http\Request;

class Dash extends Component
{


    #[On('renderdash')]
    public function render()
    {
        return view('livewire.app.dashboard.dash',[
            'settings'      =>  Settings::where('user_id', Auth::id())->first(),
        ])->layout('layouts.app');
    }
}
