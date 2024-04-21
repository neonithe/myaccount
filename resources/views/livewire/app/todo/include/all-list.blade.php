<div x-show="state === 'todo' || state === 'paused' || state === 'prio' || state === 'remind' || state === 'regular' || state === 'meeting' || state === 'contact'">

    <div class="flex gap-2 mt-2 sm:mt-0">
        <input wire:model.live="search" type="text" class="py-1 px-2 rounded-md w-full border-gray-200 text-gray-900 dark:text-white dark:bg-gray-700" placeholder="Search">
    </div>

    <div>
        <dl class="mt-2 divide-y divide-gray-200 border-b border-t border-gray-200">
            @foreach ($openTodos as $key => $item)
                <div x-data="{setting: 'show', moreinfo: false, state: false, smScreenMenu: false}" class="py-2 text-sm font-medium">
                    <div class="flex justify-between ">
                        <dt class="text-gray-700 grow pr-2 flex justify-between">
                            <div class="grow flex">
                                <div class="grow">

                                    <div class="hidden sm:block">
                                        @include('livewire.app.todo.include.lg-item-buttons')
                                    </div>
                                    <div class="block sm:hidden">
                                        @include('livewire.app.todo.include.sm-item-buttons')
                                    </div>

                                    @if ($item->remind_date)
                                        <div x-show="setting === 'show'" class="text-xs inline-flex pl-2">
                                            <div class="pr-1 pt-0.5 text-red-600"><x-app.icons.bell-1 class="h-3 w-3" /></div>
                                            <button @click="setting = 'changedate'" class="text-red-600 hover:underline">{{$item->remind_date}}</button>
                                        </div>
                                        <div x-show="setting === 'changedate'" class="text-xs inline-flex pl-2">
                                            <div class="pr-1 pt-1 text-red-600">
                                                <button wire:click="removeDate({{$item->id}})"><x-app.icons.bell-1 class="h-5 w-5" /></button>
                                            </div>
                                            <div><input wire:change="changeRemDate({{$item->id}}, $event.target.value)" value="{{$item->remind_date}}" type="date" class="text-sm border rounded-md py-0.5 px-2 w-full"></div>
                                            <div><button @click="setting = 'show'" class="ml-1 border py-0.5 px-0.5 rounded-md hover:bg-gray-50"><x-app.icons.arrow-right class="h-5 w-5" /></button> </div>
                                        </div>
                                    @elseif($item->repeat)
                                        <div class="text-xs inline-flex pl-2">
                                            <div class="pr-1 pt-0.5 text-blue-300"><x-app.icons.update class="h-3 w-3" /></div>
                                            <div class="text-blue-300">{{$item->repeat}}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </dt>
                        <dd class="text-gray-900">
                            <button wire:click="todoCheck({{$item->id}})" class="border border-gray-300 p-0.5 rounded-md hover:bg-blue-50 hover:border-gray-500">
                                <x-app.icons.check class="h-6 w-6" />
                            </button>
                        </dd>
                    </div>

                    <div x-show="moreinfo" class="mt-1">
                        <div class="block sm:hidden pb-1.5">
                            <input wire:keydown.enter="changeToDo({{ $item->id }}, $event.target.value)" type="text" value="{{ $item->todo }}" class="w-full py-1 px-2 rounded-md text-sm w-full border border-gray-500 text-gray-900 dark:text-white dark:bg-gray-800">
                        </div>
                        <div class=" mb-1.5 flex gap-2 flex-wrap">
                            <input wire:keydown.enter="changeLinkToDo({{ $item->id }}, $event.target.value)" type="text" value="{{ $item->link }}" placeholder="http://" class="w-full py-1 px-2 rounded-md text-sm w-full border border-gray-500 text-gray-900 dark:text-white dark:bg-gray-800">
                        </div>
                        <div class="flex justify-end gap-2 pb-2 flex-wrap">
                            <div class="flex gap-2">
                                <div class="mt-1" x-tooltip="Set time"><x-app.icons.clock class="h-6 w-6"/></div>
                                <input wire:keydown.enter="changeTime({{ $item->id }}, $event.target.value)" type="time" value="{{ $item->remind_time }}" class="w-full py-1 px-2 rounded-md text-sm w-full border border-gray-500 text-gray-900 dark:text-white dark:bg-gray-800">
                                @if ($item->remind_time)
                                    <button wire:click="removeTime({{$item->id}})" x-tooltip="Set time" class="border border-red-500 text-red-600 rounded-md px-1 hover:bg-red-500 hover:text-white"><x-app.icons.clock class="h-5 w-5"/></button>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <div class="mt-1" x-tooltip="Set repeat date"><x-app.icons.update class="h-6 w-6"/></div>
                                <input wire:keydown.enter="changeRepeat({{ $item->id }}, $event.target.value)" type="date" value="{{ $item->repeat }}" class="w-full py-1 px-2 rounded-md text-sm w-full border border-gray-500 text-gray-900 dark:text-white dark:bg-gray-800">
                                @if ($item->repeat)
                                    <button wire:click="removeRepeat({{$item->id}})" class="border border-red-500 text-red-600 rounded-md px-1 hover:bg-red-500 hover:text-white"><x-app.icons.update class="h-5 w-5"/></button>
                                @endif
                            </div>
                            <div class="flex gap-2">
                                <div class="mt-1" x-tooltip="Set reminder date"><x-app.icons.bell-1 class="h-6 w-6"/></div>
                                <input wire:change="changeRemDate({{$item->id}}, $event.target.value)"  x-tooltip="Set reminder date" type="date" value="{{$item->remind_date}}" class="py-1 px-2 rounded-md text-sm border border-gray-500 text-gray-900 dark:text-white dark:bg-gray-800">
                                @if ($item->remind_date)
                                    <button wire:click="removeDate({{$item->id}})" class="border border-red-500 text-red-600 rounded-md px-1 hover:bg-red-500 hover:text-white"><x-app.icons.bell-abort class="h-5 w-5"/></button>
                                @endif
                            </div>
                        </div>
                        <div class="grow"><textarea wire:keydown.enter="changeCommentToDo({{ $item->id }}, $event.target.value)" rows="10" type="text" class="w-full py-1 px-2 rounded-md text-sm w-full border border-gray-500 text-gray-900 dark:text-white dark:bg-gray-800" placeholder="Comment">{{ $item->comment }}</textarea></div>
                        {{--
                        <div><button class="w-full border rounded-md py-1 bg-blue-500 hover:bg-blue-600 text-white">Save & Update info</button></div>
                        --}}
                    </div>
                </div>

            @endforeach
        </dl>
        <div class="mt-2">

        </div>
    </div>
</div>
