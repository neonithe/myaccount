@foreach ($projects as $project)
    @php
        $projectCyclesFe = $this->calculateFeProjectCycles($project);
        $projectCyclesBe = $this->calculateBeProjectCycles($project);
    @endphp
    <div class=" p-2 mb-2">
        <div class="flex gap-2">

            <div class="flex gap-2">
                <div>
                    <button wire:click="moveUp({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600">A</button>
                </div>
                <div>
                    <button wire:click="moveDown({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600">P</button>
                </div>
                <div>
                    <button wire:click="moveDown({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600">D</button>
                </div>
                <div>
                    <button wire:click="moveDown({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600">B</button>
                </div>
            </div>

            <div class="border rounded-md p-1 px-2 grow">
                <div class="text-xs">Name</div>
                <div class=" mt-0.5">
                    <input type="text" class="border-0 bg-gray-600 py-0.5 rounded-md px-0.5 w-full" value="{{ $project->name }}">
                </div>
            </div>

            <div class="flex gap-2 px-4">
                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">Size</div>
                    <div class=" mt-0.5">
                        <select wire:change="changeSize({{$project->id}}, $event.target.value)" class="border-0 bg-gray-600 py-0.5 rounded-md">
                            <option value="2" @if ($project->size == 2) selected @endif>XS</option>
                            <option value="5" @if ($project->size == 5) selected @endif>S</option>
                            <option value="10" @if ($project->size == 10) selected @endif>M</option>
                            <option value="20" @if ($project->size == 20) selected @endif>L</option>
                            <option value="30" @if ($project->size == 30) selected @endif>XL</option>
                        </select>
                    </div>
                </div>
                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">Frontend [{{number_format($project->fe_days, 0, ',', ' ')}}d]</div>
                    <div class="flex justify-center mt-0.5">
                        <div class="relative w-16">
                            <input wire:keydown.enter="changeProject({{$project->id}}, 'fe_perc', $event.target.value)" type="number" value="{{number_format($project->fe_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-0.5 pr-6 text-gray-900 text-end bg-gray-700 text-white">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <span class="text-gray-300 sm:text-sm">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">Backend [{{number_format($project->be_days, 0, ',', ' ')}}d]</div>
                    <div class="flex justify-center mt-0.5">
                        <div class="relative w-16">
                            <input wire:keydown.enter="changeProject({{$project->id}}, 'be_perc', $event.target.value)" type="number" value="{{number_format($project->be_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-0.5 pr-6 text-gray-900 text-end bg-gray-700 text-white">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <span class="text-gray-300 sm:text-sm">%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2">
                    <div class="border rounded-md p-1 px-2">
                        <div class="text-xs">Extra FE [{{number_format($project->fe_ot_days, 0, ',', ' ')}}d]</div>
                        <div class=" mt-0.5">
                            <div class="relative w-16">
                                <input wire:keydown.enter="changeProject({{$project->id}}, 'fe_ot_perc', $event.target.value)" type="number" value="{{number_format($project->fe_ot_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-0.5 pr-6 text-gray-900 text-end bg-gray-700 text-white">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <span class="text-gray-300 sm:text-sm">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border rounded-md p-1 px-2">
                        <div class="text-xs">Extra BE [{{number_format($project->be_ot_days, 0, ',', ' ')}}d]</div>
                        <div class=" mt-0.5">
                            <div class="relative w-16">
                                <input wire:keydown.enter="changeProject({{$project->id}}, 'be_ot_perc', $event.target.value)" type="number" value="{{number_format($project->be_ot_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-0.5 pr-6 text-gray-900 text-end bg-gray-700 text-white">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <span class="text-gray-300 sm:text-sm">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2 px-2">
                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">FrontEnd Cycles</div>
                    <div class="flex gap-2 justify-center mt-1">
                        @foreach ($projectCyclesFe as $cycle)
                            <div x-data="{more: false}">
                                <div @click="more = !more" class="border border-gray-600 rounded-md px-1 text-center cursor-pointer
                                            @if ($cycleNumber == $cycle['cycleId']) bg-blue-600 @elseif ($cycleNumber > $cycle['cycleId']) bg-red-600 @endif">

                                    <span x-show="!more"># {{$cycle['cycleId']}}</span>
                                    <span x-show="more" class="text-xs">Days: {{$cycle['totalTime']}} | Uses: {{ $cycle['timeUsed'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">Backend Cycles</div>
                    <div class="flex gap-2 justify-center mt-1">
                        @foreach ($projectCyclesBe as $cycle)
                            <div x-data="{more: false}">
                                <div @click="more = !more" class="border border-gray-600 rounded-md px-1 text-center cursor-pointer
                                                 @if ($cycleNumber == $cycle['cycleId']) bg-blue-600 @elseif ($cycleNumber > $cycle['cycleId']) bg-red-600 @endif">

                                    <span x-show="!more"># {{$cycle['cycleId']}}</span>
                                    <span x-show="more" class="text-xs">Days: {{$cycle['totalTime']}} | Uses: {{ $cycle['timeUsed'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div>
                <div>
                    <button wire:click="moveUp({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600"><x-app.icons.arrow-up class="h-5 w-5" /></button>
                </div>
                <div>
                    <button wire:click="moveDown({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600"><x-app.icons.arrow-down class="h-5 w-5" /></button>
                </div>
            </div>

        </div>
    </div>
@endforeach
<div class="border-b py-12">

</div>
@foreach ($projects as $project)
    @php
        $projectCyclesFe = $this->calculateFeProjectCycles($project);
        $projectCyclesBe = $this->calculateBeProjectCycles($project);
    @endphp
    <div class=" p-2 mb-2">
        <div class="flex gap-2">

            <div class="flex gap-2">
                <div>
                    <button wire:click="moveUp({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600">A</button>
                </div>
                <div>
                    <button wire:click="moveDown({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600">P</button>
                </div>
                <div>
                    <button wire:click="moveDown({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600">D</button>
                </div>
                <div>
                    <button wire:click="moveDown({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600">B</button>
                </div>
            </div>

            <div class="border rounded-md p-1 px-2 grow">
                <div class="text-xs">Name</div>
                <div class=" mt-0.5">
                    <input type="text" class="border-0 bg-gray-600 py-0.5 rounded-md px-0.5 w-full" value="{{ $project->name }}">
                </div>
            </div>

            <div class="flex gap-2 px-4">
                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">Size</div>
                    <div class=" mt-0.5">
                        <select wire:change="changeSize({{$project->id}}, $event.target.value)" class="border-0 bg-gray-600 py-0.5 rounded-md">
                            <option value="2" @if ($project->size == 2) selected @endif>XS</option>
                            <option value="5" @if ($project->size == 5) selected @endif>S</option>
                            <option value="10" @if ($project->size == 10) selected @endif>M</option>
                            <option value="20" @if ($project->size == 20) selected @endif>L</option>
                            <option value="30" @if ($project->size == 30) selected @endif>XL</option>
                        </select>
                    </div>
                </div>
                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">Frontend [{{number_format($project->fe_days, 0, ',', ' ')}}d]</div>
                    <div class="flex justify-center mt-0.5">
                        <div class="relative w-16">
                            <input wire:keydown.enter="changeProject({{$project->id}}, 'fe_perc', $event.target.value)" type="number" value="{{number_format($project->fe_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-0.5 pr-6 text-gray-900 text-end bg-gray-700 text-white">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <span class="text-gray-300 sm:text-sm">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">Backend [{{number_format($project->be_days, 0, ',', ' ')}}d]</div>
                    <div class="flex justify-center mt-0.5">
                        <div class="relative w-16">
                            <input wire:keydown.enter="changeProject({{$project->id}}, 'be_perc', $event.target.value)" type="number" value="{{number_format($project->be_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-0.5 pr-6 text-gray-900 text-end bg-gray-700 text-white">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <span class="text-gray-300 sm:text-sm">%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2">
                    <div class="border rounded-md p-1 px-2">
                        <div class="text-xs">Extra FE [{{number_format($project->fe_ot_days, 0, ',', ' ')}}d]</div>
                        <div class=" mt-0.5">
                            <div class="relative w-16">
                                <input wire:keydown.enter="changeProject({{$project->id}}, 'fe_ot_perc', $event.target.value)" type="number" value="{{number_format($project->fe_ot_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-0.5 pr-6 text-gray-900 text-end bg-gray-700 text-white">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <span class="text-gray-300 sm:text-sm">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border rounded-md p-1 px-2">
                        <div class="text-xs">Extra BE [{{number_format($project->be_ot_days, 0, ',', ' ')}}d]</div>
                        <div class=" mt-0.5">
                            <div class="relative w-16">
                                <input wire:keydown.enter="changeProject({{$project->id}}, 'be_ot_perc', $event.target.value)" type="number" value="{{number_format($project->be_ot_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-0.5 pr-6 text-gray-900 text-end bg-gray-700 text-white">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <span class="text-gray-300 sm:text-sm">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2 px-2">
                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">FrontEnd Cycles</div>
                    <div class="flex gap-2 justify-center mt-1">
                        @foreach ($projectCyclesFe as $cycle)
                            <div x-data="{more: false}">
                                <div @click="more = !more" class="border border-gray-600 rounded-md px-1 text-center cursor-pointer
                                            @if ($cycleNumber == $cycle['cycleId']) bg-blue-600 @elseif ($cycleNumber > $cycle['cycleId']) bg-red-600 @endif">

                                    <span x-show="!more"># {{$cycle['cycleId']}}</span>
                                    <span x-show="more" class="text-xs">Days: {{$cycle['totalTime']}} | Uses: {{ $cycle['timeUsed'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border rounded-md p-1 px-2">
                    <div class="text-xs">Backend Cycles</div>
                    <div class="flex gap-2 justify-center mt-1">
                        @foreach ($projectCyclesBe as $cycle)
                            <div x-data="{more: false}">
                                <div @click="more = !more" class="border border-gray-600 rounded-md px-1 text-center cursor-pointer
                                                 @if ($cycleNumber == $cycle['cycleId']) bg-blue-600 @elseif ($cycleNumber > $cycle['cycleId']) bg-red-600 @endif">

                                    <span x-show="!more"># {{$cycle['cycleId']}}</span>
                                    <span x-show="more" class="text-xs">Days: {{$cycle['totalTime']}} | Uses: {{ $cycle['timeUsed'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div>
                <div>
                    <button wire:click="moveUp({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600"><x-app.icons.arrow-up class="h-5 w-5" /></button>
                </div>
                <div>
                    <button wire:click="moveDown({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600"><x-app.icons.arrow-down class="h-5 w-5" /></button>
                </div>
            </div>

        </div>
    </div>
@endforeach

