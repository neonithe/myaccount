<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2 mt-1">
    <div class="flex gap-2 text-white @if ($settings->button_align == 'left') sm:justify-start @else sm:justify-end @endif px-2 sm:px-0 @if ($buttons->count() < 5) justify-end @else justify-between @endif">
        @foreach ($buttons as $button)
            <div class="flex gap-2">
                <div class="border px-1 py-1 rounded-md">
                    @switch($button->button_id)
                        @case(1) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.mail class="h-6 w-6"/></a> @break
                        @case(2) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.calender class="h-6 w-6"/></a> @break
                        @case(3) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.chip class="h-6 w-6"/></a> @break
                        @case(4) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.document class="h-6 w-6"/></a> @break

                        @case(5) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.clock class="h-6 w-6"/></a> @break
                        @case(6) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.folder class="h-6 w-6"/></a> @break
                        @case(7) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.office class="h-6 w-6"/></a> @break
                        @case(8) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.paperclip class="h-6 w-6"/></a> @break

                        @case(9) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.phone class="h-6 w-6"/></a> @break
                        @case(10) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.server class="h-6 w-6"/></a> @break
                        @case(11) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.tools class="h-6 w-6"/></a> @break
                        @case(12) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.credit-card class="h-6 w-6"/></a> @break
                    @endswitch
                </div>
            </div>
        @endforeach
        <button @click="buttonSettings = !buttonSettings" x-tooltip="Settings - Buttons, cycles and so on" class="border px-1 py-1 rounded-md">
            <x-app.icons.gear-1 class="h-6 w-6"/>
        </button>
        @if ($settings->access = 'admin')
            <button @click="adminSettings = !adminSettings" x-tooltip="Settings for Admin Settings" class="border px-1 py-1 rounded-md">
                <x-app.icons.lock class="h-6 w-6"/>
            </button>
        @endif
        @if ($note)
            <div class="ml-4">
                <button @click="notes = !notes" x-tooltip="Notes" class="border px-1 py-1 rounded-md">
                    <x-app.icons.command-line class="h-6 w-6"/>
                </button>
            </div>
        @endif
    </div>
</div>

