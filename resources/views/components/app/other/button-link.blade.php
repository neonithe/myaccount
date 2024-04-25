<div class="flex pb-2">

    <div>
        <button class="border rounded-md py-1 px-1">
            @switch($number)
                @case(1) <x-app.icons.mail class="h-6 w-6"/> @break
                @case(2) <x-app.icons.calender class="h-6 w-6"/> @break
                @case(3) <x-app.icons.chip class="h-6 w-6"/> @break
                @case(4) <x-app.icons.document class="h-6 w-6"/> @break

                @case(5) <x-app.icons.clock class="h-6 w-6"/> @break
                @case(6) <x-app.icons.folder class="h-6 w-6"/> @break
                @case(7) <x-app.icons.office class="h-6 w-6"/> @break
                @case(8) <x-app.icons.paperclip class="h-6 w-6"/> @break

                @case(9) <x-app.icons.phone class="h-6 w-6"/> @break
                @case(10) <x-app.icons.server class="h-6 w-6"/> @break
                @case(11) <x-app.icons.tools class="h-6 w-6"/> @break
                @case(12) <x-app.icons.credit-card class="h-6 w-6"/> @break
            @endswitch
        </button>
    </div>

    <div class="grow ml-2">
        @if ($this->getButtonLink($number) != null)
            <select wire:change="setButtonLink({{$number}}, $event.target.value)" class="bg-gray-800 py-1 rounded-md w-full">
                <option value="">Add link</option>
                @foreach ($links as $link)
                    <option value="{{$link->id}}" @if ($this->getButtonLink($number) == $link->id) selected @endif>{{$link->name}}</option>
                @endforeach
            </select>
        @else
            <select wire:change="setButtonLink({{$number}}, $event.target.value)" class="bg-gray-800 py-1 rounded-md w-full">
                <option value="">Add link</option>
                @foreach ($links as $link)
                    <option value="{{$link->id}}">{{$link->name}}</option>
                @endforeach
            </select>
        @endif
    </div>

    <div class="ml-1">
        @if ($this->getOrder($number) != 0)
            <select wire:change="changeOrder({{$number}}, $event.target.value)" class="py-1 border rounded-md bg-gray-800">
                @for ($x = 1; $x <= $count; $x++)
                    <option value="{{$x}}" @if ($this->getOrder($number) == $x) selected @endif>{{$x}}</option>
                @endfor
            </select>
        @endif
    </div>

</div>
