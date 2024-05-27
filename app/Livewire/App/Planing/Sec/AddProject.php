<?php

namespace App\Livewire\App\Planing\Sec;

use Livewire\Component;

class AddProject extends Component
{
    public $name, $size;
    public $addFePerc, $addBePerc;

    public function render()
    {
        return view('livewire.app.planing.sec.add-project');
    }
}
