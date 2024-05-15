<div class="bg-gray-700 rounded-md p-4">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1 flex justify-between">

        <div class="text-sm ">
            @if ($private)
                ({{$this->getTodos('todo')->where('private', true)->count()}})
            @else
                ({{$this->getTodos('todo')->where('private', false)->count()}})
            @endif
        </div>
    </div>

    <div>

        @php
            ($private) ? $todoList = $this->getTodos('todo')->where('private', true) : $todoList = $this->getTodos('todo')->where('private', false);
        @endphp

        @foreach ($todoList as $item)
            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                <div class="tracking-widest grow">
                    <x-app.dash.edit-modal id="{{$item->id}}" todo="{{$item->todo}}" :editLink="$editLink" :editComment="$editComment" :isPrio="$isPrio" :isPrivate="$isPrivate" />
                </div>
                <div class="pl-2 mt-0.5 flex gap-1">
                    @if ($item->link)
                        <div>
                            <div class="border rounded-md px-0.5 py-0.5 hover:bg-blue-600">
                                <a href="{{$item->link}}" target="_blank"><x-app.icons.link class="h-3 w-3" /></a>
                            </div>
                        </div>
                    @endif
                    <div>
                        <button wire:click="check({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    @if (!$private)
        <div class="mt-3">
            @if ($workoutDay->count() != 0)
                <div class="border-b border-gray-600 font-bold">Workout</div>
            @else
                <div class="border-b border-gray-600 font-bold">Workout</div>
                <span class="italic text-sm">No workouts today</span>
            @endif
        </div>
        <div>
            @foreach ($workoutDay as $workout)
                <p>{{$workout->workout_set}}</p>
            @endforeach
        </div>
    @endif


</div>
