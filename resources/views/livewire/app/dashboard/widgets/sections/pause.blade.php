<div class="bg-gray-700 rounded-md p-4">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1 flex justify-between">
        <div>
            <button wire:click="openListAdd">Paused</button>
        </div>
        <div class="text-sm ">
            @if ($settings->private)
                ({{$this->getTodos('paused')->where('private', true)->count()}})
            @else
                ({{$this->getTodos('paused')->where('private', false)->count()}})
            @endif
        </div>
    </div>

    <div>
        @if ($settings->private)
            @foreach ($this->getTodos('paused')->where('private', true) as $todo)
                <div class="flex justify-between text-sm border-b border-gray-600 hover:bg-gray-600 px-1">
                    <div class="tracking-widest grow py-2">
                        <button wire:click="showTodo({{$todo->id}})" class="text-start hover:underline">{{$todo->todo}}</button>
                    </div>
                    <div class="pl-2 flex gap-1 items-center">
                        @if ($todo->link)
                            <div class="-mt-0.5">
                                <div class="border rounded-md px-0.5 py-0.5 hover:bg-blue-600">
                                    <a href="{{$todo->link}}" target="_blank"><x-app.icons.link class="h-3 w-3" /></a>
                                </div>
                            </div>
                        @endif
                        <div>
                            <button wire:click="checkTodo({{$todo->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @foreach ($this->getTodos('paused')->where('private', false) as $todo)
                <div class="flex justify-between text-sm border-b border-gray-600 hover:bg-gray-600 px-1">
                    <div class="tracking-widest grow py-2">
                        <button wire:click="showTodo({{$todo->id}})" class="text-start hover:underline">{{$todo->todo}}</button>
                    </div>
                    <div class="pl-2 flex gap-1 items-center">
                        @if ($todo->link)
                            <div class="-mt-0.5">
                                <div class="border rounded-md px-0.5 py-0.5 hover:bg-blue-600">
                                    <a href="{{$todo->link}}" target="_blank"><x-app.icons.link class="h-3 w-3" /></a>
                                </div>
                            </div>
                        @endif
                        <div>
                            <button wire:click="checkTodo({{$todo->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

</div>
