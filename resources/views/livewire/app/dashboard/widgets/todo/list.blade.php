<div class="border rounded-md p-3 bg-gray-700 text-white border-gray-600">

    <div x-show="!showModal" class="flex flex-wrap gap-2 border-b pb-3 border-gray-500">
        <div class="grow">
            <input wire:model.live="search" type="text" class="py-1 bg-gray-600 rounded-md w-full" placeholder="Search">
        </div>
        <div x-show="!doneTodo">
            <select wire:model.live="filterType" class="py-1 bg-gray-600 rounded-md">
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
            <select wire:model.live="filterPrivate" class="py-1 bg-gray-600 rounded-md">
                <option value="">Regular</option>
                <option value="private">Private</option>
            </select>
        </div>
    </div>

    <div x-show="showModal">
        @include('livewire.app.dashboard.widgets.todo.list-edit')
    </div>

    <div x-show="!showModal">
        @foreach ($todos as $todo)
            <div class="border-b flex justify-between border-gray-500 gap-3 hover:bg-gray-600">
                <div class="grow">
                    <button wire:click="openEditModal({{$todo->id}}, 'true')"
                            class=" text-start px-2 py-2 w-full rounded-md truncate">
                        {{$todo->todo}}
                    </button>
                </div>
                <div class="flex gap-1 mt-2 pr-2">
                    <div>
                        <button @if ($filterType != 'done') wire:click="checkTodo({{$todo->id}})"
                                @else wire:click="returnTodo({{$todo->id}})" @endif
                                class="p-0.5 border rounded-md hover:bg-blue-600 @if ($filterType == 'done') bg-blue-500 @endif">
                            @if ($filterType != 'done')
                                <x-app.icons.check class="h-4 w-4"/>
                            @else
                                <x-app.icons.arrow-up class="h-4 w-4"/>
                            @endif
                        </button>
                        @if ($filterType == 'done')
                            <button wire:click="deleteTodo({{$todo->id}})"
                                    class="p-0.5 border rounded-md hover:bg-red-600 bg-red-500">
                                <x-app.icons.trash class="h-4 w-4"/>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div x-show="!showModal" class="mt-3">
        {{$todos->links()}}
    </div>

</div>
