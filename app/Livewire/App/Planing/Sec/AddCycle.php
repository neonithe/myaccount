<?php

namespace App\Livewire\App\Planing\Sec;

use App\Models\planing\categories\Team;
use App\Models\planing\Employees;
use App\Models\planing\PlaningSettings;
use App\Models\Settings;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function Livewire\Volt\mount;

class AddCycle extends Component
{
    public $startDate = '2024-05-20', $duration = 12, $startCycle = 17;
    public $baseFeDays = 7.5, $baseBeDays = 7.5;

    function getQuarterName($date) {
        $month = (int)$date->format('m');

        if ($month >= 1 && $month <= 3) {
            return 'Q1';
        } elseif ($month >= 4 && $month <= 6) {
            return 'Q2';
        } elseif ($month >= 7 && $month <= 9) {
            return 'Q3';
        } else {
            return 'Q4';
        }
    }

    public function generateCycleList() {
        // Data from DB Settings
        $start_date = $this->startDate;
        $cycle_length_in_weeks = PlaningSettings::first()->cycle_weeks;
        $duration_in_months = $this->duration;
        $nr_cycle = $this->startCycle;

        $cycles = [];
        $start_date = new DateTime($start_date);
        $end_date = clone $start_date;
        $end_date->modify("+{$duration_in_months} months");
        $cycle_length = new DateInterval("P{$cycle_length_in_weeks}W");

        while ($start_date < $end_date) {
            $cycle_end = clone $start_date;
            $cycle_end->add($cycle_length)->modify('-3 days');  // Flytta till fredagen

            // Bestäm kvartalet för startdatumet
            $quarter_name = $this->getQuarterName($start_date);

            // Lägger till cykeln till listan
            $cycles[] = [
                'start'         => $start_date->format('Y-m-d'),
                'end'           => $cycle_end->format('Y-m-d'),
                'cycle'         => $nr_cycle,
                'quarter'       => $quarter_name,
                'fe_days'       => $this->baseFeDays,
                'be_days'       => $this->baseBeDays,
            ];

            // Uppdatera startdatum för nästa cykel
            $start_date->add($cycle_length);
            $nr_cycle++;
        }

        return $cycles;
    }

    public function createCycleList() {
        $this->lists = $this->generateCycleList();
    }

    public function saveList() {
        \App\Models\planing\Cycle::truncate();
        foreach ($this->lists as $cycle) {
            \App\Models\planing\Cycle::create([
                'user_id'       =>  Auth::id(),
                'name'          =>  $cycle['quarter'],
                'cycle_nr'      =>  $cycle['cycle'],
                'cycle_start'   =>  $cycle['start'],
                'cycle_end'     =>  $cycle['end'],
                'fe_days'       =>  $cycle['fe_days'],
                'be_days'       =>  $cycle['be_days'],
            ]);
        }
        $this->dispatch('runandupdateproject');
    }

    public function getCurrentCycle()
    {
        // Hämta inställningar från databasen
        $today = new DateTime(date('Y-m-d'));
        $settings = Settings::where('user_id', Auth::id())->first();
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

    public function changeDayValue($id, $type, $input) {
        $cycle = \App\Models\planing\Cycle::findOrFail($id);
        $cycle->$type = $input;
        $cycle->save();

        $this->dispatch('successmessage', 'Cycle', 'Cycle days changed successfully.');
        $this->render();
        $this->dispatch('runandupdateproject');
    }

    public $lists;

    public $empId, $hours, $total = 0, $totalHours = 0, $names = [], $teamId, $manDays, $setTeamId, $cycleId;

    public function getTeamName($id) {
        return Team::findOrFail($id)->name;
    }

    public function test($id) {
        $employee = Employees::findOrFail($id);

        $this->manDays = $employee->man_days;
    }

    public function addToTotal() {
        // Add to total
        $emp = Employees::findOrFail($this->empId);

        $this->names[] = [
            'name'      => $emp->name,
            'team_id'   => $this->setTeamId,
            'manday'    => $this->manDays,
        ];

        // reset
        $this->empId = null; $this->manDays = null; $this->setTeamId = null;
    }

    public function totalDays() {
        $feTotal = 0;
        $beTotal = 0;

        foreach ($this->names as $name) {
            if ($name['team_id'] == 1) {
                $feTotal += $name['manday'];
            } else if ($name['team_id'] == 2) {
                $beTotal += $name['manday'];
            }
        }

        return [
            'fe' => $feTotal,
            'be' => $beTotal,
        ];
    }

    public function saveToCycle() {
        $data = \App\Models\planing\Cycle::findOrFail($this->cycleId);
        $data->fe_days = $this->totalDays()['fe'];
        $data->be_days = $this->totalDays()['be'];

        $data->save();
        $this->render();
        $this->dispatch('runandupdateproject');
    }

    public function render()
    {
        return view('livewire.app.planing.sec.add-cycle',[
            'cycles'        =>  \App\Models\planing\Cycle::all(),
            'teams'         =>  Team::all(),
            'employees'     =>  Employees::all(),
        ]);
    }
}
