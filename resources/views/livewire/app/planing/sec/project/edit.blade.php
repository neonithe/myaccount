<div>
    @if ($editProject)
    <div>
        <div class="flex gap-2">
            <div class="py-1">
                <div class="text-xs">Order</div>
                <div class=" mt-0.5">
                    <select class="border-0 bg-gray-600 py-1 rounded-md" wire:change="moveToOrder({{ $editProject->id }}, $event.target.value)">
                        <option value="">#</option>
                        @foreach ($this->countProject() as $item)
                            <option value="{{$item['id']}}" @if ($editProject->order == $item['id']) selected @endif>{{$item['id']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="py-1">
                <div class="text-xs">Category</div>
                <div class=" mt-0.5">
                    @php($typeId = $editProject->project_type_id)
                    <select wire:change="changeStatusType({{$editProject->id}}, $event.target.value)"
                            class="rounded-md py-1 border-0
                                            @if ($typeId == 1) bg-green-600 @elseif($typeId == 2) bg-yellow-500 @elseif($typeId == 3) bg-blue-500 @else bg-gray-600 @endif">
                        @foreach ($types as $type)
                            <option value="{{$type->id}}" @if ($type->id == $editProject->project_type_id) selected @endif>
                                {{$type->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="py-1 grow">
                <div class="text-xs">Name</div>
                <div class=" mt-0.5">
                    <input wire:keydown.enter="changeProject({{ $editProject->id }}, 'name', $event.target.value)" type="text" class="border-0 bg-gray-600 py-1 rounded-md px-1 w-full" value="{{ $editProject->name }}">
                </div>
            </div>

        </div>
        <div class="py-1 grow">
            <div class="text-xs">Link</div>
            <div>
                <div class="flex rounded-md bg-gray-600">
                    <span class="flex select-none items-center pl-3 text-gray-400 sm:text-sm">http://</span>
                    <input wire:keydown.enter="changeProject({{ $editProject->id }}, 'link', $event.target.value)" type="text" value="{{ $editProject->link }}" class="border-0 bg-gray-600 py-1 rounded-md px-1 w-full placeholder:text-gray-400" placeholder="www.example.com">
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        @if ($editProject->project_type_id == 1 || $editProject->project_type_id == 2)
            <div class="text-lg font-bold">Active and Distributed - Projects</div>
            <div class="font-bold mt-2 border-b">Set progress by points</div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="mt-2">Frontend</div>
                    <div class="pr-2 flex gap-2">
                        <div class="py-1">
                            <div class="text-xs">Points</div>
                            <div class="relative w-16 mt-0.5">
                                <input wire:keydown.enter="calcProgress({{$editProject->id}}, 'fe_progress_points', $event.target.value)" type="number" value="{{number_format($editProject->fe_progress_points, 0, ',', ' ')}}"
                                       class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-gray-600 text-white
                                       @if ($editProject->project_type_id == 1) bg-green-600 @else bg-yellow-600 @endif
                                       ">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <span class="text-gray-300 sm:text-sm">P</span>
                                </div>
                            </div>
                        </div>
                        <div class="py-1">
                            <div class="text-xs">Progress</div>
                            <div class="border rounded-md border-gray-600 p-1 px-2">
                                {{$this->calcProgressToPercent($editProject->id, 'fe')}}%
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mt-2">Backend</div>
                    <div class="pr-2 flex gap-2">
                        <div class="py-1">
                            <div class="text-xs">Points</div>
                            <div class="relative w-16 mt-0.5">
                                <input wire:keydown.enter="calcProgress({{$editProject->id}}, 'be_progress_points', $event.target.value)" type="number" value="{{number_format($editProject->be_progress_points, 0, ',', ' ')}}"
                                       class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-gray-600 text-white
                                       @if ($editProject->project_type_id == 1) bg-green-600 @else bg-yellow-600 @endif
                                       ">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <span class="text-gray-300 sm:text-sm">P</span>
                                </div>
                            </div>
                        </div>
                        <div class="py-1">
                            <div class="text-xs">Progress</div>
                            <div class="border rounded-md border-gray-600 p-1 px-2">
                                {{$this->calcProgressToPercent($editProject->id, 'be')}}%
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-4 border-b font-bold">Set project by points</div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="mt-2">Frontend</div>
                    <div class="flex gap-2">
                        <div class="pr-2 flex gap-2">
                            <div class="py-1">
                                <div class="text-xs">Points</div>
                                <div class="relative w-16 mt-0.5">
                                    <input wire:keydown.enter="calcPoints({{$editProject->id}}, 'fe_days', $event.target.value)" type="number" value="{{number_format($editProject->fe_points, 0, ',', ' ')}}"
                                           class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-gray-600 text-white

                                           ">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <span class="text-gray-300 sm:text-sm">P</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-1 grow">
                            <div class="text-xs">Days</div>
                            <div class="border rounded-md border-gray-600 p-1 px-2">
                                {{number_format($editProject->fe_days, 1, ',', ' ')}}
                            </div>
                        </div>
                        <div class="pr-2 flex gap-2">
                            <div class="py-1">
                                <div class="text-xs">Add extra</div>
                                <div class="relative w-16 mt-0.5">
                                    <input wire:keydown.enter="calcPoints({{$editProject->id}}, 'fe_ot_days', $event.target.value)" type="number" value="{{number_format($editProject->fe_ot_points, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-gray-600 text-white">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <span class="text-gray-300 sm:text-sm">P</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-1 grow">
                            <div class="text-xs">Days</div>
                            <div class="border rounded-md border-gray-600 p-1 px-2">
                                {{number_format($editProject->fe_ot_days, 1, ',', ' ')}}
                            </div>
                        </div>
                    </div>
                    <div class="py-1 grow">
                        <div class="text-xs">Total days</div>
                        <div class="border rounded-md border-gray-600 p-1 px-2 text-center">
                            {{number_format($editProject->fe_ot_days+$editProject->fe_days, 1, ',', ' ')}} days
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mt-2">Backend</div>
                    <div class="flex gap-2">
                        <div class="pr-2 flex gap-2">
                            <div class="py-1">
                                <div class="text-xs">Points</div>
                                <div class="relative w-16 mt-0.5">
                                    <input wire:keydown.enter="calcPoints({{$editProject->id}}, 'be_days', $event.target.value)" type="number" value="{{number_format($editProject->be_points, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-gray-600 text-white">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <span class="text-gray-300 sm:text-sm">P</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-1 grow">
                            <div class="text-xs">Days</div>
                            <div class="border rounded-md border-gray-600 p-1 px-2">
                                {{number_format($editProject->be_days, 1, ',', ' ')}}
                            </div>
                        </div>
                        <div class="pr-2 flex gap-2">
                            <div class="py-1">
                                <div class="text-xs">Add extra</div>
                                <div class="relative w-16 mt-0.5">
                                    <input wire:keydown.enter="calcPoints({{$editProject->id}}, 'be_ot_days', $event.target.value)" type="number" value="{{number_format($editProject->be_ot_points, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-gray-600 text-white">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <span class="text-gray-300 sm:text-sm">P</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-1 grow">
                            <div class="text-xs">Days</div>
                            <div class="border rounded-md border-gray-600 p-1 px-2">
                                {{number_format($editProject->be_ot_days, 1, ',', ' ')}}
                            </div>
                        </div>
                    </div>
                    <div class="py-1 grow">
                        <div class="text-xs">Total days</div>
                        <div class="border rounded-md border-gray-600 p-1 px-2 text-center">
                            {{number_format($editProject->be_ot_days+$editProject->be_days, 1, ',', ' ')}} days
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div>
                <div class="text-lg font-bold">Planing, Discovery and Backlog - Projects</div>

                <div class="font-bold mt-2 border-b">Estimations - Set project size</div>
                <div class="py-1 mt-2">
                    <div class="text-xs"></div>
                    <div class=" mt-0.5">
                        @php($typeId = $editProject->project_type_id)
                        <select wire:change="changeStatusType({{$editProject->id}}, $event.target.value)"
                                class="rounded-md py-1 border-0 bg-blue-500">
                            <option value="2" @if ($editProject->size == 2) selected @endif>XtraSmall</option>
                            <option value="5" @if ($editProject->size == 5) selected @endif>Small</option>
                            <option value="10" @if ($editProject->size == 10) selected @endif>Medium</option>
                            <option value="20" @if ($editProject->size == 20) selected @endif>Large</option>
                            <option value="30" @if ($editProject->size == 30) selected @endif>XtraLarge</option>
                        </select>
                    </div>
                </div>
                <div class="font-bold mt-2 border-b">Estimations - Set days by percent</div>
                <div class="grid grid-cols-2 gap-2 mt-2">
                    <div>
                        <div>Frontend</div>
                        <div class="flex gap-2">
                            <div class="pr-2 flex gap-2">
                                <div class="py-1">
                                    <div class="text-xs">Estimation</div>
                                    <div class="relative w-16 mt-1">
                                        <input wire:keydown.enter="calcEst({{$editProject->id}}, 'fe_perc', $event.target.value)" type="number" value="{{number_format($editProject->fe_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-blue-500 text-white">
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                            <span class="text-gray-300 sm:text-sm">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-1 grow">
                                    <div class="text-xs">Days</div>
                                    <div class="relative w-16 mt-0.5 border rounded-md p-1 text-center border-gray-600">
                                        {{number_format($editProject->fe_days, 1, ',', ' ')}}
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <div class="pr-2 flex gap-2">
                                    <div class="py-1">
                                        <div class="text-xs">Add extra</div>
                                        <div class="relative w-16 mt-1">
                                            <input wire:keydown.enter="calcOtEst({{$editProject->id}}, 'fe_ot_perc', $event.target.value)" type="number" value="{{number_format($editProject->fe_ot_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-blue-500 text-white">
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                                <span class="text-gray-300 sm:text-sm">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-1 grow">
                                    <div class="text-xs">Days</div>
                                    <div class="relative w-16 mt-0.5 border rounded-md p-1 text-center border-gray-600">
                                        {{number_format($editProject->fe_ot_days, 1, ',', ' ')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-1 grow">
                            <div class="text-xs">Total days</div>
                            <div class="border rounded-md border-gray-600 p-1 px-2 text-center">
                                {{number_format($editProject->fe_ot_days + $editProject->fe_days, 1, ',', ' ')}} days
                            </div>
                        </div>
                    </div>

                    <div>
                        <div>Backend</div>
                        <div class="flex gap-2">
                            <div class="pr-2 flex gap-2">
                                <div class="py-1">
                                    <div class="text-xs">Estimation</div>
                                    <div class="relative w-16 mt-1">
                                        <input wire:keydown.enter="calcEst({{$editProject->id}}, 'be_perc', $event.target.value)" type="number" value="{{number_format($editProject->be_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-blue-500 text-white">
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                            <span class="text-gray-300 sm:text-sm">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-1">
                                    <div class="text-xs">Days</div>
                                    <div class="relative w-16 mt-0.5 border rounded-md p-1 text-center border-gray-600">
                                        {{number_format($editProject->be_days, 1, ',', ' ')}}
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <div class="pr-2 flex gap-2">
                                    <div class="py-1">
                                        <div class="text-xs">Add extra</div>
                                        <div class="relative w-16 mt-1">
                                            <input wire:keydown.enter="calcOtEst({{$editProject->id}}, 'be_ot_perc', $event.target.value)" type="number" value="{{number_format($editProject->be_ot_perc, 0, ',', ' ')}}" class="block w-full rounded-md border-0 py-1 pr-6 text-gray-900 text-end bg-blue-500 text-white">
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                                <span class="text-gray-300 sm:text-sm">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-1 grow">
                                    <div class="text-xs">Days</div>
                                    <div class="relative w-16 mt-0.5 border rounded-md p-1 text-center border-gray-600">
                                        {{number_format($editProject->be_ot_days, 1, ',', ' ')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-1 grow">
                            <div class="text-xs">Total days</div>
                            <div class="border rounded-md border-gray-600 p-1 px-2 text-center">
                                {{number_format($editProject->be_ot_days + $editProject->be_days, 1, ',', ' ')}} days
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
        <div>
            <div class="font-bold mt-2 border-b mb-2">Comment</div>
            <textarea wire:model="comment" rows="5" class="bg-gray-600 rounded-md w-full p-1"></textarea>
            <div class="flex justify-end">
                <button wire:click="saveComment({{$editProject->id}})" class="border rounded-md p-1 uppercase tracking-widest px-2 hover:bg-blue-600">Save</button>
            </div>
        </div>
    @endif
</div>
