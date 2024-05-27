<?php

namespace App\Livewire\App\Planing\Sec;

use App\Models\planing\categories\ProjectType;
use App\Models\planing\Cycle;
use App\Models\planing\DoneProject;
use App\Models\planing\PlaningSettings;
use App\Models\planing\Project;
use App\Models\planing\ProjectBacklog;
use App\Models\Settings;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use function Termwind\render;

class SetProject extends Component
{
    public $projects;

    public $feCycles, $beCycles;
    private $feCycleIndex = 0, $beCycleIndex = 0;
    private $feCycleTimeRemaining, $beCycleTimeRemaining;

    public $cycleNumber;

    // Update/Edit
    public $sliderEdit = false, $editProject, $set, $comment;

    #[On('runandupdateproject')]
    public function runAndUpdateAll() {
        $this->mount();
        $this->render();
    }

    /** MOUNT *********************************************************************************************************/
    public function mount()
    {
        $this->projects = Project::orderBy('order')->get();

        $this->feCycles = Cycle::orderBy('cycle_nr')->get()->map(function ($cycle) {
            return (object)[
                'cycle_nr' => $cycle->cycle_nr,
                'fe_days' => $cycle->fe_days,
                'name' => $cycle->name,
            ];
        });

        $this->beCycles = Cycle::orderBy('cycle_nr')->get()->map(function ($cycle) {
            return (object)[
                'cycle_nr' => $cycle->cycle_nr,
                'be_days' => $cycle->be_days,
                'name' => $cycle->name,
            ];
        });

        $this->feCycleTimeRemaining = $this->feCycles[$this->feCycleIndex]->fe_days;
        $this->beCycleTimeRemaining = $this->beCycles[$this->beCycleIndex]->be_days;
    }

    /** Calculate cycles **********************************************************************************************/
    public function calculateFeProjectCycles($project)
    {
        return $this->calculateProjectCycles($project, 'fe_days', $this->feCycles,
            $this->feCycleIndex, $this->feCycleTimeRemaining);
    }

    public function calculateBeProjectCycles($project)
    {
        return $this->calculateProjectCycles($project, 'be_days', $this->beCycles,
            $this->beCycleIndex, $this->beCycleTimeRemaining);
    }

    private function calculateProjectCycles($project, $type, &$cycles, &$cycleIndex, &$cycleTimeRemaining)
    {
        $projectCycles = [];
        $addFeOt = ($type == 'fe_days') ? $project->fe_ot_days : 0;
        $addBeOt = ($type == 'be_days') ? $project->be_ot_days : 0;

        $projectTime =  $project->$type + $addFeOt + $addBeOt;

        while ($projectTime > 0) {
            if ($cycleTimeRemaining == 0) {
                $cycleIndex++;
                if (isset($cycles[$cycleIndex])) {
                    $cycleTimeRemaining = $cycles[$cycleIndex]->$type;
                } else {
                    $projectCycles[] = [
                        'cycleId' => '',
                        'timeUsed' => $projectTime,
                        'totalTime' => 0,
                        'name' => '',
                    ];
                    break;
                }
            }

            $timeInCycle = min($projectTime, $cycleTimeRemaining);
            $projectCycles[] = [
                'cycleId' => $cycles[$cycleIndex]->cycle_nr,
                'timeUsed' => $timeInCycle,
                'totalTime' => $cycles[$cycleIndex]->$type,
                'name' => $cycles[$cycleIndex]->name,
            ];

            $projectTime -= $timeInCycle;
            $cycleTimeRemaining -= $timeInCycle;
        }

        return $projectCycles;
    }



    /** Move order for Project ****************************************************************************************/
    public function moveUp($projectId)
    {
        $index = $this->projects->search(function ($project) use ($projectId) {
            return $project->id == $projectId;
        });

        if ($index > 0) {
            $project = $this->projects[$index];
            $swapProject = $this->projects[$index - 1];

            // Swap orders
            $tempOrder = $project->order;
            $project->order = $swapProject->order;
            $swapProject->order = $tempOrder;

            // Save changes
            $project->save();
            $swapProject->save();

            // Reload projects
            $this->mount();
        }
    }

