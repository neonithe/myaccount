<div>
    <div>
        <div>
            <div class="text-lg border-b mb-2 font-bold">
                Add employee
            </div>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div>
                <label class="text-sm">Team</label>
                <div>
                    <select wire:model="team_id" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-full">
                        @foreach ($teams as $team)
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-span-2">
                <label class="text-sm">Name</label>
                <div>
                    <input wire:model="name" type="text" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-full placeholder:text-gray-400" placeholder="First and lastname">
                </div>
            </div>
            <div class="flex gap-2">
                <div>
                    <label class="text-xs">Worktime</label>
                    <div class="relative w-24">
                        <input wire:model="work_time_perc" type="number" class="block w-full rounded-md border-0 py-1.5 pr-6 text-gray-900 text-end bg-gray-600 text-white">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                            <span class="text-gray-300 sm:text-sm">%</span>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="text-xs">Worktime cycle</label>
                    <div class="relative w-24">
                        <input wire:model="cycle_work_time_perc" type="number" class="block w-full rounded-md border-0 py-1.5 pr-6 text-gray-900 text-end bg-gray-600 text-white">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                            <span class="text-gray-300 sm:text-sm">%</span>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="text-xs">Hourly rate</label>
                    <div class="relative w-24">
                        <input wire:model="cost_h" type="number" class="block w-full rounded-md border-0 py-1.5 pr-6 text-gray-900 text-end bg-gray-600 text-white">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                            <span class="text-gray-300 sm:text-sm">kr</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-start-3 flex justify-end">
                <div class="mt-6">
                    <button wire:click="createEmployee" class="border rounded-md px-2 py-1.5 hover:bg-blue-600">Add employee</button>
                </div>
            </div>
        </div>

        <div x-data="{more: false}" class="mt-4">
            <div class="text-lg border-b mb-2 font-bold flex justify-between">
                <div>List of employees</div>
                <div><button @click="more = !more">MORE</button></div>
            </div>
            <div class="flex gap-2 border-b mb-1 border-gray-500">
                <div class="w-2/6 ">Name</div>
                <div class="w-1/6 text-sm">Worktime</div>
                <div class="w-1/6 text-xs mt-0.5">Worktime cycle</div>
                <div class="w-1/6 text-sm">Hourly rate</div>
                <div class="w-2/6 ">Team</div>
            </div>

            <div x-show="more">
                @foreach ($employees as $employee)
                    <div class="flex gap-2 border border-gray-500 rounded-md py-0.5 px-2 mb-1.5 hover:bg-gray-700">
                        <div class="grow">
                            <label class="text-xs">Name</label>
                            <div>
                                {{$employee->name}}
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div>
                                <label class="text-xs">Cycle/points</label>
                                <div>{{$employee->real_cycle_points}}</div>
                            </div>
                            <div>
                                <label class="text-xs">Points/h</label>
                                <div>{{$employee->real_cycle_points_h}}</div>
                            </div>
                            <div>
                                <label class="text-xs">Workhours</label>
                                <div>{{$employee->real_cycle_work_h}}</div>
                            </div>
                            <div>
                                <label class="text-xs">Cost/cycle</label>
                                <div>
                                    {{$this->calcCost($employee->id)}}kr
                                </div>
                            </div>
                            <div>
                                <label class="text-xs">Man days</label>
                                <div>{{$employee->man_days}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div x-show="!more">
                @foreach ($employees as $employee)
                    <div class="flex gap-2 mb-1">
                        <div class="w-2/6 "><input wire:keydown.enter="changeEmpolyee({{$employee->id}}, 'name', $event.target.value)" type="text" value="{{$employee->name}}" class="border rounded-md bg-gray-800 border-gray-700 py-1 px-2 w-full"></div>
                        <div class="w-1/6 ">
                            <div class="relative w-24">
                                <input wire:keydown.enter="changeEmpolyee({{$employee->id}}, 'work_time_perc', $event.target.value)" type="number" value="{{$employee->work_time_perc}}" class="text-end pr-6 border rounded-md bg-gray-800 border-gray-700 py-1 px-2 w-full">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <span class="text-gray-300 sm:text-sm">%</span>
                                </div>
                            </div>
                        </div>
                        <div x-show="" class="w-1/6 ">
                            <div class="relative w-24">
                                <input wire:keydown.enter="changeEmpolyee({{$employee->id}}, 'cycle_work_time_perc', $event.target.value)" type="number" value="{{$employee->cycle_work_time_perc}}" class="text-end pr-6 border rounded-md bg-gray-800 border-gray-700 py-1 px-2 w-full">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <span class="text-gray-300 sm:text-sm">%</span>
                                </div>
                            </div>
                        </div>
                        <div x-show="" class="w-1/6 ">
                            <div class="relative w-24">
                                <input wire:keydown.enter="changeEmpolyee({{$employee->id}}, 'cost_h', $event.target.value)" type="number" value="{{$employee->cost_h}}" class="text-end pr-6 border rounded-md bg-gray-800 border-gray-700 py-1 px-2 w-full">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <span class="text-gray-300 sm:text-sm">kr</span>
                                </div>
                            </div>
                        </div>
                        <div x-show="" class="w-2/6 flex gap-1">
                            <select wire:change="changeEmpolyee({{$employee->id}}, 'team_id', $event.target.value)" class="border rounded-md bg-gray-800 border-gray-700 py-1 px-2 w-full">
                                @foreach ($teams as $team)
                                    <option value="{{$team->id}}" @if ($team->id == $employee->team_id) selected @endif>{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>
            <div x-show="more" class="border-t mt-3 mb-2 flex gap-2 justify-between">
                <div class="flex gap-2">
                    <div wire:click="totalCost">Total man days in cycle: </div>
                    <div>{{$this->totalDays()}} days</div>
                </div>
                <div class="flex gap-2">
                    <div>Total cycle cost: </div>
                    <div>{{$this->totalCost()}} kr</div>
                </div>
            </div>

            <div class="text-lg border-b mb-2 font-bold flex justify-between mt-4">
                <div>Total days / team</div>
            </div>
            <div class="grid grid-cols-3">
                @foreach ($teams as $team)
                    <div class="flex gap-2">
                        <div class="font-bold">{{$team->name}}:</div>
                        <div>{{$this->calcTotalTeamTime($team->id)}} days</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
