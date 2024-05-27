<div>
    Add cycle
</div>
<div>
    <div class="grid grid-cols-7 gap-2">
        <div>
            <label class="text-sm">Cycle number</label>
            <div>
                <input wire:model="cycle_nr" type="number" class="bg-gray-700 p-0.5 rounded-md w-12 text-center">
            </div>
        </div>
        <div class="col-span-2">
            <label class="text-sm">Name</label>
            <div>
                <input wire:model="name" type="text" class="bg-gray-700 p-0.5 rounded-md w-full">
            </div>
        </div>
        <div>
            <label class="text-sm">Start date</label>
            <div>
                <input wire:model="cycle_start" type="date" class="bg-gray-700 p-0.5 rounded-md w-full">
            </div>
        </div>
        <div>
            <label class="text-sm">End date</label>
            <div>
                <input wire:model="cycle_end" type="date" class="bg-gray-700 p-0.5 rounded-md w-full">
            </div>
        </div>
        <div>
            <label class="text-sm">Team</label>
            <div>
                <select wire:model="team_id" class="bg-gray-700 p-0.5 rounded-md w-full">
                    @foreach ($teams as $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex gap-2">
            <div>
                <label class="text-sm">Time</label>
                <div>
                    <input wire:model="time" type="number" class="bg-gray-700 p-0.5 rounded-md w-12 text-center">
                </div>
            </div>
            <div class="mt-6">
                <button wire:click="addCycle" class="rounded-md border py-0.5 px-2 hover:bg-blue-600">Add</button>
            </div>
        </div>
    </div>
</div>
