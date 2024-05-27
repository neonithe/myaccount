<?php

namespace Database\Seeders;

use App\Models\planing\categories\ProjectType;
use App\Models\planing\categories\Team;
use App\Models\planing\Cycle;
use App\Models\planing\Employees;
use App\Models\planing\PlaningSettings;
use App\Models\planing\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // New Projects
        $this->call(NewProjectSeeder::class);

        Cycle::create(['user_id' => 1, 'name' => 'Cycle', 'cycle_nr' => 17, 'fe_days' => 8, 'be_days'=>7.5]);
        Cycle::create(['user_id' => 1, 'name' => 'Cycle', 'cycle_nr' => 18, 'fe_days' => 8, 'be_days'=>7.5]);
        Cycle::create(['user_id' => 1, 'name' => 'Cycle', 'cycle_nr' => 19, 'fe_days' => 8, 'be_days'=>7.5]);
        Cycle::create(['user_id' => 1, 'name' => 'Cycle', 'cycle_nr' => 20, 'fe_days' => 8, 'be_days'=>7.5]);
        Cycle::create(['user_id' => 1, 'name' => 'Cycle', 'cycle_nr' => 21, 'fe_days' => 8, 'be_days'=>7.5]);
        Cycle::create(['user_id' => 1, 'name' => 'Cycle', 'cycle_nr' => 22, 'fe_days' => 8, 'be_days'=>7.5]);
        Cycle::create(['user_id' => 1, 'name' => 'Cycle', 'cycle_nr' => 23, 'fe_days' => 8, 'be_days'=>7.5]);

        // Settings
        PlaningSettings::create(['work_day_hours'=>8, 'days_in_week'=>5, 'cycle_weeks'=>2, 'points_per_hour'=>0.5, 'focus_factor'=>0.5]);


        // Employees
        Employees::create(['name'=>'Mattias', 'cost_h'=>200, 'work_time_perc'=>100, 'cycle_work_time_perc'=>100, 'team_id'=>3]);
        Employees::create(['name'=>'Jonas', 'cost_h'=>200, 'work_time_perc'=>100, 'cycle_work_time_perc'=>25, 'team_id'=>3]);
        Employees::create(['name'=>'David', 'cost_h'=>200, 'work_time_perc'=>100, 'cycle_work_time_perc'=>50, 'team_id'=>2]);
        Employees::create(['name'=>'Anton', 'cost_h'=>200, 'work_time_perc'=>100, 'cycle_work_time_perc'=>100, 'team_id'=>2]);
        Employees::create(['name'=>'Dmitro', 'cost_h'=>200, 'work_time_perc'=>50, 'cycle_work_time_perc'=>50, 'team_id'=>1]);
        Employees::create(['name'=>'Mykola', 'cost_h'=>200, 'work_time_perc'=>100, 'cycle_work_time_perc'=>100, 'team_id'=>1]);

        // Teams
        Team::create(['name'=>'FrontEnd']);
        Team::create(['name'=>'BackEnd']);
        Team::create(['name'=>'Other']);

        // Project type
        ProjectType::create(['name'=>'Active']);
        ProjectType::create(['name'=>'Distributed']);
        ProjectType::create(['name'=>'Planing']);
        ProjectType::create(['name'=>'Discovery']);
    }
}
