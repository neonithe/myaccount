<div class="flex grow">
    <div class="grow">
        <input wire:keydown.enter="changeToDo({{ $item->id }}, $event.target.value, 'todo')" type="text" value="{{ $item->todo }}" class="w-full py-1 px-2 rounded-md text-sm w-full border border-white dark:text-white dark:bg-gray-800 dark:border-gray-800">
    </div>

    <div x-show="!moreinfo" class=" flex">
        <div class="flex">
            @if ($item->link)
                <a href="{{ $item->link }}" target="_blank" x-tooltip="{{$item->link}}" class="mt-1 pl-2 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.link class="h-5 w-5" /></a>
            @endif
            @if ($item->comment || $item->link)
                <button @click="moreinfo = !moreinfo" @if ($item->comment) x-tooltip="{{$item->comment}}" @else x-tooltip="Edit link" @endif class="pl-2 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.comment class="h-5 w-5" /></button>
            @endif
        </div>
        <div class="flex">
            @if ($item->repeat)
                <div class="pl-2 pt-1.5 text-blue-600"><x-app.icons.update class="h-5 w-5" /></div>
            @endif
            @if ($item->remind_day)
                <div class="pl-2 pt-1 text-blue-400 text-base">{{ substr($item->remind_day, 0, 3) }}</div>
            @endif
            @if ($item->remind_time)
                <div class="pl-2 pt-1 text-blue-400 text-base">{{ date('H:i', strtotime($item->remind_time)) }}</div>
            @endif
            @if ($item->notice)
                <button wire:click="toggleState({{ $item->id }}, 'prio')" @click="setting = 'show'" x-tooltip="Remove prio" class="pl-2 pt-0.5 text-red-600 hover:text-blue-500"><x-app.icons.varning class="h-5 w-5" /></button>
            @else
                <button wire:click="toggleState({{ $item->id }}, 'prio')" @click="setting = 'show'" x-tooltip="Set as priority" class="pl-2 pt-0.5 text-blue-300 hover:text-red-600"><x-app.icons.varning class="h-5 w-5" /></button>
            @endif
            @if ($item->paused)
                <button wire:click="toggleState({{ $item->id }}, 'pause')" x-tooltip="Unpause" class="pl-1 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.circle-play class="h-5 w-5" /></button>
            @else
                <button wire:click="toggleState({{ $item->id }}, 'pause')" x-tooltip="Set as paused" class="pl-1 pt-0.5 text-blue-300 hover:text-blue-600"><x-app.icons.circle-pause class="h-5 w-5" /></button>
            @endif

            @if ($item->meeting)
                <button wire:click="toggleState({{ $item->id }}, 'meeting')" x-tooltip="Remove meeting" class="pl-1 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.meeting class="h-5 w-5" /></button>
            @else
                <button wire:click="toggleState({{ $item->id }}, 'meeting')" x-tooltip="Set as meeting" class="pl-1 pt-0.5 text-blue-300 hover:text-blue-600"><x-app.icons.meeting class="h-5 w-5" /></button>
            @endif

            @if ($item->contact)
                <button wire:click="toggleState({{ $item->id }}, 'contact')" x-tooltip="Remove - to contact" class="pl-1 pt-0.5 text-amber-400 hover:text-blue-500"><x-app.icons.phone class="h-5 w-5" /></button>
            @else
                <button wire:click="toggleState({{ $item->id }}, 'contact')" x-tooltip="Set as - to contact" class="pl-1 pt-0.5 text-blue-300 hover:text-blue-600"><x-app.icons.phone class="h-5 w-5" /></button>
            @endif
        </div>
    </div>

    <div style="padding-top: 0px;">
        <button x-show="!moreinfo" @click="moreinfo = !moreinfo" x-tooltip="Change info" class="mt-1 pl-1 pt-0.5 text-blue-400 hover:text-blue-600"><x-app.icons.tools-fill class="h-5 w-5" /></button>
        <button x-show="moreinfo" @click="moreinfo = !moreinfo" x-tooltip="Close - Change info" class="pl-1 text-red-500 hover:text-blue-500 border rounded-md px-1 py-1"><x-app.icons.x class="h-5 w-5" /></button>
    </div>
</div>
