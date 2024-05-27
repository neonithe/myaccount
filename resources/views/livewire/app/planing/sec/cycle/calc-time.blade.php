<div>
    Calculate cycle
</div>

<div class="flex justify-between">
    <div>
        <div>Days to hours</div>
        <div class="flex gap-2">
            <div>
                <label class="text-sm">Days</label>
                <div>
                    <input wire:model.live="calcDays" type="text" class="p-0.5 border bg-gray-600 rounded-md w-12 text-center">
                </div>
            </div>
            <div class="mt-6">
                <div class="border rounded-md p-0.5 px-2">{{ is_numeric($calcDays) ? $calcDays * $settings->work_day_hours : 0 }} hours</div>
            </div>
            <div class="mt-6">
                <button wire:click="set('hours', {{ is_numeric($calcDays) ? $calcDays * $settings->work_day_hours : 0 }})" class="rounded-md border p-0.5 px-2 hover:bg-blue-600">Set</button>
            </div>
        </div>
    </div>
    <div class="flex gap-2">
        <div class="mt-6">
            <button wire:click="resetAllCalc" class="rounded-md border p-0.5 px-2 hover:bg-blue-600">Reset</button>
        </div>
        <div class="mt-6">
            <div class="border rounded-md p-0.5 px-2">Total mandays: {{ $total }}</div>
        </div>
        <div class="mt-6">
            <div class="border rounded-md p-0.5 px-2">Total hours: {{ $totalHours }}</div>
        </div>
    </div>
</div>

<div class="flex gap-2">
    <div>
        <label class="text-sm">Hours in cycle</label>
        <div>
            <input wire:model.live="hours" type="text" class="p-0.5 border bg-gray-600 rounded-md px-2">
        </div>
    </div>

    <div>
        <label class="text-sm">Team</label>
        <div>
            <select wire:model.live="teamId" class="p-0.5 border bg-gray-600 rounded-md w-32 px-2">
                <option value="">Choose</option>
                @foreach ($teams as $team)
                    <option value="{{$team->id}}">{{$team->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <label class="text-sm">Employee</label>
        <div>
            <select wire:model="empId" type="text" class="p-0.5 border bg-gray-600 rounded-md w-32 px-2">
                <option value="">Choose</option>
                @foreach ($employees->where('team_id', $teamId) as $employee)
                    <option value="{{$employee->id}}">
                        <div class="flex justify-between w-32">
                            <div>{{$employee->name}} </div>
                            <div>({{$this->getTeamName($employee->team_id)}})</div>
                        </div>
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mt-6">
        <button wire:click="addToTotal" class="rounded-md border p-0.5 px-2 hover:bg-blue-600">Add to total</button>
    </div>
</div>

<div>
    @foreach ($names as $name)
        <div class="flex gap-2">
            <div class="w-32">{{$name['name']}}</div>
            <div class="w-32">{{$this->getTeamName($name['team_id'])}}</div>
            <div class="w-32">{{$name['manday']}} days</div>
        </div>
    @endforeach
</div>

</div>
