<div class="uppercase tracking-widest border-b mb-1 pb-1 text-white">
    What to show for user
</div>
<div class="grid grid-cols-3 gap-2 text-white">
    <div>
        <label class="text-xs">Topdisplay</label>
        <div>
            <select wire:change="changeSettings({{$settings->id}}, 'access_topinfo', $event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full">
                <option value="1" @if ($settings->access_topinfo) selected @endif>True</option>
                <option value="0" @if (!$settings->access_topinfo) selected @endif>False</option>
            </select>
        </div>
    </div>
    <div>
        <label class="text-xs">Workout</label>
        <div>
            <select wire:change="changeSettings({{$settings->id}}, 'access_workout', $event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full">
                <option value="1" @if ($settings->access_workout) selected @endif>True</option>
                <option value="0" @if (!$settings->access_workout) selected @endif>False</option>
            </select>
        </div>
    </div>
    <div>
        <label class="text-xs">Recipe</label>
        <div>
            <select wire:change="changeSettings({{$settings->id}}, 'access_recipe', $event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full">
                <option value="1" @if ($settings->access_recipe) selected @endif>True</option>
                <option value="0" @if (!$settings->access_recipe) selected @endif>False</option>
            </select>
        </div>
    </div>
    <div>
        <label class="text-xs">Economy</label>
        <div>
            <select wire:change="changeSettings({{$settings->id}}, 'access_eco', $event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full">
                <option value="1" @if ($settings->access_eco) selected @endif>True</option>
                <option value="0" @if (!$settings->access_eco) selected @endif>False</option>
            </select>
        </div>
    </div>
    <div>
        <label class="text-xs">Links</label>
        <div>
            <select wire:change="changeSettings({{$settings->id}}, 'access_link', $event.target.value)" class="border border-gray-500 rounded-md py-1 bg-gray-700 w-full">
                <option value="1" @if ($settings->access_link) selected @endif>True</option>
                <option value="0" @if (!$settings->access_link) selected @endif>False</option>
            </select>
        </div>
    </div>
</div>
