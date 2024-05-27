<?php

namespace App\Livewire\App\Planing\Sec;

use App\Models\planing\Project;
use App\Models\planing\ProjectBacklog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function Termwind\render;

class SetProjectBacklog extends Component
{
    public $filterQ, $listBackLog;
    public $name, $link, $prio, $fe = 50, $be = 50, $quarter, $size, $comment;
    public $editProject, $editSlider = false;

    public function mount() {
        $this->listBackLog = ProjectBacklog::orderBy('prio', 'asc')->get();
    }

    /** Add Project ***************************************************************************************************/
    public function addProject() {
        ProjectBacklog::create([
            'user_id'   =>  Auth::id(),
            'name'      =>  $this->name,
            'link'      =>  $this->link,
            'size'      =>  $this->size ?? 5,
            'fe_perc'   =>  $this->fe,
            'be_perc'   =>  $this->be,
            'comment'   =>  $this->comment,
            'quarter'   =>  $this->quarter ?? 0,
            'prio'      =>  ($this->prio) ? $this->prio : 1,
            'project_type_id' => 5,
        ]);
        $this->mount();
        $this->render();
    }

    /** Edit projekt **************************************************************************************************/
    public function changeProject($id, $type, $input) {
        $data = ProjectBacklog::findOrFail($id);
        $data->$type = $input;
        $data->save();
        $this->mount();
        $this->render();
    }

    public function setPrio($id, $value) {
        $project = ProjectBacklog::findOrFail($id);
        $project->prio = $value;
        $project->save();
        $this->mount();
        $this->render();
    }

    public function openEdit($id) {
        $this->editProject = ProjectBacklog::findOrFail($id);
        $this->name = $this->editProject->name;
        $this->link = $this->editProject->link;
        $this->quarter = $this->editProject->quarter;
        $this->prio = $this->editProject->prio;
        $this->size = $this->editProject->size;
        $this->fe = $this->editProject->fe_perc;
        $this->be = $this->editProject->be_perc;
        $this->comment = $this->editProject->comment;

        $this->editSlider = true;
    }


    /** Move projekt **************************************************************************************************/
    public function addToActive($id) {
        // Hitta det sista ordningsnumret i Projects
        $lastOrder = Project::max('order');
        $newOrder = $lastOrder + 1;

        // Hämta projektet från ProjectBacklog
        $backlogProject = ProjectBacklog::findOrFail($id);

        // Göra om procent till dagar
        $beDays = $backlogProject->size*$backlogProject->be_perc/100;
        $feDays = $backlogProject->size*$backlogProject->fe_perc/100;

        // Skapa ett nytt projekt i Projects med informationen från ProjectBacklog
        Project::create([
            'user_id'       => $backlogProject->user_id,
            'order'         => $newOrder,
            'name'          => $backlogProject->name,
            'project_type_id' => 3, // 5 = Backlog / 4 = Discovery / 3 = Planing
            'link'          => $backlogProject->link,
            'comment'       => $backlogProject->comment,
            'size'          => 5,
            'be_days'       => $beDays,
            'fe_days'       => $feDays,
            'be_ot_days'    => 0,
            'fe_ot_days'    => 0,
            'be_perc'       => $backlogProject->be_perc,
            'fe_perc'       => $backlogProject->fe_perc,
            'be_ot_perc'    => 0,
            'fe_ot_perc'    => 0,

            // From backlog
            'quarter'   =>  $backlogProject->quarter,
            'prio'      =>  $backlogProject->prio,
        ]);

        // Ta bort projektet från ProjectBacklog
        $backlogProject->delete();

        // Uppdatera listan
        $this->mount();
        $this->render();
        $this->dispatch('runandupdateproject');
        $this->dispatch('successmessage', 'Backlog', 'Project added to active projects.');
    }

    /** Delete projekt ************************************************************************************************/
    public function delete($id) {
        ProjectBacklog::findOrFail($id)->delete();
        $this->dispatch('successmessage', 'Backlog', 'Project deleted successfully.');
        $this->mount();
        $this->render();
    }

    /** Change projekt ************************************************************************************************/


    public function render()
    {

        if ($this->filterQ) {
            $this->listBackLog->where('quarter', $this->filterQ);
        }
        return view('livewire.app.planing.sec.set-project-backlog',[
            'backlog'       =>  $this->listBackLog,
        ]);
    }
}
