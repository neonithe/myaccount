<div x-data="{addExercise: false}" class="col-span-2">
    <div class="hidden sm:block">
        <div class="uppercase tracking-widest border-b border-gray-600 mb-2 flex justify-between">
            <div>Workout schema</div>
            <div></div>
        </div>
    </div>
    @if ($workoutExercise)

        <div class="flex justify-between border-b mb-2">
            <div class="uppercase tracking-widest">
                {{$this->selectedWorkout->workout_set}}
            </div>
            <div class="uppercase tracking-widest">
                {{$this->selectedWorkout->day}}
            </div>
        </div>

        @if ($workoutExercise->count() != 0)
            @foreach ($workoutExercise as $exercise)
                <div x-show="!addExercise" class="mt-1 flex justify-between gap-1">

                    <div x-data="{options: false}" class="truncate col-span-2 w-full">
                        <label class="text-xs uppercase">Exercise</label>
                        <div class="flex gap-1 justify-end">
                            <button @click="options = !options" class="border border-gray-600 rounded-md w-full py-0.5 pl-2 text-left hover:bg-gray-600">
                                {{$exercise->exercise}}
                            </button>
                            <button x-show="options" wire:click="removeExerciseFromWorkout({{$this->selectedWorkout->id}}, {{$exercise->id}})" class="text-white border-red-700 border border-gray-600 rounded-md py-1 px-1 text-left bg-red-500 hover:bg-red-400">
                                <x-app.icons.trash class="h-5 w-5"/>
                            </button>
                        </div>
                    </div>
                    <div class="col-span-1 flex gap-1">
                        <div class="text-center">
                            <label class="text-xs uppercase">Set</label>
                            <div class="border border-gray-600 rounded-md">
                                <select wire:change="changeData({{$this->selectedWorkout->id}}, {{$exercise->id}}, 'set', $event.target.value)" class="custom-select rounded-md font-bold hover:bg-gray-600">
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option @if ($i == $exercise->pivot->set) selected @endif value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <label class="text-xs uppercase">Rep</label>
                            <div class="border border-gray-600 rounded-md">
                                <select wire:change="changeData({{$this->selectedWorkout->id}}, {{$exercise->id}}, 'rep', $event.target.value)" class="custom-select rounded-md font-bold hover:bg-gray-600">
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option @if ($i == $exercise->pivot->rep) selected @endif value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="text-center">
                            <label class="text-xs uppercase">kg</label>
                            <div class="border border-gray-600 rounded-md">
                                <select wire:change="changeData({{$this->selectedWorkout->id}}, {{$exercise->id}}, 'weight', $event.target.value)" class="custom-select rounded-md font-bold hover:bg-gray-600">
                                    @for ($i = 0; $i <= 300; $i++)
                                        <option @if ($i == $exercise->pivot->weight) selected @endif value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <div class="text-center">
                Please add exercise to workout
            </div>
        @endif

        <div x-show="addExercise" class="border rounded-md px-2 py-1.5 mt-2">
            <div class="mt-1 flex justify-between gap-1 flex-wrap">

                <div class="truncate col-span-2 grow">
                    <label class="text-xs uppercase">Exercise</label>
                    <div class="pb-1 grow">
                        <select wire:model="exSelectedId" class="border rounded-md py-0.5 bg-gray-700 w-full">
                            <option value="">Välj Exercise</option>
                            @foreach ($exercises as $exercise)
                                <option value="{{$exercise->id}}">{{$exercise->exercise}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-span-1 flex gap-1 grow sm:grow-0 flex-wrap">

                    <div class="text-center grow sm:grow-0">
                        <label class="text-xs uppercase">Set</label>
                        <div>
                            <select wire:model="selectSet" class="border rounded-md py-0.5 bg-gray-700 font-bold w-full sm:w-auto">
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="text-center grow sm:grow-0">
                        <label class="text-xs uppercase">Rep</label>
                        <div>
                            <select wire:model="selectRep" class="border rounded-md py-0.5 bg-gray-700 font-bold w-full sm:w-auto">
                                @for ($i = 1; $i <= 30; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="text-center grow sm:grow-0">
                        <label class="text-xs uppercase">Weight</label>
                        <div>
                            <select wire:model="selectWeight" class="border rounded-md py-0.5 bg-gray-700 font-bold w-full sm:w-auto">
                                @for ($i = 0; $i <= 300; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-span-2 mt-3 pb-1 sm:mt-1 flex justify-end">
                <button wire:click="addExToWo" @click="addExercise = false" class="border rounded-md px-3 py-0.5">Add</button>
            </div>
        </div>


        <div x-show="!addExercise"  class=" mt-2 border-t pt-2 border-gray-600">
            <div class="flex justify-end gap-4">
                <div class="uppercase tracking-widest">
                    Reps:  {{number_format($totReps, 0, ',', ' ')}} st
                </div>
                <div class="uppercase tracking-widest">
                    Weight: {{number_format($totWeight, 0, ',', ' ')}} kg
                </div>
            </div>
            <div x-show="!addExercise" class="flex justify-end mt-2">
                <button @click="addExercise = true" class="border rounded-md py-1 px-2 text-sm uppercase">Add exercise</button>
            </div>
        </div>

        <div x-show="addExercise" class="flex justify-end mt-1 pt-1">
            <button @click="addExercise = false" class="border rounded-md py-1 px-2 text-sm uppercase">Close</button>
        </div>
    @else
        <div class="text-center">
            Please choose workout
        </div>
    @endif

</div>
