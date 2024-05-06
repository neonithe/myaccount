<div class="bg-gray-700 rounded-md p-4">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Meeting</div>
    @foreach ($this->getTodos('meeting') as $item)
        <div @if ($item->comment) x-tooltip="{{$item->comment}}" @endif class="flex justify-between text-sm py-1 my-1 @if ($dayName == $item->remind_day) bg-blue-600 border @else border-b border-gray-600 @endif px-1 rounded-md">
            <div class="tracking-widest truncate">
                @if ($item->link)
                    <a href="{{$item->link}}" target="_blank" class="font-bold text-blue-200 hover:underline inline-flex">
                        {{$item->todo}}
                    </a>
                @else
                    {{$item->todo}}
                @endif
            </div>
            <div class="flex gap-2">
                <div>
                    {{ substr($item->remind_day, 0, 3) }}
                </div>
                <div>
                    {{ date('H:i', strtotime($item->remind_time)) }}
                </div>
                <div>
                    <button wire:click="check({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                </div>
            </div>
        </div>
    @endforeach
</div>
