<div class="text-white">
    <div class="flex justify-between">
        <div class="uppercase tracking-widest text-lg pt-1">
            SpeedButton settings
        </div>
        <div class="flex gap-2">
            <div class="text-lg uppercase pt-1">Button align</div>
            <div>
                <select wire:change="buttonAlign($event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700">
                    <option value="left" @if ($settings->button_align == 'left') selected @endif>Left</option>
                    <option value="right" @if ($settings->button_align == 'right') selected @endif>Right</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 border-t mt-2 pt-4">
        <div>
            <x-app.other.button-link :links="$allLinks" number="1" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="2" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="3" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="4" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="5" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="6" count="{{$buttons->count()}}" />
        </div>
        <div>
            <x-app.other.button-link :links="$allLinks" number="7" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="8" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="9" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="10" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="11" count="{{$buttons->count()}}" />
            <x-app.other.button-link :links="$allLinks" number="12" count="{{$buttons->count()}}" />
        </div>
    </div>

    <div class="flex justify-between">
        <div class="uppercase tracking-widest text-lg pt-1">
            Other settings
        </div>
    </div>

    <div class="border-t mt-2 pt-4 pb-3">
        <div>Cycle settings</div>
        <div class="grid grid-cols-4 gap-2">
            <div class="grow">
                <label class="text-xs">Cycle start date</label>
                <div>
                    <input wire:change="changeSettings({{$settings->id}}, 'start_cycle', $event.target.value)" type="date" value="{{$settings->start_cycle}}" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full">
                </div>
            </div>
            <div>
                <label class="text-xs">Cycle length</label>
                <div>
                    <select wire:change="changeSettings({{$settings->id}}, 'length_cycle', $event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full ">
                        <option value="1" @if ($settings->length_cycle == 1) selected @endif>1</option>
                        <option value="2" @if ($settings->length_cycle == 2) selected @endif>2</option>
                        <option value="3" @if ($settings->length_cycle == 3) selected @endif>3</option>
                        <option value="4" @if ($settings->length_cycle == 4) selected @endif>4</option>
                        <option value="5" @if ($settings->length_cycle == 5) selected @endif>5</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="text-xs">Show nr of cycles months</label>
                <div>
                    <select wire:change="changeSettings({{$settings->id}}, 'show_nr_of_cycle', $event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full">
                        <option value="3" @if ($settings->show_nr_of_cycle == 3) selected @endif>3</option>
                        <option value="6" @if ($settings->show_nr_of_cycle == 6) selected @endif>6</option>
                        <option value="9" @if ($settings->show_nr_of_cycle == 9) selected @endif>9</option>
                        <option value="12" @if ($settings->show_nr_of_cycle == 12) selected @endif>12</option>
                        <option value="24" @if ($settings->show_nr_of_cycle == 24) selected @endif>24</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t mt-2 pt-4">
        <div>Other</div>
        <div class="grid grid-cols-4 gap-2">
            <div>
                <label class="text-xs">Topdisplay</label>
                <div>
                    <select wire:change="buttonAlign($event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full">
                        <option value="true" @if ($settings->access_topinfo) selected @endif>True</option>
                        <option value="false" @if (!$settings->access_topinfo) selected @endif>False</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="text-xs">Show first</label>
                <div>
                    <select wire:change="changeSettings({{$settings->id}}, 'private', $event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full">
                        <option value="1" @if ($settings->private) selected @endif>Private</option>
                        <option value="0" @if ($settings->private == false) selected @endif>Regular</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

</div>
