<?php

namespace App\Livewire\App\Top;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TopDisplay extends Component
{
    public $user;
    public $dayName, $dayDate, $month, $week;
    public $title;

    public function weekNr() {
        $date = new DateTime(date('Y-m-d'));
        $week = $date->format("W");
        return $week;
    }

    public function render()
    {
        $this->user     = Auth::user();
        $this->dayName  = Carbon::now()->locale('en')->isoFormat('dddd');
        $this->dayDate  = Carbon::now()->format('d');
        $this->month    = Carbon::now()->format('F');
        $this->week     = $this->weekNr();
        return view('livewire.app.top.top-display');
    }
}
