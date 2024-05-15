<div class="bg-gray-700 rounded-md p-4">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1 flex justify-between">
        <div>
            <button wire:click="openListAdd">Repeat</button>
        </div>
        <div class="text-sm ">
            @if ($settings->private)
                ({{$this->getTodoRepeat()->where('private', true)->count()}})
            @else
                ({{$this->getTodoRepeat()->where('private', false)->count()}})
            @endif
        </div>
    </div>

    <div>
        @if ($settings->private)
            @foreach ($this->getTodoRepeat()->where('private', true) as $todo)
                <div class="text-sm border-b border-gray-600 px-1
                @if ($todo->repeat == date('Y-m-d'))
                    bg-blue-600 hover:bg-blue-500 border border-white rounded-md mt-1
                @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($todo->repeat)))
                    bg-red-600 hover:bg-red-500 border border-white rounded-md mt-1
                @else
                    hover:bg-gray-600
                @endif
                ">
                    <div class="flex justify-between">
                        <div class="tracking-widest grow py-2">
                            <button wire:click="showTodo({{$todo->id}})" class="text-start hover:underline">{{$todo->todo}}</button>
                        </div>
                        <div class="pl-2 flex gap-1 items-center">
                            <div class="flex gap-1">
                                @if ($todo->remind_time)
                                    <div class="text-white text-xs mt-0.5">{{ date('H:i', strtotime($todo->remind_time)) }}</div>
                                @endif
                                @if ($todo->link)
                                    <div>
                                        <div class="border rounded-md px-0.5 py-0.5 hover:bg-blue-600">
                                            <a href="{{$todo->link}}" target="_blank"><x-app.icons.link class="h-3 w-3" /></a>
                                        </div>
                                    </div>
                                @endif
                                <div>
                                    <button wire:click="repeatCheck({{$todo->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-between -mt-0.5 pb-1">
                        @if ($todo->repeat == date('Y-m-d'))
                            <div class="text-xs font-bold">
                                {{$todo->repeat}}
                            </div>
                            <div class="text-xs font-bold">
                                Today
                            </div>
                        @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($todo->repeat)))
                            <div class="text-xs font-bold">
                                {{$todo->repeat}}
                            </div>
                            <div class="text-xs font-bold">
                                {{abs($this->getDaysTo($todo->repeat))-1}} days passed
                            </div>
                        @else
                            <div class="text-xs font-bold">
                                {{$todo->repeat}}
                            </div>
                            <div class="text-xs font-bold">
                                Days:{{$this->getDaysTo($todo->repeat)+1}}
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        @else
            @foreach ($this->getTodoRepeat()->where('private', false) as $todo)
                <div class="text-sm border-b border-gray-600 px-1
                @if ($todo->repeat == date('Y-m-d'))
                    bg-blue-600 hover:bg-blue-500 border border-white rounded-md mt-1
                @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($todo->repeat)))
                    bg-red-600 hover:bg-red-500 border border-white rounded-md mt-1
                @else
                    hover:bg-gray-600
                @endif
                ">
                    <div class="flex justify-between">
                        <div class="tracking-widest grow py-2">
                            <button wire:click="showTodo({{$todo->id}})" class="text-start hover:underline">{{$todo->todo}}</button>
                        </div>
                        <div class="pl-2 flex gap-1 items-center">
                            <div class="flex gap-1">
                                @if ($todo->remind_time)
                                    <div class="text-white text-xs mt-0.5">{{ date('H:i', strtotime($todo->remind_time)) }}</div>
                                @endif
                                @if ($todo->link)
                                    <div>
                                        <div class="border rounded-md px-0.5 py-0.5 hover:bg-blue-600">
                                            <a href="{{$todo->link}}" target="_blank"><x-app.icons.link class="h-3 w-3" /></a>
                                        </div>
                                    </div>
                                @endif
                                <div>
                                    <button wire:click="repeatCheck({{$todo->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-between -mt-0.5 pb-1">
                        @if ($todo->repeat == date('Y-m-d'))
                            <div class="text-xs font-bold">
                                {{$todo->repeat}}
                            </div>
                            <div class="text-xs font-bold">
                                Today
                            </div>
                        @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($todo->repeat)))
                            <div class="text-xs font-bold">
                                {{$todo->repeat}}
                            </div>
                            <div class="text-xs font-bold">
                                {{abs($this->getDaysTo($todo->repeat))-1}} days passed
                            </div>
                        @else
                            <div class="text-xs font-bold">
                                {{$todo->repeat}}
                            </div>
                            <div class="text-xs font-bold">
                                Days:{{$this->getDaysTo($todo->repeat)+1}}
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        @endif

    </div>

</div>
