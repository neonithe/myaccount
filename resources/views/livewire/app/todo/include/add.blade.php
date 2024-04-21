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

    <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
        <div>
            <label class="text-xs">Datum påminnelse</label>
            <input wire:model="remind_date" type="date" class="text-sm border rounded-md py-1.5 px-2 w-full text-gray-900 dark:text-white dark:bg-gray-700">
        </div>
        <div>
            <label class="text-xs">Datum upprepning</label>
            <input wire:model="repeat" type="date" class="text-sm border rounded-md py-1.5 px-2 w-full text-gray-900 dark:text-white dark:bg-gray-700">
        </div>
        <div>
            <label class="text-xs">Tid</label>
            <input wire:model="time" type="time" class="text-sm border rounded-md py-1.5 px-2 w-full text-gray-900 dark:text-white dark:bg-gray-700">
        </div>
        <div>
            <div class="flex gap-1 mt-6 justify-end">
                @if ($setPrio)
                    <div>
                        <button wire:click="setPrioToggle" x-tooltip="Remove prio" class="border border-red-600 text-red-600 bg-red-100 p-1 rounded-md hover:bg-gray-100 hover:text-gray-700 hover:border-gray-300 text-gray-900 dark:text-white dark:bg-gray-700">
                            <x-app.icons.varning class="h-6 w-6" />
                        </button>
                    </div>
                @else
                    <div>
                        <button wire:click="setPrioToggle" x-tooltip="Set prio" class="border border-gray-300 p-1 rounded-md hover:bg-red-400 hover:text-white hover:border-red-600">
                            <x-app.icons.varning class="h-6 w-6" />
                        </button>
                    </div>
                @endif
                <div>
                    <button @click="more = !more" class="border border-blue-600 text-blue-600 bg-blue-100 p-1 rounded-md hover:bg-blue-100 hover:text-gray-700 hover:border-blue-300">
                        <x-app.icons.comment class="h-6 w-6" />
                    </button>
                </div>
                <div>
                    <button wire:click="addTodo" class="border border-green-600 text-green-600 bg-green-100 p-1 rounded-md hover:bg-green-100 hover:text-gray-700 hover:border-green-300">
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
