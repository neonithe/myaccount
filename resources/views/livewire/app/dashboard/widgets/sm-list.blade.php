<div class="">

    <div x-show="showModal">
        @include('livewire.app.dashboard.widgets.list-edit')
    </div>

    <div x-show="!showModal">
        @foreach ($todos as $todo)
            <div class="border-b flex justify-between border-gray-500 gap-3 hover:bg-gray-600">
                <div class="grow">
                    <button wire:click="openEditModal({{$todo->id}}, 'true')" class=" text-start px-2 py-2 w-full rounded-md truncate">
                        {{$todo->todo}}
                    </button>
                </div>
                <div class="flex gap-1 mt-2 pr-2">
                    <div>
                        <button @if ($filterType != 'done') wire:click="checkTodo({{$todo->id}})" @else wire:click="returnTodo({{$todo->id}})" @endif
                            class="p-0.5 border rounded-md hover:bg-blue-600 @if ($filterType == 'done') bg-blue-500 @endif">
                            @if ($filterType != 'done') <x-app.icons.check class="h-4 w-4" /> @else <x-app.icons.arrow-up class="h-4 w-4" /> @endif
                        </button>
                        @if ($filterType == 'done')
                            <button wire:click="deleteTodo({{$todo->id}})" class="p-0.5 border rounded-md hover:bg-red-600 bg-red-500">
                                <x-app.icons.trash class="h-4 w-4" />
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div x-show="!showModal" class="mt-3 mb-32">
        {{$todos->links()}}
    </div>

</div>
