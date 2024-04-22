{{-- Search and filter Exercise --}}
<div class="flex gap-2 border-b border-gray-600 pb-2 mb-2">
    <input wire:model.live="exerciseSearch" type="text"
           class="bg-gray-700 border rounded-md border-gray-600 py-0.5 w-full" placeholder="Search">
    <select wire:model.live="exerciseEditAreaFilter"
            class="bg-gray-700 border rounded-md border-gray-600 py-0.5">
        <option value="">Filter area</option>
        @foreach ($area as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>
</div>

{{-- Create Exercise --}}
<div x-show="exAddAl" class=" border rounded-md border-gray-500 p-2">
    <div class="mb-1 pl-1">Add new Exercise</div>
    <div class="flex gap-2">
        <div class="grow">
            <input wire:model="exName" type="text"
                   class="border border-gray-600 py-1 bg-gray-700 rounded-md w-full" placeholder="Exercise">
        </div>
        <div>
            <select wire:model="exArea" class="border border-gray-600 py-1 bg-gray-700 rounded-md">
                <option value="">Choose area</option>
                @foreach ($area as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <input wire:model="exLink" type="text" class="border border-gray-600 py-1 bg-gray-700 rounded-md"
                   placeholder="Link">
        </div>
        <div class="flex gap-2">
            <button wire:click="exAdd" x-tooltip="Add new Exercise"
                    class="border border-gray-600 py-1 px-1 hover:bg-gray-700 rounded-md">
                <x-app.icons.circle-plus class="h-6 w-6"/>
            </button>
            <button @click="exAddAl = !exAddAl" x-tooltip="Close add exercise"
                    class="border border-gray-600 py-1 px-1 hover:bg-gray-700 rounded-md">
                <x-app.icons.x class="h-6 w-6"/>
            </button>
        </div>
    </div>
</div>

{{-- List Exercise --}}
<div x-show="!exAddAl">
    @if ($exercises->count() != 0)
        @foreach ($exercises as $exercise)
            <div
                class="py-0.5 grid grid-cols-2 sm:grid-cols-3 gap-2 border-b border-gray-600 pb-3 mb-3 sm:mb-0 sm:pb-0 sm:border-none">
                <div>
                    <input
                        wire:keydown.enter="changeExercise({{$exercise->id}}, 'exercise', $event.target.value)"
                        class="dark:bg-gray-700 sm:dark:bg-gray-800 px-2 py-1 border-gray-700 rounded-md w-full"
                        value="{{$exercise->exercise}}">
                </div>
                <div>
                    <select wire:change="changeExercise({{$exercise->id}}, 'area_id', $event.target.value)"
                            class="dark:bg-gray-800 px-2 py-1 border-gray-700 rounded-md w-full">
                        @foreach ($area as $item)
                            <option value="{{$item->id}}"
                                    @if ($item->id == $exercise->area_id) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-1 col-span-2 sm:col-span-1">
                    <div class="grow">
                        <input
                            wire:keydown.enter="changeExercise({{$exercise->id}}, 'link', $event.target.value)"
                            class="dark:bg-gray-800 px-2 py-1 border-gray-700 rounded-md w-full"
                            value="@if ($exercise->link) {{$exercise->link}} @endif"
                            placeholder="@if (!$exercise->link) No link @endif"/>
                    </div>
                    @if ($exercise->link)
                        <div class="flex gap-2">
                            <div>
                                <a href="{{$exercise->link}}" target="_blank" x-tooltip="Go to link"
                                   class="inline-flex border rounded-md border-gray-600 px-1.5 py-1.5 hover:bg-gray-700">
                                    <x-app.icons.link class="h-5 w-5"/>
                                </a>
                            </div>
                        </div>
                    @endif
                    <div>
                        <button wire:click="deleteExercise({{$exercise->id}})"
                                class="hover:underline px-2 text-red-500 hover:text-white border border-gray-700 py-1.5 px-1 rounded-md hover:bg-red-500">
                            <x-app.icons.trash class="h-5 w-5"/>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @else

    @endif
</div>
