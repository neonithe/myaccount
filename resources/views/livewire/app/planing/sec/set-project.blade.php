<div x-data="{
                sliderEdit: @entangle('sliderEdit'),
                doneProjects: false
            }">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-1">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="flex justify-between">
                    <div class="uppercase tracking-widest text-lg pl-2 mt-1">
                        Projects - active and planing
                    </div>
                    <div class="gap-2 flex">
                        <button @click="doneProjects = !doneProjects" class="border p-1 rounded-md hover:bg-blue-600">Done</button>
                    </div>
                </div>

                <div x-show="doneProjects" class="px-2">
                    <div>
                        <div class="grid grid-cols-12 border-b">
                            <div class="col-span-3">Name</div>
                            <div>Cycle</div>
                            <div>FE size est</div>
                            <div>FE est</div>
                            <div>FE points</div>
                            <div>BE size est</div>
                            <div>BE est</div>
                            <div>BE points</div>
                            <div>Link</div>
                            <div>Comment</div>
                        </div>
                        @foreach ($doneProjects as $project)
                            <div>
                                {{$project->name}}
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-show="!doneProjects">
                    @foreach ($listProjects as $project)
                        <div class="flex">

                            <div x-data="{edit: false}" class="bg-gray-800 rounded-md flex gap-2 py-2 px-2 grow">
                                <div>
                                    <div class="mt-0.5">
                                        <button wire:click="moveUp({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600"><x-app.icons.arrow-up class="h-5 w-5" /></button>
                                    </div>
                                    <div>
                                        <button wire:click="moveDown({{ $project->id }})" class="border rounded-md p-0.5 hover:bg-blue-600"><x-app.icons.arrow-down class="h-5 w-5" /></button>
                                    </div>
                                </div>

                                <div class="flex border rounded-md grow gap-2 pl-2 border-gray-600">
                                    <div class="py-1">
                                        <div class="text-xs">Order</div>
                                        <div class=" mt-0.5">
                                            <select class="border-0 bg-gray-600 py-1 rounded-md" wire:change="moveToOrder({{ $project->id }}, $event.target.value)">
                                                <option value="">#</option>
                                                @foreach ($this->countProject() as $item)
                                                    <option value="{{$item['id']}}" @if ($project->order == $item['id']) selected @endif>{{$item['id']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="py-1">
                                        <div class="text-xs">Category</div>
                                        <div class=" mt-0.5">
                                            @php($typeId = $project->project_type_id)
                                            <select wire:change="changeStatusType({{$project->id}}, $event.target.value)"
                                                    class="rounded-md py-1 border-0
                                            @if ($typeId == 1) bg-green-600 @elseif($typeId == 2) bg-yellow-500 @elseif($typeId == 3) bg-blue-500 @else bg-gray-600 @endif">
                                                @foreach ($types as $type)
                                                    <option value="{{$type->id}}" @if ($type->id == $project->project_type_id) selected @endif>
                                                        {{$type->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div x-show="!edit" class="py-1 grow">
                                        <div class="text-xs">Name</div>
                                        <div class="flex gap-2">
                                            <div class=" mt-0.5 grow">
                                                <input wire:keydown.enter="changeProject({{ $project->id }}, 'name', $event.target.value)" type="text" class="border-0 bg-gray-600 py-1 rounded-md px-1 w-full" value="{{ $project->name }}">
                                            </div>
                                            @if ($project->link)
                                                <div class="mt-0.5">
                                                    <a href="{{$project->link}}" target="_blank">
                                                        <button class="border rounded-md p-1"><x-app.icons.link class="h-5 w-5" /></button>
                                                    </a>
                                                </div>
                                            @endif
                                            @if ($project->comment)
                                                <div class="mt-0.5">
                                                    <button class="border rounded-md p-1" x-tooltip="{{ $project->comment }}"><x-app.icons.comment class="h-5 w-5" /></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if ($project->project_type_id == 1 || $project->project_type_id == 2)
                                        <div x-show="!edit" class="flex gap-2">
                                            <div class="pr-2 flex gap-2">
                                                <div class="py-1 w-20">
                                                    <div class="text-xs">FE Progress</div>
                                                    <div wire:click="openEdit({{$project->id}})" class="cursor-pointer border rounded-md border-gray-600 p-1 px-2 text-center
                                                @if ($project->project_type_id == 2) bg-yellow-600 @else bg-green-600 @endif
                                                ">
                                                        {{$this->calcProgressToPercent($project->id, 'fe')}}%
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pr-2 flex gap-2">
                                                <div class="py-1 w-20">
                                                    <div class="text-xs">BE Progress</div>
                                                    <div wire:click="openEdit({{$project->id}})" class="cursor-pointer border rounded-md border-gray-600 p-1 px-2 text-center
                                                @if ($project->project_type_id == 2) bg-yellow-600 @else bg-green-600 @endif
                                                ">
                                                        {{$this->calcProgressToPercent($project->id, 'be')}}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div x-show="!edit" class="flex gap-2">
                                            <div class="pr-2 flex gap-2">
                                                <div class="py-1 w-20">
                                                    <div class="text-xs">FE Estimation</div>
                                                    <div wire:click="openEdit({{$project->id}})" class="cursor-pointer border rounded-md border-gray-600 p-1 px-2 text-center bg-blue-600">
                                                        {{$project->fe_perc + $project->fe_ot_perc}}%
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pr-2 flex gap-2">
                                                <div class="py-1 w-20">
                                                    <div class="text-xs">BE Estimation</div>
                                                    <div wire:click="openEdit({{$project->id}})" class="cursor-pointer border rounded-md border-gray-600 p-1 px-2 text-center bg-blue-600">
                                                        {{$project->be_perc + $project->be_ot_perc}}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <div class="flex py-2 gap-2">
                                <div class="py-1 border rounded-md px-2 w-36 border-gray-600">
                                    <div class="text-xs">FE Cycles</div>
                                    <div class="flex gap-2 justify-center mt-1">
                                        @foreach ($this->calculateFeProjectCycles($project) as $cycle)
                                            <div x-data="{more: false}">
                                                <div @click="more = !more" x-tooltip="Days: {{$cycle['totalTime']}} | Uses: {{ $cycle['timeUsed'] }}"
                                                        class="border border-gray-600 rounded-md px-1 text-center cursor-pointer
                                                        @if ($cycleNumber == $cycle['cycleId']) bg-blue-600 @elseif ($cycleNumber > $cycle['cycleId']) bg-red-600 @endif">
                                                    <span x-show="!more">
                                                        {{$cycle['cycleId']}}
                                                        <span class="text-xs">({{$cycle['name']}})</span>
                                                    </span>
                                                    <span x-show="more" class="text-xs">Days: {{$cycle['totalTime']}} | Uses: {{ $cycle['timeUsed'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="py-1 border rounded-md px-2 w-36 border-gray-600">
                                    <div class="text-xs">BE Cycles</div>
                                    <div class="flex gap-2 justify-center mt-1">
                                        @foreach ($this->calculateBeProjectCycles($project) as $cycle)
                                            <div x-data="{more: false}">
                                                <div @click="more = !more" x-tooltip="Days: {{$cycle['totalTime']}} | Uses: {{ $cycle['timeUsed'] }}"
                                                        class="border border-gray-600 rounded-md px-1 text-center cursor-pointer
                                                        @if ($cycleNumber == $cycle['cycleId']) bg-blue-600 @elseif ($cycleNumber > $cycle['cycleId']) bg-red-600 @endif">
                                                    <span x-show="!more">
                                                        {{$cycle['cycleId']}}
                                                        <span class="text-xs">({{$cycle['name']}})</span>
                                                    </span>
                                                    <span x-show="more" class="text-xs">Days: {{$cycle['totalTime']}} | Uses: {{ $cycle['timeUsed'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="border rounded-md items-center flex px-0.5 hover:bg-blue-600">
                                    <button wire:click="openEdit({{$project->id}})" class="py-4"><x-app.icons.edit class="h-5 w-5" /></button>
                                </div>

                            </div>

                        </div>

                    @endforeach
                </div>

                {{-- Edit Project --}}
                <x-app.modal.slider data="sliderEdit" close="sliderEdit = false">
                    <x-slot name="top">
                        <div class="flex justify-between grow">
                            @if ($editProject)
                                <div class="uppercase tracking-widest font-bold text-2xl">
                                    Edit:  {{$editProject->name}}
                                </div>
                                <div class="flex gap-2 pr-4">
                                    <button wire:click="deleteProject({{$editProject->id}})" class="border border-gray-500 rounded-md py-1 px-2 bg-red-600 hover:bg-red-500 uppercase">
                                        Delete
                                    </button>
                                    <button wire:click="doneProject({{$editProject->id}})" class="border border-gray-500 rounded-md py-1 px-2 bg-green-600 hover:bg-green-500 uppercase">
                                        Done
                                    </button>
                                </div>
                            @endif
                        </div>
                    </x-slot>
                    <x-slot name="body">
                        @include('livewire.app.planing.sec.project.edit')
                    </x-slot>
                </x-app.modal.slider>

                {{--
                @include('livewire.app.planing.sec.project.list')
--}}
            </div>
        </div>
    </div>



</div>
