<div x-data="{show: 'list', setDays: false}">

    <div class="flex justify-between gap-2 mb-2 border-b pb-2 border-gray-500">
        <div class="uppercase tracking-widest text-lg mt-1">
            <span x-show="show === 'createlist'">Create list</span>
            <span x-show="show === 'list'">Edit cycle list</span>
        </div>
        <div class="flex gap-2">

            <div>
                <button @click="show = 'createlist'" class="px-2 py-1 border rounded-md hover:bg-blue-600">Create cycle list</button>
            </div>
            <div>
                <button @click="show = 'list'" class="px-2 py-1 border rounded-md hover:bg-blue-600">Edit cycle list</button>
            </div>
        </div>
    </div>

    <div x-show="show === 'list'" class="flex justify-between pb-2">
        <div>
            <button x-show="setDays" class="hover:underline uppercase">Reset all</button>
        </div>
        <div>
            <button @click="setDays = !setDays" class="hover:underline">Calculate and change days in cycle</button>
        </div>
    </div>

    <div x-show="show === 'add'" class="grid grid-cols-3 gap-2">
        <div>
            <label class="text-sm">Cycle length in weeks</label>
            <div>
                <input wire:model="name" type="number" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-12">
            </div>
        </div>
        <div>
            <label class="text-sm">Cycle length in weeks</label>
            <div>
                <input wire:model="name" type="number" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-12">
            </div>
        </div>
        <div>
            <label class="text-sm">Duration in months</label>
            <div>
                <input wire:model="name" type="number" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-12">
            </div>
        </div>
        <div>
            <label class="text-sm">How many cycles</label>
            <div>
                <input wire:model="name" type="number" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-12">
            </div>
        </div>

        <div>
            Start date cycle
        </div>
        <div class="col-span-3">
            <div>
                <input wire:model="name" type="date" class="border-0 bg-gray-600 py-1.5 rounded-md px-2">
            </div>
        </div>

    </div>

    <div x-show="show === 'createlist'">
        <div class="grid grid-cols-3 gap-2">
            <div>
                <label class="text-sm">Start date</label>
                <div>
                    <input wire:model="startDate" type="date" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-full">
                </div>
            </div>
            <div>
                <label class="text-sm">How many months</label>
                <div>
                    <input wire:model="duration" type="number" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-full">
                </div>
            </div>

            <div>
                <label class="text-sm">Start cycle</label>
                <div>
                    <input wire:model="startCycle" type="number" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-full">
                </div>
            </div>
            <div>
                <label class="text-sm">Frontend Base days</label>
                <div>
                    <input wire:model="baseFeDays" type="number" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-full">
                </div>
            </div>
            <div>
                <label class="text-sm">Backend Base days</label>
                <div>
                    <input wire:model="baseBeDays" type="number" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-full">
                </div>
            </div>
            <div class="lg:col-start-3 flex justify-end">
                <div class="mt-6">
                    <button wire:click="createCycleList" class="border rounded-md px-2 py-1.5">Create cycle list</button>
                </div>
            </div>
        </div>

        @if ($lists)
            <div class="border-b ">
                <div class="grid grid-cols-4 font-bold text-base border-b mb-2 pt-2">
                    <div class="flex gap-4">
                        <div>Q</div>
                        <div>Cycle</div>
                    </div>
                    <div>Start date</div>
                    <div>End date</div>
                    <div class="grid grid-cols-2">
                        <div>Frontend</div>
                        <div>Backend</div>
                    </div>
                </div>
                @foreach ($lists as $list)
                    <div class="grid grid-cols-4 text-sm">
                        <div class="flex gap-4">
                            <div>{{$list['quarter']}}</div>
                            <div>{{$list['cycle']}}</div>
                        </div>
                        <div>{{$list['start']}}</div>
                        <div>{{$list['end']}}</div>
                        <div class="grid grid-cols-2">
                            <div>{{$list['fe_days']}} days</div>
                            <div>{{$list['be_days']}} days</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($lists)
            <div class="flex justify-end mt-2">
                <button wire:click="saveList" class="border rounded-md py-1 px-2 hover:bg-blue-600">SAVE LIST</button>
            </div>
        @endif
    </div>

    {{-- Change days in cycle --}}
    <div x-show="setDays">
        <div class="grid grid-cols-3 gap-2">
            <div>
                <label class="text-sm">Team</label>
                <div>
                    <select wire:model.live="teamId" class="p-0.5 border bg-gray-600 rounded-md w-32 px-2 w-full">
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
                    <select wire:model="empId" wire:change="test($event.target.value)" type="text" class="p-0.5 border bg-gray-600 rounded-md w-32 px-2 w-full">
                        <option value="">Choose</option>
                        @foreach ($employees->where('team_id', $teamId) as $employee)
                            <option value="{{$employee->id}}">
                                {{$employee->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="text-sm">Man days in cycle</label>
                <div>
                    <input wire:model.live="manDays" type="text" class="p-0.5 border bg-gray-600 rounded-md px-2 w-full">
                </div>
            </div>
            <div>
                <label class="text-sm">Set to team</label>
                <div>
                    <select wire:model.live="setTeamId" class="p-0.5 border bg-gray-600 rounded-md w-32 px-2 w-full">
                        <option value="">Choose</option>
                        <option value="1">Frontend</option>
                        <option value="2">Backend</option>
                    </select>
                </div>
            </div>
            <div></div>
            <div class="mt-6">
                <button wire:click="addToTotal" class="border rounded-md py-0.5 px-2 w-full hover:bg-blue-600">Set days to cycle</button>
            </div>
        </div>

        <div class="py-4">
            <div class="font-bold">Set list for cycle</div>
            @foreach ($names as $name)
                <div class="flex gap-2 border-t py-2">
                    <div class="grow">Name: {{$name['name']}}</div>
                    <div class="flex gap-2">
                        <div class="w-32">Team: @if ($name['team_id'] == 1) Frontend @elseif($name['team_id'] == 2) Backend @endif</div>
                        <div class="w-32">Manday: {{$name['manday']}} days</div>
                    </div>
                </div>
            @endforeach
            <div class="border-t pt-1 flex gap-4 justify-between pt-4 pb-4">
                <div class="flex gap-4 mt-1 text-lg">
                    <div>Frontend: {{ $this->totalDays()['fe'] }} days</div>
                    <div>Backend: {{ $this->totalDays()['be'] }} days</div>
                </div>
                <div class="flex gap-2">
                    <div>
                        <div>
                            <select wire:model.live="cycleId" class="py-1 border bg-gray-600 rounded-md w-32 w-full">
                                <option value="">Cycle</option>
                                @foreach ($cycles as $cycle)
                                    <option value="{{$cycle->id}}">{{$cycle->cycle_nr}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <button wire:click="saveToCycle" class="border rounded-md py-1 px-2 hover:bg-blue-600">Save to cycle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="show === 'list'">
        <div>
            <div class="grid grid-cols-4 font-bold text-base border-b mb-2">
                <div class="flex gap-4">
                    <div>Q</div>
                    <div>Cycle</div>
                </div>
                <div>Start date</div>
                <div>End date</div>
                <div class="grid grid-cols-2">
                    <div>Frontend</div>
                    <div>Backend</div>
                </div>
            </div>
            @foreach ($cycles as $cycle)
                <div class="grid grid-cols-4 mb-2 @if ($cycle->cycle_nr == $this->getCurrentCycle()['Cykel nr']) bg-gray-500  @endif">
                    <div class="flex gap-4">
                        <div class="mt-1">{{$cycle->name}}</div>
                        <div class="mt-1">{{$cycle->cycle_nr}}</div>
                    </div>
                    <div class="mt-1">{{$cycle->cycle_start}}</div>
                    <div class="mt-1">{{$cycle->cycle_end}}</div>
                    <div class="grid grid-cols-2">
                        <div>
                            <input wire:keydown.enter="changeDayValue({{$cycle->id}}, 'fe_days', $event.target.value)" type="number" value="{{$cycle->fe_days}}" class="bg-gray-600 rounded-md border-0 w-12 p-1 text-center">
                        </div>
                        <div>
                            <input wire:keydown.enter="changeDayValue({{$cycle->id}}, 'be_days', $event.target.value)" type="number" value="{{$cycle->be_days}}" class="bg-gray-600 rounded-md border-0 w-12 p-1 text-center">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
