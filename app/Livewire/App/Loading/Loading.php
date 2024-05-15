<?php

namespace App\Livewire\App\Loading;

use Livewire\Attributes\On;
use Livewire\Component;

class Loading extends Component
{

    #[On('runloading')]
    public function runLoading() {
        sleep(3);
    }

    public function render()
    {
        return view('livewire.app.loading.loading');
    }
}
