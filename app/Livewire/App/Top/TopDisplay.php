<?php

namespace App\Livewire\App\Top;

use App\Models\Settings;
use Carbon\Carbon;
use DateInterval;
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

    /** Cycle *********************************************************************************************************/
    public function getSettings() {
        return Settings::where('user_id', Auth::id())->first();
    }
    public function generateCycleList() {
        // Data from DB Settings
        $start_date = $this->getSettings()->start_cycle;
        $cycle_length_in_weeks = $this->getSettings()->length_cycle;
        $duration_in_months = $this->getSettings()->show_nr_of_cycle;
        $nr_cycle = $this->getSettings()->nr_cycle;

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
        // Get data from DB
        $today = new DateTime(); // Dagens datum
        $start_date = new DateTime('2024-03-25');
        $cycle_length_in_weeks = $this->getSettings()->length_cycle;
        $nr_cycle = $this->getSettings()->nr_cycle;

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

    public function render()
    {
        $this->user     = Auth::user();
        $this->dayName  = Carbon::now()->locale('en')->isoFormat('dddd');
        $this->dayDate  = Carbon::now()->format('d');
        $this->month    = Carbon::now()->format('F');
        $this->week     = $this->weekNr();
        return view('livewire.app.top.top-display',[
            'settings'      =>  Settings::where('user_id', Auth::id())->first(),
        ]);
    }
}
