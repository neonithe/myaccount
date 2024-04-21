<div class="flex grow">
    <div class="flex grow">
        <div x-show="!smScreenMenu" class="grow">
            <input wire:keydown.enter="changeToDo({{ $item->id }}, $event.target.value)" type="text" value="{{ $item->todo }}" class="w-full py-1 px-2 rounded-md text-sm w-full border border-gray-800 text-gray-900 dark:text-white dark:bg-gray-800">
        </div>
        <div x-show="smScreenMenu" class="flex justify-end grow">
            @if ($item->repeat)
                <div class="pl-2 pt-0.5 text-blue-600"><x-app.icons.update class="h-7 w-7" /></div>
            @endif
            @if ($item->remind_time)
                <div class="pl-2 pt-0.5 text-blue-600 text-xl">{{ date('H:i', strtotime($item->remind_time)) }}</div>
            @endif
            @if ($item->link)
                <div class="-mt-4">
                    <a href="{{ $item->link }}" target="_blank" x-tooltip="{{$item->link}}" class="pl-2 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.link class="h-7 w-7" /></a>
                </div>
            @endif
            @if ($item->comment || $item->link)
                <div>
                    <button @click="moreinfo = !moreinfo" @if ($item->comment)  @else  @endif class="pl-2 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.comment class="h-7 w-7" /></button>
                </div>
            @endif
            @if ($item->paused)
                <div>
                    <button wire:click="toggleState({{ $item->id }}, 'pause')" class="pl-1 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.circle-play class="h-7 w-7" /></button>
                </div>
            @else
                <div>
                    <button wire:click="toggleState({{ $item->id }}, 'pause')" class="pl-1 pt-0.5 text-blue-300 hover:text-blue-600"><x-app.icons.circle-pause class="h-7 w-7" /></button>
                </div>
            @endif
            @if ($item->meeting)
                <div>
                    <button wire:click="toggleState({{ $item->id }}, 'meeting')" class="pl-1 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.meeting class="h-7 w-7" /></button>
                </div>
            @else
                <div>
                    <button wire:click="toggleState({{ $item->id }}, 'meeting')" class="pl-1 pt-0.5 text-blue-300 hover:text-blue-600"><x-app.icons.meeting class="h-7 w-7" /></button>
                </div>
            @endif
            @if ($item->contact)
                <div>
                    <button wire:click="toggleState({{ $item->id }}, 'contact')" class="pl-1 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.phone class="h-7 w-7" /></button>
                </div>
            @else
                <div>
                    <button wire:click="toggleState({{ $item->id }}, 'contact')" class="pl-1 pt-0.5 text-blue-300 hover:text-blue-600"><x-app.icons.phone class="h-7 w-7" /></button>
                </div>
            @endif
            @if ($item->notice)
                <div>
                    <button wire:click="toggleState({{ $item->id }}, 'prio')" @click="setting = 'show'" class="pl-2 pt-0.5 text-red-600 hover:text-blue-500"><x-app.icons.varning class="h-7 w-7" /></button>
                </div>
            @else
                <div>
                    <button wire:click="toggleState({{ $item->id }}, 'prio')" @click="setting = 'show'" class="pl-2 pt-0.5 text-blue-300 hover:text-red-600"><x-app.icons.varning class="h-7 w-7" /></button>
                </div>
            @endif
                <div>
                    <button x-show="!moreinfo" @click="moreinfo = !moreinfo" x-tooltip="Change info" class="mt-1 pl-1 pt-0.5 text-blue-400 hover:text-blue-600"><x-app.icons.tools-fill class="h-5 w-5" /></button>
                    <button x-show="moreinfo" @click="moreinfo = !moreinfo" x-tooltip="Close - Change info" class="mt-1 pl-1 pt-0.5 text-blue-400 hover:text-blue-600"><x-app.icons.tools-fill class="h-5 w-5" /></button>
                </div>
        </div>
    </div>
    <div class="flex">
        @if ($item->notice)
            <div x-show="!smScreenMenu" style="margin-top: 5px">
                <button wire:click="toggleState({{ $item->id }}, 'prio')" @click="setting = 'show'" class="pl-2 pt-0.5 text-red-600 hover:text-blue-500"><x-app.icons.varning class="h-5 w-5" /></button>
            </div>
        @else
            <div x-show="!smScreenMenu" style="margin-top: 5px">
                <button wire:click="toggleState({{ $item->id }}, 'prio')" @click="setting = 'show'" class="pl-2 pt-0.5 text-blue-300 hover:text-red-600"><x-app.icons.varning class="h-5 w-5" /></button>
            </div>
        @endif
        <div>
            <button @click="smScreenMenu = !smScreenMenu, moreinfo = false" class="pl-1 pt-0.5 text-blue-300 hover:text-blue-600"><x-app.icons.circle-dots class="h-7 w-7" /></button>
        </div>
    </div>

</div>
