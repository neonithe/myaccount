<?php

namespace App\Livewire\App\Message;

use Livewire\Attributes\On;
use Livewire\Component;

class Message extends Component
{
    public $showSuccessMessage = false, $error = false;
    public $message, $submessage;

    #[On('successmessage')]
    public function newMessage($message, $submessage = null, $error = false)
    {
        $this->showSuccessMessage = true;
        $this->message = $message;
        $this->submessage = $submessage;
        $this->error = $error;

        $this->dispatch('alert-hide');
    }

    public function render()
    {
        return view('livewire.app.message.message');
    }
}
