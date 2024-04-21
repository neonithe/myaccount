<div x-show="state === 'done'">
    <dl class="mt-2 divide-y divide-gray-200 border-b border-t border-gray-200">
        @foreach ($doneTodos as $key => $item)
            <div class="flex justify-between py-2 text-sm font-medium">
                <dt class="text-gray-700 grow pr-2 flex justify-between">
                    <div class="grow">
                        <input wire:keydown.enter="changeToDo({{ $item->id }}, $event.target.value)" type="text" value="{{ $item->todo }}" class="py-1 px-2 rounded-md text-sm w-full border-0 text-gray-900 dark:text-white dark:bg-gray-800">
                    </div>
                    <div class="mt-1.5 text-gray-600 dark:text-white">
                        Done: {{$item->done_date}}
                    </div>
                </dt>
                <dd class="text-gray-900">
                    <button wire:click="todoCheck({{$item->id}})" class="inline-flex flex-shrink-0 items-center rounded-md bg-blue-500 hover:bg-blue-600 px-1 py-1 text-xs font-medium text-gray-200 ring-1 ring-inset ring-gray-100/20 ">
                        <x-app.icons.arrow-up class="h-5 w-5" />
                    </button>
                    <button wire:click="deleteTodo({{$item->id}})" class="inline-flex flex-shrink-0 items-center rounded-md bg-red-500 hover:bg-red-600 px-1 py-1 text-xs font-medium text-gray-200 ring-1 ring-inset ring-gray-100/20">
                        <x-app.icons.trash class="h-5 w-5" />
                    </button>
                </dd>
            </div>
        @endforeach
    </dl>
    <div class="mt-2">
        {{ $doneTodos->links() }}
    </div>
</div>
