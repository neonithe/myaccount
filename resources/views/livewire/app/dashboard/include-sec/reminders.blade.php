<div x-data="{showRem: true, showRep: true}" class="bg-gray-700 rounded-md p-4">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Reminders</div>
    <div>
        @if ($this->getTodoReminders()->count() != 0)
            <div @click="showRem = !showRem" class="border-b border-gray-600 font-bold flex justify-between cursor-pointer">
                <div>Reminders</div>
                <div class="text-xs font-medium mt-1">{{$this->getTodoReminders()->count()}}st</div>
            </div>
        @else
            <div class="border-b border-gray-600 font-bold">Reminders</div>
            <span class="italic text-sm">No Repeats</span>
        @endif
    </div>

    <div x-show="showRem">
        @foreach ($this->getTodoReminders() as $item)
            <div @if ($item->comment) x-tooltip="{{$item->comment}}" @endif class="flex justify-between text-sm py-1 px-2 @if ($item->remind_date == date('Y-m-d')) bg-blue-700 rounded-md border my-1 @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->remind_date))) bg-red-700 rounded-md border my-1 @else border-b border-gray-600 my-1 @endif">
                <div class="tracking-widest w-full">
                    <div class="flex justify-between">
                        @if ($item->link)
                            <a href="{{$item->link}}" target="_blank" class="text-blue-200 font-bold hover:underline">
                                {{$item->todo}}
                            </a>
                        @else
                            {{$item->todo}}
                        @endif

                        <div class="flex gap-1">
                            @if ($item->remind_time)
                                <div class="text-white text-xs mt-0.5">{{ date('H:i', strtotime($item->remind_time)) }}</div>
                            @endif
                            <div>
                                <button wire:click="check({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full flex justify-between">
                        @if ($item->remind_date == date('Y-m-d'))
                            <div class="text-xs font-bold">
                                {{$item->remind_date}}
                            </div>
                            <div class="text-xs font-bold">
                                Today
                            </div>
                        @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->remind_date)))
                            <div class="text-xs font-bold">
                                {{$item->remind_date}}
                            </div>
                            <div class="text-xs font-bold">
                                {{abs($this->getDaysTo($item->remind_date))-1}} days passed
                            </div>
                        @else
                            <div class="text-xs font-bold">
                                {{$item->remind_date}}
                            </div>
                            <div class="text-xs font-bold">
                                Days:{{$this->getDaysTo($item->remind_date)+1}}
                            </div>
                        @endif
                    </div>
                </div>
                <div></div>
            </div>
        @endforeach
    </div>


    <div>
        @if ($this->getTodoRepeat()->count() != 0)
            <div @click="showRep = !showRep" class="border-b border-gray-600 font-bold flex justify-between cursor-pointer mt-3">
                <div>Repeats</div>
                <div class="text-xs font-medium mt-1">{{$this->getTodoRepeat()->count()}}st</div>
            </div>
        @else
            <div class="border-b border-gray-600 mt-3 font-bold">Repeats</div>
            <span class="italic text-sm">No Repeats</span>
        @endif
    </div>

    <div x-show="showRep">
        @foreach ($this->getTodoRepeat() as $item)
            <div @if ($item->comment) x-tooltip="{{$item->comment}}" @endif class="flex justify-between text-sm py-1 px-2 @if ($item->repeat == date('Y-m-d')) bg-blue-700 rounded-md border my-1 @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->repeat))) bg-red-700 rounded-md border my-1 @else border-b border-gray-600 my-1 @endif">
                <div class="tracking-widest w-full">
                    <div class="flex justify-between">
                        @if ($item->link)
                            <a href="{{$item->link}}" target="_blank" class="text-blue-200 font-bold hover:underline">
                                {{$item->todo}}
                            </a>
                        @else
                            {{$item->todo}}
                        @endif
                        <div>
                            <button wire:click="repeatCheck({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                        </div>
                    </div>

                    <div class="w-full flex justify-between">
                        @if ($item->repeat == date('Y-m-d'))
                            <div class="text-xs font-bold">
                                {{$item->repeat}}
                            </div>
                            <div class="text-xs font-bold">
                                Today
                            </div>
                        @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->repeat)))
                            <div class="text-xs font-bold">
                                {{$item->repeat}}
                            </div>
                            <div class="text-xs font-bold">
                                {{abs($this->getDaysTo($item->repeat))-1}} days passed
                            </div>
                        @else
                            <div class="text-xs font-bold">
                                {{$item->repeat}}
                            </div>
                            <div class="text-xs font-bold">
                                Days:{{$this->getDaysTo($item->repeat)+1}}
                            </div>
                        @endif
                    </div>
                </div>
                <div></div>
            </div>
        @endforeach
    </div>

</div>
