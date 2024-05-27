<?php

namespace App\Livewire\App\Top;

use App\Models\Settings;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
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

    public function getCurrentCycle()
    {
        // Hämta inställningar från databasen
        $today = new DateTime(date('Y-m-d'));
        $settings = $this->getSettings();
        $start_date = new DateTime($settings->start_cycle);
        $cycle_length_in_weeks = $settings->length_cycle;
        $initial_cycle_nr = $settings->nr_cycle;

        // Skapa ett DateInterval baserat på cykellängden
        $cycle_length = new DateInterval("P{$cycle_length_in_weeks}W");

        // Räkna ut antalet veckor (cykler) som passerat sedan startdatum
        $interval = $start_date->diff($today);
        $weeks_passed = (int)floor($interval->days / 7);
        $cycles_passed = (int)floor($weeks_passed / $cycle_length_in_weeks);

        // Beräkna den aktuella cykeln
        $current_cycle_nr = $initial_cycle_nr + $cycles_passed;
        $current_cycle_start = clone $start_date;
        $current_cycle_start->add(new DateInterval("P" . ($cycles_passed * $cycle_length_in_weeks) . "W"));

        // Beräkna cykelns slutdatum (fredagen)
        $current_cycle_end = clone $current_cycle_start;
        $current_cycle_end->add($cycle_length)->modify('-3 days');

        // Kontrollera om dagens datum faller inom den aktuella cykeln
        if ($today >= $current_cycle_start && $today <= $current_cycle_end) {
            return [
                'Dagens datum' => $today->format('Y-m-d'),
                'Cykel nr' => $current_cycle_nr,
                'Cykel Start' => $current_cycle_start->format('Y-m-d'),
                'Cykel Slut' => $current_cycle_end->format('Y-m-d'),
            ];
        }

        // Om ingen cykel matchade, returnera null eller någon indikation på att cykeln inte pågår
        return [
            'Dagens datum' => $today->format('Y-m-d'),
            'Cykel nr' => null,
            'Cykel Start' => null,
            'Cykel Slut' => null,
        ];
    }

    #[On('rendertop')]
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
