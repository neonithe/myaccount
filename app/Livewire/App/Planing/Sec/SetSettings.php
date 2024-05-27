<?php

namespace App\Livewire\App\Planing\Sec;

use App\Models\planing\PlaningSettings;
use Livewire\Component;

class SetSettings extends Component
{
    public function render()
    {
        return view('livewire.app.planing.sec.set-settings',[
            'settings'      =>  PlaningSettings::first(),
        ]);
    }
}