    public function moveDown($projectId)
    {
        $index = $this->projects->search(function ($project) use ($projectId) {
            return $project->id == $projectId;
        });

        if ($index < $this->projects->count() - 1) {
            $project = $this->projects[$index];
            $swapProject = $this->projects[$index + 1];

            // Swap orders
            $tempOrder = $project->order;
            $project->order = $swapProject->order;
            $swapProject->order = $tempOrder;

            // Save changes
            $project->save();
            $swapProject->save();

            // Reload projects
            $this->mount();
        }
    }

    public function countProject()
    {
        $list = [];
        for ($i = 1; $i <= count($this->projects); $i++) {
            $list[] = ['id' => $i];
        }
        return $list;
    }
    public function moveToOrder($projectId, $newOrder)
    {
        $project = Project::findOrFail($projectId);
        $currentOrder = $project->order;

        if ($newOrder < $currentOrder) {
            // Move project up
            Project::whereBetween('order', [$newOrder, $currentOrder - 1])->increment('order');
        } elseif ($newOrder > $currentOrder) {
            // Move project down
            Project::whereBetween('order', [$currentOrder + 1, $newOrder])->decrement('order');
        }

        $project->order = $newOrder;
        $project->save();

        $this->countProject();
        $this->updateEditProject($projectId);
        $this->mount();
        $this->render();
    }


    /** Get Cycle *****************************************************************************************************/
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

    /** Project update/edit *******************************************************************************************/
    public function updateEditProject($id) {
        $this->editProject = Project::findOrFail($id);
    }

    public function openEdit($id) {
        $this->editProject = Project::findOrFail($id);
        ($this->sliderEdit) ? $this->sliderEdit = false : $this->sliderEdit = true;
        $this->comment = $this->editProject->comment;
        $this->mount();
        $this->render();
    }

    public function changeSize($id, $input) {
        $project = Project::findOrFail($id);
        $project->size = $input;

        $project->be_days = $project->size * ($project->be_perc/100);
        $project->fe_days = $project->size * ($project->fe_perc/100);
        $project->fe_ot_days = $project->size * ($project->fe_ot_perc/100);
        $project->be_ot_days = $project->size * ($project->be_ot_perc/100);
        $project->save();

        $this->mount();
    }

    public function changeProject($id, $type, $input) {
        $project = Project::findOrFail($id);
        $project->$type = $input;

        // Recalc
        $size = $project->size;
        $project->be_days = $size * ($project->be_perc/100);
        $project->fe_days = $size * ($project->fe_perc/100);
        $project->be_ot_days = $size * ($project->be_ot_perc/100);
        $project->fe_ot_days = $size * ($project->fe_ot_perc/100);

        $project->save();

        // Reload projects
        $this->mount();
    }

    public function saveComment($id) {
        $project = Project::findOrFail($id);
        $project->comment = $this->comment;
        $project->save();

        $this->sliderEdit = false;
        $this->mount();
        $this->render();
    }



    /** Change project status ************************************************************************/
    public function getNameForProjectType($id) {
        return ProjectType::findOrFail($id)->name;
    }

    public function changeStatusType($id, $input) {
        $data = Project::findOrFail($id);
        $data->project_type_id = $input;
        $data->save();
        $this->updateEditProject($id);
        $this->mount();
        $this->render();
    }

    /** POINTS **/
    public function calcPoints($id, $type, $input) {
        $data = Project::findOrFail($id);
        $settings = PlaningSettings::first();

        // Add p_be_days  and p_fe_days
        $data->$type = $settings->points_per_hour * ($settings->focus_factor * $input);
        if ($type == 'fe_days') { $data->fe_points = $input;}
        if ($type == 'be_days') { $data->be_points = $input;}
        if ($type == 'fe_ot_days') { $data->fe_ot_points = $input;}
        if ($type == 'be_ot_days') { $data->be_ot_points = $input;}

        $data->save();
        $this->mount();
        $this->render();
    }

    public function calcProgress($id, $type, $input) {
        $data = Project::findOrFail($id);
        $data->$type = $input;
        $data->save();
        $this->mount();
    }

