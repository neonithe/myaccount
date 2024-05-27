<?php

namespace App\Livewire\App\Planing;

use App\Models\planing\Cycle;
use App\Models\planing\Employees;
use App\Models\planing\PlaningSettings;
use App\Models\planing\Project;
use App\Models\Settings;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Planing extends Component
{
    public $currentQuarter;
    public $dayName, $dayDate, $month, $week;

    public function mount()
    {
        $now = new \DateTime();
        $this->today = date('Y-m-d');
        $this->currentQuarter = $this->getCurrentQuarter($now);
    }

    /** Top section ***************************************************************************************************/
    public function getCurrentQuarter($date)
    {
        $month = $date->format('m');

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

    public function weekNr() {
        $date = new DateTime(date('Y-m-d'));
        $week = $date->format("W");
        return $week;
    }

    public function getSettings() {
        return Settings::where('user_id', Auth::id())->first();
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


    /** Employees *****************************************************************************************************/

    public function calcEmployee() {
        $employees = Employees::all();
        $settings = PlaningSettings::all()->first();
        $test = 8*(25/100);
        //dd($test);

        foreach ($employees as $employee) {
            $resH = $settings->work_day_hours * ($employee->cycle_work_time_perc/100);
            $cycleT = $settings->days_in_week * $settings->cycle_weeks;

            $employee->cycle_days = $cycleT;
            $employee->cycle_work_h = $resH*$cycleT;
            $employee->cycle_points = $settings->points_per_hour * ($employee->cycle_work_h);
            $employee->real_cycle_work_h = ($employee->cycle_work_h) * $settings->focus_factor;
            $employee->man_days = (($employee->cycle_work_h) * $settings->focus_factor)/$settings->work_day_hours;
            $employee->real_cycle_points_h = $settings->points_per_hour * $settings->focus_factor;
            $employee->real_cycle_points = $employee->real_cycle_points_h * $employee->cycle_work_h;

            $employee->save();
        }

        /**
        dd(
            'Cycle days: '.$kk->work_time_perc,
            'Cycle days: '.$kk->cycle_days,
            'Work hours: '.$kk->cycle_work_h,
            'Cycle points: '.$kk->cycle_points,
            'Real Cycle hours: '.$kk->real_cycle_work_h,
            'Real Cycle points: '.$kk->real_cycle_points,
            'Real Cycle points/h: '.$kk->real_cycle_points_h,
            'Man hours: '.$kk->man_days,
        );**/

        return Employees::all();

    }

    public function calcTotalTeamTime($team) {
        $employees = Employees::all();
        $total = 0;
        foreach ($employees as $employee) {
            if ($employee->team_id == $team) {
                $total +=  $employee->man_days;
            }
        }
        return $total;
    }



    /** Project **/
    public $name, $size;
    public $fePerc, $bePerc, $maPerc, $tePerc, $feOtPerc, $beOtPerc;
    public $feDays, $beDays, $teDays, $maDays, $beOtDays, $feOtDays;


    public function calcDays() {
        switch ($this->size) {
            case 'XS': $setSize = 2; break;
            case 'S': $setSize = 5; break;
            case 'M': $setSize = 10; break;
            case 'L': $setSize = 20; break;
            case 'XL': $setSize = 30; break;
        }

        $this->feDays = $this->size*($this->fePerc/100);
        $this->beDays = $this->size*($this->bePerc/100);
        $this->beOtDays = $this->size*($this->beOtPerc/100);
        $this->feOtDays = $this->size*($this->feOtPerc/100);
    }


    /** Project - list **/


    public function getDays($id) {
        return Project::findOrFail($id)->days;
    }

    public function changeCycle($id, $type, $value) {
        $data = Cycle::findOrFail($id);
        $data->$type = $value;
        $data->save();
        $this->render();
        $this->updateList();
    }

    public function changeProject($id, $type, $value)
    {
        $data = Project::findOrFail($id);
        $data->$type = $value;

        // Recalc
        $size = $data->size;
        $data->be_days = $size * ($data->be_perc/100);
        $data->fe_days = $size * ($data->fe_perc/100);
        $data->be_ot_days = $size * ($data->be_ot_perc/100);
        $data->fe_ot_days = $size * ($data->fe_ot_perc/100);

        $data->save();

        // Reload projects after change
        $this->projects = Project::orderBy('order')->get();

        // Reset cycle allocation state
        $this->cycleIndex = 0;
        $this->cycleTimeRemaining = $this->cycles[$this->cycleIndex]->time;
    }

    public function createProject() {
        $lastOrder = Project::max('order');
        $newOrder = $lastOrder ? $lastOrder + 1 : 1;

        $this->feDays = $this->size * ($this->fePerc/100);
        $this->beDays = $this->size * ($this->bePerc/100);
        $this->beOtDays = $this->size * ($this->beOtPerc/100);
        $this->feOtDays = $this->size * ($this->feOtPerc/100);

        Project::create([
            'user_id'       =>  Auth::id(),
            'order'         =>  $newOrder,
            'name'          =>  $this->name,
            'size'          =>  $this->size,

            'be_days'       =>  $this->beDays,
            'fe_days'       =>  $this->feDays,
            'be_ot_days'    =>  $this->beOtDays,
            'fe_ot_days'    =>  $this->feOtDays,

            'be_perc'       =>  $this->bePerc,
            'fe_perc'       =>  $this->fePerc,
            'be_ot_perc'    =>  $this->beOtPerc,
            'fe_ot_perc'    =>  $this->feOtPerc,
        ]);

        // Uppdatera projekten efter skapande
        $this->projects = Project::orderBy('order')->get();
    }

    public function changeSize($id, $value) {
        $data = Project::findOrFail($id);
        $data->size = $value;

        // Recalc
        $data->be_days = $data->size * ($data->be_perc/100);
        $data->fe_days = $data->size * ($data->fe_perc/100);
        $data->fe_ot_days = $data->size * ($data->fe_ot_perc/100);
        $data->be_ot_days = $data->size * ($data->be_ot_perc/100);

        $data->save();
    }

    public $set;

    public function render()
    {
        $this->dayName  = Carbon::now()->locale('en')->isoFormat('dddd');
        $this->dayDate  = Carbon::now()->format('d');
        $this->month    = Carbon::now()->format('F');
        $this->week     = $this->weekNr();

        $this->set = PlaningSettings::all()->first();
        return view('livewire.app.planing.planing',[
            'employees'     =>  $this->calcEmployee(),
            'projectList'   =>  Project::where('user_id', Auth::id())->get(),

            'cycles'        =>  Cycle::where('user_id', Auth::id())->get(),
        ])->layout('layouts.app');
    }
}
