<div x-data="{showWo: false}">

    <div class="hidden sm:block">
        <div class="uppercase tracking-widest border-b border-gray-600 mb-2 flex justify-between pt-0.5">
            Workouts
        </div>
    </div>

    {{-- Small Screens --}}
    <div class="block sm:hidden">
        {{-- Add + Menu --}}
        <div x-data="{openAdd: false}" class="fixed inset-x-0 bottom-0 bg-gray-800 shadow-lg z-50 border-t border-b">
            <div class="">
                <div class="justify-between flex">
                    <div class="relative grow">
                        <div x-show="showWo" class="px-2 pt-4">
                            <div class="flex gap-2 border-b border-gray-600 pb-2 mb-2">
                                <input  wire:model.live="workoutSearch" type="text" class="bg-gray-700 border rounded-md border-gray-600 py-0.5 w-full" placeholder="Search">
                                <select wire:model.live="workoutDayFilter" class="bg-gray-700 border rounded-md border-gray-600 py-0.5">
                                    <option value="">Day</option>
                                    <option value="Monday" >Monday</option>
                                    <option value="Tuesday" >Tuesday</option>
                                    <option value="Wednesday" >Wednesday</option>
                                    <option value="Thursday" >Thursday</option>
                                    <option value="Friday" >Friday</option>
                                    <option value="Saturday" >Saturday</option>
                                    <option value="Sunday" >Sunday</option>
                                </select>
                            </div>

                            @foreach ($workoutsShow as $workout)
                                <div class="py-0.5 flex justify-between">
                                    <div class="grow">
                                        <button wire:click="selectWorkout({{$workout->id}})" @click="showWo = false" class="px-2 py-0.5 border rounded-md border-gray-600 hover:bg-gray-700 w-full">{{$workout->workout_set}} ({{$workout->day}})</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="grow">
                            <button @click="showWo = !showWo" class="w-full uppercase tracking-widest inline-flex text-center justify-center py-1">
                                workouts
                                <div x-show="showWo" class="mt-1 pl-2">
                                    <x-app.icons.arrow-down class="h-4 w-4"/>
                                </div>
                                <div x-show="!showWo" class="mt-1 pl-2">
                                    <x-app.icons.arrow-up class="h-4 w-4"/>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Large screen --}}
    <div class="hidden sm:block">
        <div class="flex gap-2 border-b border-gray-600 pb-2 mb-2">
            <input  wire:model.live="workoutSearch" type="text" class="bg-gray-700 border rounded-md border-gray-600 py-0.5 w-full" placeholder="Search">
            <select wire:model.live="workoutDayFilter" class="bg-gray-700 border rounded-md border-gray-600 py-0.5">
                <option value="">Day</option>
                <option value="Monday" >Monday</option>
                <option value="Tuesday" >Tuesday</option>
                <option value="Wednesday" >Wednesday</option>
                <option value="Thursday" >Thursday</option>
                <option value="Friday" >Friday</option>
                <option value="Saturday" >Saturday</option>
                <option value="Sunday" >Sunday</option>
            </select>
        </div>

        @foreach ($workoutsShow as $workout)
            <div class="py-0.5 flex justify-between">
                <div class="grow">
                    <button wire:click="selectWorkout({{$workout->id}})" @click="showWo = false" class="px-2 py-0.5 border rounded-md border-gray-600 hover:bg-gray-700 w-full">{{$workout->workout_set}} ({{$workout->day}})</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
