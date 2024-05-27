

@if (!$sliderShow)
<div class="uppercase tracking-widest border-b pb-1 mb-1">
    Show/edit todo
</div>
@endif

<div class="grid grid-cols-2 sm:grid-cols-3 gap-2">

    <div class="col-span-2">
        <label class="text-sm">Todo</label>
        <div class="w-full">
            <input wire:model="todo" wire:keydown.enter="addTodo" type="text" class="py-1 bg-gray-700 rounded-md w-full">
        </div>
    </div>

    <div class="col-span-2 sm:col-span-1">
        <label class="text-sm">Set type</label>
        <div class="flex justify-between gap-2">
            <div>
                <button wire:click="toggleStates('meeting')" @if ($setMeeting) x-tooltip="Remove meeting" @else x-tooltip="Set as meeting" @endif
                class="border border-white text-white @if ($setMeeting) bg-green-600 hover:bg-green-700 @else hover:bg-blue-700 @endif p-1 rounded-md">
                    <x-app.icons.meeting class="h-6 w-6" />
                </button>
            </div>
            <div>
                <button wire:click="toggleStates('contact')" @if ($setContact) x-tooltip="Remove contact" @else x-tooltip="Set as contact" @endif
                class="border border-white text-white @if ($setContact) bg-green-600 hover:bg-green-700 @else hover:bg-blue-700 @endif p-1 rounded-md">
                    <x-app.icons.phone class="h-6 w-6" />
                </button>
            </div>
            <div>
                <button wire:click="toggleStates('private')" @if ($setPrivate) x-tooltip="Remove private" @else x-tooltip="Set as private" @endif
                class="border border-white text-white @if ($setPrivate) bg-green-600 hover:bg-green-700 @else hover:bg-blue-700 @endif p-1 rounded-md">
                    <x-app.icons.fingerprint class="h-6 w-6" />
                </button>
            </div>
            <div>
                <button wire:click="toggleStates('pause')" @if ($setPause) x-tooltip="Remove pause" @else x-tooltip="Set as paused" @endif
                class="border border-white text-white @if ($setPause) bg-green-600 hover:bg-green-700 @else hover:bg-blue-700 @endif p-1 rounded-md">
                    <x-app.icons.circle-pause class="h-6 w-6" />
                </button>
            </div>
            <div>
                <button wire:click="toggleStates('notice')" @if ($setPrio) x-tooltip="Remove prio" @else x-tooltip="Set as prio" @endif
                class="border border-white text-white @if ($setPrio) bg-red-600 hover:bg-red-700 @else hover:bg-red-700 @endif p-1 rounded-md">
                    <x-app.icons.varning class="h-6 w-6" />
                </button>
            </div>
        </div>
    </div>

    <div class="col-span-2">
        <label class="text-sm">Link</label>
        <div>
            <input wire:model="link" type="text" class="py-1 bg-gray-700 rounded-md w-full">
        </div>
    </div>

    <div class="col-span-1">
        <label class="text-sm">Reminder</label>
        <div>
            <input wire:model="remind_date" type="date" class="py-1 bg-gray-700 rounded-md w-full">
        </div>
    </div>

    <div class="col-span-1">
        <label class="text-sm">Repeat</label>
        <div>
            <input wire:model="repeat" type="date" class="py-1 bg-gray-700 rounded-md w-full">
        </div>
    </div>

    <div class="col-span-1">
        <label class="text-sm">Time</label>
        <div>
            <input wire:model="remind_time" type="time" class="py-1 bg-gray-700 rounded-md w-full">
        </div>
    </div>

    <div class="col-span-1">
        <label class="text-sm">Day</label>
        <div>
            <select wire:model="remind_day" class="py-1 bg-gray-700 rounded-md w-full">
                <option value="">Day</option>
                <option value="Monday" >Monday</option>
                <option value="Tuesday" >Tuesday</option>
                <option value="Wednesday" >Wednesday</option>
                <option value="Thursday" >Thursday</option>
                <option value="Friday" >Friday</option>
                <option value="Saturday" >Saturday</option>
                <option value="Sunday" >Sunday</option>
            </select>
        </div>
    </div>

    <div class="col-span-2 sm:col-span-3">
        <label class="text-sm">Comment</label>
        <textarea wire:model="comment" rows="5" class="py-1 bg-gray-700 rounded-md w-full hidden sm:block"></textarea>
        <textarea wire:model="comment" rows="2" class="py-1 bg-gray-700 rounded-md w-full block sm:hidden"></textarea>
    </div>

    <div class="col-span-2 sm:col-span-3 mb-16 sm:mb-2">
        <div class="flex justify-between">
            <div>
                @if ($tempTodo)
                    <div class="flex gap-2">
                        <button wire:click="deleteTodo({{$tempTodo->id}}, true)" class="px-3 border border-white text-white hover:bg-red-700 p-1 rounded-md">
                            Delete todo
                        </button>
                    </div>
                @endif
            </div>
            <div class="flex gap-2">
                <button wire:click="updateTodo" class="px-3 w-full border border-white text-white hover:bg-green-700 p-1 rounded-md">
                    Update
                </button>
                <button wire:click="closeEditModal" class="px-3 w-full border border-white text-white hover:bg-red-700 p-1 rounded-md">
                    Close
                </button>
            </div>
        </div>
    </div>

</div>

