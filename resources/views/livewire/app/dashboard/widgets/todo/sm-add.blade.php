<div x-data="{more: false, add: false, search: false}" class="fixed inset-x-0 bottom-0 bg-gray-800 text-white px-2 pb-4 pt-1 sm:hidden border-t">

    <div x-show="add">
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-2">

            <div class="col-span-2">
                <div>
                    <input wire:model="todo" wire:keydown.enter="addTodo" type="text" class="py-1 bg-gray-600 rounded-md w-full" placeholder="Todo">
                </div>
            </div>

            <div x-show="more" class="col-span-2 grid grid-cols-2 sm:grid-cols-3 gap-2">

                <div class="col-span-2 sm:col-span-1">
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
                            <button wire:click="toggleStates('prio')" @if ($setPrio) x-tooltip="Remove prio" @else x-tooltip="Set as prio" @endif
                            class="border border-white text-white @if ($setPrio) bg-red-600 hover:bg-red-700 @else hover:bg-red-700 @endif p-1 rounded-md">
                                <x-app.icons.varning class="h-6 w-6" />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="text-sm">Link</label>
                    <div>
                        <input wire:model="link" type="text" class="py-1 bg-gray-600 rounded-md w-full">
                    </div>
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label class="text-sm">Reminder</label>
                    <div>
                        <input wire:model="remind_day" type="date" class="py-1 bg-gray-600 rounded-md w-full">
                    </div>
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label class="text-sm">Repeat date</label>
                    <div>
                        <input wire:model="repeat" type="date" class="py-1 bg-gray-600 rounded-md w-full">
                    </div>
                </div>

                <div>
                    <label class="text-sm sm:col-span-1">Time</label>
                    <div>
                        <input wire:model="remind_time" type="time" class="py-1 bg-gray-600 rounded-md w-full">
                    </div>
                </div>

                <div class="sm:col-span-1">
                    <label class="text-sm">Day</label>
                    <div>
                        <select wire:model="remind_day" class="py-1 bg-gray-600 rounded-md w-full">
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
                    <textarea wire:model="comment" rows="5" class="py-1 bg-gray-600 rounded-md w-full"></textarea>
                </div>
            </div>


            <div class="col-start-2 sm:col-start-3 flex gap-2">
                <button @click="more = !more" class="px-3 w-full border border-white text-white hover:bg-green-700 p-1 rounded-md">
                    More
                </button>
                <button wire:click="addTodo" class="px-3 w-full border border-white text-white hover:bg-green-700 p-1 rounded-md">
                    Create
                </button>
            </div>

        </div>
    </div>

    <div x-show="search" class="pt-2">
        <div class="grid grid-cols-2 gap-2 border-b pb-3 border-gray-500">
            <div class="col-span-2">
                <input wire:model.live="search" type="text" class="py-1 bg-gray-600 rounded-md w-full" placeholder="Search">
            </div>
            <div x-show="!doneTodo">
                <select wire:model.live="filterType" class="py-1 bg-gray-600 rounded-md w-full">
                    <option value="">Type</option>
                    <option value="notice">Prio</option>
                    <option value="meeting">Meeting</option>
                    <option value="contact">Contact</option>
                    <option value="paused">Paused</option>
                    <option value="remind_date">Remind</option>
                    <option value="repeat">Repeat</option>
                </select>
            </div>
            <div>
                <select wire:model.live="filterPrivate" class="py-1 bg-gray-600 rounded-md w-full">
                    <option value="">Regular</option>
                    <option value="private">Private</option>
                </select>
            </div>
        </div>
    </div>

    <div class="pt-2 flex justify-between gap-2">
        <div>
            <button wire:click="showDone" class="border border-white text-white p-1 rounded-md bg-blue-600">
                <x-app.icons.check class="h-6 w-6" />
            </button>
        </div>
        <div class="flex justify-end gap-2">
            <div>
                <button @click="search = !search, add = false" class="border border-white text-white p-1 rounded-md bg-blue-600">
                    <x-app.icons.mag class="h-6 w-6" />
                </button>
            </div>
            <div>
                <button @click="add = !add, search = false" class="border border-white text-white p-1 rounded-md bg-green-600">
                    <x-app.icons.plus class="h-6 w-6" />
                </button>
            </div>
            <div>
                <button @click="sliderListAddTodo = false" class="border border-white text-white p-1 rounded-md bg-red-600">
                    <x-app.icons.x class="h-6 w-6" />
                </button>
            </div>
        </div>
    </div>

</div>
