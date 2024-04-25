<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2 mt-1">
    <div class="flex gap-2 text-white @if ($settings->button_align == 'left') sm:justify-start @else sm:justify-end @endif px-2 sm:px-0 @if ($buttons->count() < 5) justify-end @else justify-between @endif">
        @foreach ($buttons as $button)
            <div class="flex gap-2">
                <div class="border px-1 py-1 rounded-md">
                    @switch($button->button_id)
                        @case(0) <a href="{{$this->getLink($button->link_id)}}" target="_blank"><x-app.icons.mail class="h-6 w-6"/></a> @break
                        @case(1) <x-app.icons.mail class="h-6 w-6"/> @break
                        @case(2) <x-app.icons.calender class="h-6 w-6"/> @break
                        @case(3) <x-app.icons.chip class="h-6 w-6"/> @break
                        @case(4) <x-app.icons.document class="h-6 w-6"/> @break

                        @case(5) <x-app.icons.clock class="h-6 w-6"/> @break
                        @case(6) <x-app.icons.folder class="h-6 w-6"/> @break
                        @case(7) <x-app.icons.office class="h-6 w-6"/> @break
                        @case(8) <x-app.icons.paperclip class="h-6 w-6"/> @break

                        @case(9) <x-app.icons.phone class="h-6 w-6"/> @break
                        @case(10) <x-app.icons.server class="h-6 w-6"/> @break
                        @case(11) <x-app.icons.tools class="h-6 w-6"/> @break
                        @case(12) <x-app.icons.credit-card class="h-6 w-6"/> @break
                    @endswitch
                </div>
            </div>
        @endforeach
        <button @click="buttonSettings = !buttonSettings" class="border px-1 py-1 rounded-md">
            <x-app.icons.gear-1 class="h-6 w-6"/>
        </button>
        @if ($settings->access = 'admin')
            <button @click="adminSettings = !adminSettings" class="border px-1 py-1 rounded-md">
                <x-app.icons.lock class="h-6 w-6"/>
            </button>
        @endif
    </div>
</div>