    public function calcProgressToPercent($id, $type) {
        $project = Project::findOrFail($id);
        if ($type == 'fe') {
            $points = ($project->fe_points != null) ? $project->fe_points : 1;
            $otPoints = ($project->fe_ot_points != null) ? $project->fe_ot_points : 1;
            $total = $points + $otPoints;
            $progress = $project->fe_progress_points;
        } else if($type == 'be') {
            $points = ($project->be_points != null) ? $project->be_points : 1;
            $otPoints = ($project->be_ot_points != null) ? $project->be_ot_points : 1;
            $total = $points + $otPoints;
            $progress = $project->be_progress_points;
        }

        return number_format(($progress * 100)/$total, 0, ',', ' ');
    }

    /** ESTIMATIONS **/
    public function calcEst($id, $type, $input) {
        $data = Project::findOrFail($id);

        // Set percent
        $data->$type = $input;
        // Calc percent to days
        $getDaysEst = $input*$data->size/100;
        // Set days
        ($type == 'fe_perc') ? $data->fe_days = $getDaysEst : $data->be_days = $getDaysEst;

        $data->save();
        $this->editProject = Project::findOrfail($id);
        $this->mount();
        $this->render();
    }

    public function calcOtEst($id, $type, $input) {
        $data = Project::findOrFail($id);

        // Set percent
        $data->$type = $input;
        // Calc percent to days
        $getDaysEst = $input*$data->size/100;
        // Set days
        ($type == 'fe_ot_perc') ? $data->fe_ot_days = $getDaysEst : $data->be_ot_days = $getDaysEst;

        $data->save();
        $this->editProject = Project::findOrfail($id);
        $this->mount();
        $this->render();
    }

    /** Set project to done or delete *********************************************************************************/
    public function deleteProject($id) {
        // Hitta projektet
        $project = Project::findOrFail($id);
        $this->editProject = null;

        // Ta bort projektet från projects
        $project->delete();

        // Uppdatera ordningen för resterande projekt
        $this->updateProjectOrders();

        // Uppdatera listan
        $this->mount();
        $this->render();
        $this->sliderEdit = false;

    }

    public function doneProject($id) {
        // Hitta projektet
        $project = Project::findOrFail($id);
        $this->editProject = null;

        // Kopiera projektet till done_projects
        DB::table('done_projects')->insert([
            'user_id' => $project->user_id,
            'order' => $project->order,
            'name' => $project->name,
            'project_type_id' => $project->project_type_id,
            'link' => $project->link,
            'comment' => $project->comment,
            'size' => $project->size,
            'be_days' => $project->be_days,
            'fe_days' => $project->fe_days,
            'ma_days' => $project->ma_days,
            'be_ot_days' => $project->be_ot_days,
            'fe_ot_days' => $project->fe_ot_days,
            'be_perc' => $project->be_perc,
            'fe_perc' => $project->fe_perc,
            'ma_perc' => $project->ma_perc,
            'be_ot_perc' => $project->be_ot_perc,
            'fe_ot_perc' => $project->fe_ot_perc,
            'fe_points' => $project->fe_points,
            'be_points' => $project->be_points,
            'fe_ot_points' => $project->fe_ot_points,
            'be_ot_points' => $project->be_ot_points,
            'fe_progress_points' => $project->fe_progress_points,
            'be_progress_points' => $project->be_progress_points,
            'total_time' => $project->total_time,
            'cost' => $project->cost,
            'cycle_nr' => $project->cycle_nr,
            'created_at' => $project->created_at,
            'updated_at' => $project->updated_at,
            'done_date' =>  date('Y-m-d'),
        ]);

        // Ta bort projektet från projects
        $project->delete();

        // Uppdatera ordningen för resterande projekt
        $this->updateProjectOrders();

        // Uppdatera listan
        $this->mount();
        $this->render();
        $this->sliderEdit = false;
    }

    private function updateProjectOrders()
    {
        $projects = Project::orderBy('order')->get();

        foreach ($projects as $index => $project) {
            $project->order = $index + 1;
            $project->save();
        }
    }


    /** Render ********************************************************************************************************/
    public function render()
    {

        $this->set = PlaningSettings::first();
        $this->cycleNumber = $this->getCurrentCycle()['Cykel nr'];

        return view('livewire.app.planing.sec.set-project',[
            'listProjects'  =>  $this->projects,
            'doneProjects'  =>  DoneProject::all(),
            'types'         =>  ProjectType::all(),
        ]);

    }
}
