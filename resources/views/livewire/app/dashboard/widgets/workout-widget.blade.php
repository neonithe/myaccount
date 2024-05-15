<div x-data="{
                showWorkout: @entangle('showWorkoutSlider')
            }">

    @if ($workoutDay->count() != 0)
        @foreach ($workoutDay as $workout)
            <div class="flex justify-between text-sm border-b border-gray-600 hover:bg-gray-600 px-1">
                <div class="tracking-widest grow py-2">
                    <button wire:click="showWorkout({{$workout->id}})" class="text-start hover:underline">{{$workout->workout_set}}</button>
                </div>
                <div class="pl-2 flex gap-1 items-center">
                    @if ($workout->link)
                        <div class="-mt-0.5">
                            <div class="border rounded-md px-0.5 py-0.5 hover:bg-blue-600">
                                <a href="{{$workout->link}}" target="_blank"><x-app.icons.link class="h-3 w-3" /></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <span class="italic">No workouts today</span>
    @endif

    @if ($selectedWorkout)
        {{-- SLIDER - Show Workout --}}
        <x-app.modal.slider data="showWorkout" close="showWorkout = false" >
            <x-slot name="title">
                {{$selectedWorkout->workout_set}} <br>
                <span class="text-sm -mt-4">{{$this->selectedWorkout->day}}</span>
            </x-slot>
            <x-slot name="body">

                <div x-data="{addExercise: false}">

                    <div class="hidden sm:block flex justify-between -mt-3">
                        <div></div>
                        <div>
                            <button @click="addExercise = !addExercise" class="border rounded-md py-1 px-2 hover:bg-green-600">
                                <span x-show="!addExercise">Lägg till</span>
                                <span x-show="addExercise">Visa träningslista</span>
                            </button>
                        </div>
                    </div>

                    {{-- List exercise --}}
                    <div x-show="!addExercise">
                        @if ($workoutExercise->count() != 0)
                            @foreach ($workoutExercise as $exercise)
                                <div  class="mt-1 flex justify-between gap-1">
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
                    </div>

                    {{-- Add new Exercise --}}
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

                    <div x-data="{addNewEx: false}" class="fixed inset-x-0 bottom-0 bg-gray-800 text-white p-4 sm:hidden border-t">

                        <div x-show="addNewEx">
                            <div class="-mt-2">
                                <div class="flex justify-between gap-1 flex-wrap">

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

                                <div class="col-span-2 mt-3 pb-1 sm:mt-1 flex justify-end gap-1 pt-2">
                                    <button wire:click="addExToWo" @click="addNewEx = true" class="border rounded-md py-1 px-1 bg-green-600"><x-app.icons.plus class="h-6 w-6"/></button>
                                    <button @click="addNewEx = false" class="border rounded-md py-1 px-1 bg-red-600"><x-app.icons.x class="h-6 w-6"/></button>
                                </div>
                            </div>
                        </div>

                        <div x-show="!addNewEx" class="flex justify-between gap-2">
                            <div class="grow">
                                <select wire:change="showWorkout($event.target.value)" class="border border-gray-500 bg-gray-600 rounded-md py-1 w-full">
                                    @foreach ($workouts as $workout)
                                        <option value="{{$workout->id}}">{{$workout->workout_set}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex gap-1">
                                <button @click="addNewEx = true" class="border rounded-md py-1 px-1 bg-green-600"><x-app.icons.plus class="h-6 w-6"/></button>
                                <button @click="showWorkout = false" class="border rounded-md py-1 px-1 bg-red-600"><x-app.icons.x class="h-6 w-6"/></button>
                            </div>
                        </div>
                    </div>

                </div>



            </x-slot>
        </x-app.modal.slider>
    @endif
</div>
