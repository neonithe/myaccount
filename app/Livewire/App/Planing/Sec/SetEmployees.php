<?php

namespace App\Livewire\App\Planing\Sec;

use App\Models\planing\categories\Team;
use App\Models\planing\Employees;
use App\Models\planing\PlaningSettings;
use Livewire\Component;

class SetEmployees extends Component
{

    public $name, $work_time_perc = 100, $cycle_work_time_perc = 100, $cost_h = 200;
    public $employeeList;

    public function mount() {
        $this->employeeList = $this->calcEmployee();
    }

    public function calcEmployee() {
        $employees  = Employees::all();
        $settings   = PlaningSettings::all()->first();

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

    public function changeEmpolyee($id, $type, $input) {
        $employee = Employees::findOrFail($id);
        $employee->$type = $input;
        $employee->save();
        $this->mount();
        $this->render();
    }

    public function calcCost($id) {
        $employee = Employees::findOrFail($id);
        return number_format($employee->cycle_work_h * $employee->cost_h, 0, ',', ' ');
    }

    public function totalCost() {
        $employees = Employees::whereNotNull('cycle_work_time_perc')->get();
        $totalCost = 0; $totalTime = 0;
        foreach ($employees as $employee) {
            $totalCost += $employee->cost_h * $employee->cycle_work_h;
        }
        return number_format($totalCost, 0, ',', ' ');
    }

    public function totalDays() {
        $employees = Employees::whereNotNull('cycle_work_time_perc')->get();
        $days = 0;
        foreach ($employees as $employee) {
            $days += $employee->man_days;
        }
        return $days;
    }


    public function render()
    {
        return view('livewire.app.planing.sec.set-employees',[
            'employees'     =>  $this->employeeList,
            'teams'         =>  Team::all(),
        ]);
    }
}
