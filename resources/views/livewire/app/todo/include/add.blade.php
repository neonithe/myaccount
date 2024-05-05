<div class="pb-4 max-h-84 overflow-auto">

    <div class="flex justify-between">
        <div class="mt-1.5"><h3 class="font-medium text-gray-900 dark:text-white">Add new todo</h3></div>
        <div>

        </div>
    </div>

    <div class="mt-2 flex items-center gap-2">
        <div class="grow">
            <input wire:model="todo" wire:keydown.enter="inputAddTodo($event.target.value)" type="text" class="py-1 px-2 rounded-md w-full border border-blue-300 text-gray-900 dark:text-white dark:bg-gray-700">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-2 sm:grid-cols-5">

        <div>
            <label class="text-xs">Datum påminnelse</label>
            <input wire:model="remind_date" type="date" class="text-sm border rounded-md py-1.5 px-2 w-full text-gray-900 dark:text-white dark:bg-gray-700">
        </div>

        <div>
            <label class="text-xs">Datum upprepning</label>
            <input wire:model="repeat" type="date" class="text-sm border rounded-md py-1.5 px-2 w-full text-gray-900 dark:text-white dark:bg-gray-700">
        </div>

        <div>
            <label class="text-xs">Mötes Tid</label>
            <input wire:model="time" type="time" class="text-sm border rounded-md py-1.5 px-2 w-full text-gray-900 dark:text-white dark:bg-gray-700">
        </div>

        <div>
            <label class="text-xs">Mötes Dag</label>
            <select wire:model="day" class="text-sm border rounded-md py-1.5 px-2 w-full text-gray-900 dark:text-white dark:bg-gray-700">
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

        <div class="col-span-2 sm:col-span-1">
            <div class="flex gap-1 mt-6 justify-end">
                <div>
                    <button wire:click="toggleStates('meeting')" @if ($setMeeting) x-tooltip="Remove meeting" @else x-tooltip="Set as meeting" @endif
                            class="border border-white text-white @if ($setMeeting) bg-green-600 hover:bg-green-700 @else hover:bg-blue-700 @endif p-1 rounded-md">
                        <x-app.icons.meeting class="h-6 w-6" />
                    </button>
                </div>
                <div class="pr-3">
                    <button wire:click="toggleStates('contact')" @if ($setContact) x-tooltip="Remove contact" @else x-tooltip="Set as contact" @endif
                            class="border border-white text-white @if ($setContact) bg-green-600 hover:bg-green-700 @else hover:bg-blue-700 @endif p-1 rounded-md">
                        <x-app.icons.phone class="h-6 w-6" />
                    </button>
                </div>
                <div class="pr-3">
                    <button wire:click="toggleStates('private')" @if ($setPrivate) x-tooltip="Remove private" @else x-tooltip="Set as private" @endif
                    class="border border-white text-white @if ($setPrivate) bg-green-600 hover:bg-green-700 @else hover:bg-blue-700 @endif p-1 rounded-md">
                        <x-app.icons.fingerprint class="h-6 w-6" />
                    </button>
                </div>
                @if ($setPrio)
                    <div>
                        <button wire:click="toggleStates('prio')" x-tooltip="Remove prio" class="border border-red-600 text-red-600 bg-red-100 p-1 rounded-md hover:bg-gray-100 hover:text-gray-700 hover:border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700">
                            <x-app.icons.varning class="h-6 w-6" />
                        </button>
                    </div>
                @else
                    <div>
                        <button wire:click="toggleStates('prio')" x-tooltip="Set prio" class="border border-gray-300 p-1 rounded-md hover:bg-red-400 hover:text-white hover:border-red-600">
                            <x-app.icons.varning class="h-6 w-6" />
                        </button>
                    </div>
                @endif
                <div>
                    <button @click="more = !more" class="border border-white text-white bg-blue-600 hover:bg-blue-700 p-1 rounded-md">
                        <x-app.icons.comment class="h-6 w-6" />
                    </button>
                </div>
                <div>
                    <button wire:click="addTodo" class="border border-white text-white bg-green-600 hover:bg-green-700 p-1 rounded-md">
                        <x-app.icons.check class="h-6 w-6" />
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="more" class="mt-2">
        <div class="mb-2 w-full flex rounded-md border dark:bg-gray-700">
            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm ">http://</span>
            <input wire:model="link" type="text" name="company-website" id="company-website" class="w-full block flex-1 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 border-0 dark:bg-gray-700" placeholder="www.example.com">
        </div>
        <div>
            <textarea wire:model="comment" cols="30" rows="5" class="w-full rounded-md border-gray-200 dark:bg-gray-700" placeholder="Comment"></textarea>
        </div>
    </div>

</div>
