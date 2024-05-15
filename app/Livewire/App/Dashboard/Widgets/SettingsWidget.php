<?php

namespace App\Livewire\App\Dashboard\Widgets;

use App\Models\link\Link;
use App\Models\link\SpeedButton;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SettingsWidget extends Component
{
    // Settings
    public $settings;
    public $typeOfSettings = 'regular';

    public function mount() {
        $this->settings = Settings::where('user_id', Auth::id())->first();
    }

    /** Speedbuttons **************************************************************************************************/
    public function getButtonLink($id) {
        $data = SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first();
        (!$data) ? $res = null : $res = Link::findOrfail($data->link_id)->id;
        return $res;
    }

    public function getOrder($id) {
        if ( $data = SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first() ) {
            return $data->order;
        } else {
            return 0;
        }
    }

    public function changeOrder($id, $orderNr) {
        $data = SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first();
        $data->order = $orderNr;
        $data->save();
        $this->dispatch('successmessage', 'Link button', 'Order has been changed.' );
    }

    public function setButtonLink($id, $linkId) {
        if (!$linkId) {
            SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first()->delete();
            $this->dispatch('successmessage', 'Link button', 'Button link is now removed.' );
        } else {
            if ( $data = SpeedButton::where('user_id', Auth::id())->where('button_id', $id)->first() ) {
                $data->link_id = $linkId;
                $data->save();
                $this->dispatch('successmessage', 'Link button', 'Button link is now changed.' );
            } else {
                SpeedButton::create(['user_id' => Auth::id(), 'button_id' => $id, 'link_id' => $linkId, 'order' => 1]);
                $this->dispatch('successmessage', 'Link button', 'Button link is now set.' );
            }
        }
    }

    public function getLink($id) {
        return Link::findOrFail($id)->link;
    }

    public function buttonAlign($value) {
        $data = Settings::where('user_id', Auth::id())->first();
        $data->button_align = $value;
        $data->save();
        $this->render();
    }

    public function getLinkName($id) {
        return Link::findOrFail($id)->name;
    }

    public function settingsType($type) {
        $this->typeOfSettings = 'admin';
    }

    public function changePrivateStatus() {
        ($this->settings->private) ? $this->settings->private = false : $this->settings->private = true;
        $this->settings->save();
        $this->dispatch('renderTodo');
    }

    public function openTodo() {
        $this->dispatch('openTodo');
    }

    public function render()
    {
        return view('livewire.app.dashboard.widgets.settings-widget',[
            'allLinks'      =>  Link::where('user_id', Auth::id())->get(),
            'buttons'       =>  SpeedButton::where('user_id', Auth::id())->orderBy('order', 'ASC')->get(),
        ]);
    }
}
