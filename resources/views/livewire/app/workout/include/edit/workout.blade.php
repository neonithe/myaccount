{{-- Search and filter Workout --}}
<div class="flex gap-2 border-b border-gray-600 pb-2 mb-2">
    <input wire:model.live="workoutEditSearch" type="text" class="bg-gray-700 border rounded-md border-gray-600 py-0.5 w-full" placeholder="Search">
    <select wire:model.live="workoutEditDayFilter" class="bg-gray-700 border rounded-md border-gray-600 py-0.5">
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

{{-- Create Workout --}}
<div x-show="woAddAl" class=" border rounded-md border-gray-500 p-2">
    <div class="mb-1 pl-1">Add new Workout</div>
    <div class="flex gap-2">
        <div class="grow">
            <input wire:model="woName" type="text" class="border border-gray-600 py-1 bg-gray-700 rounded-md w-full" placeholder="Exercise">
        </div>
        <div>
            <select wire:model="woDay" class="bg-gray-700 border rounded-md border-gray-600 py-1">
                <option value="Monday" >Monday</option>
                <option value="Tuesday" >Tuesday</option>
                <option value="Wednesday" >Wednesday</option>
                <option value="Thursday" >Thursday</option>
                <option value="Friday" >Friday</option>
                <option value="Saturday" >Saturday</option>
                <option value="Sunday" >Sunday</option>
            </select>
        </div>
    </div>
    <div class="flex gap-2 mt-2 flex justify-end">
        <button wire:click="woAdd" x-tooltip="Add new Workout" class="border border-gray-600 py-1 px-1 hover:bg-gray-700 rounded-md"><x-app.icons.circle-plus class="h-6 w-6"/></button>
        <button @click="woAddAl = !woAddAl" x-tooltip="Close add workout" class="border border-gray-600 py-1 px-1 hover:bg-gray-700 rounded-md"><x-app.icons.x class="h-6 w-6"/></button>
    </div>
</div>

{{-- List Workout --}}
<div x-show="!woAddAl">
    @if ($workouts->count() != 0)
        @foreach ($workouts as $key => $workout)
            <div class="py-0.5 flex justify-between gap-1">
                <div class="grow">
                    <input wire:keydown.enter="changeWorkout({{$workout->id}}, 'workout_set', $event.target.value)" type="text" class="dark:bg-gray-800 px-2 py-1 border-gray-700 rounded-md w-full" value="{{$workout->workout_set}}">
                </div>
                <div class="flex gap-1">
                    <select wire:change="changeWorkout({{$workout->id}}, 'day', $event.target.value)" class="bg-gray-800 border rounded-md border-gray-700 py-0.5">
                        <option value="Monday" @if ($workout->day == 'Monday') selected @endif>Monday</option>
                        <option value="Tuesday" @if ($workout->day == 'Tuesday') selected @endif>Tuesday</option>
                        <option value="Wednesday" @if ($workout->day == 'Wednesday') selected @endif>Wednesday</option>
                        <option value="Thursday" @if ($workout->day == 'Thursday') selected @endif>Thursday</option>
                        <option value="Friday" @if ($workout->day == 'Friday') selected @endif>Friday</option>
                        <option value="Saturday" @if ($workout->day == 'Saturday') selected @endif>Saturday</option>
                        <option value="Sunday" @if ($workout->day == 'Sunday') selected @endif>Sunday</option>
                    </select>
                    <div>
                        <button wire:click="deleteWorkout({{$workout->id}})" class="hover:underline px-2 text-red-500 hover:text-white border border-gray-700 py-1.5 px-1 rounded-md hover:bg-red-500"><x-app.icons.trash class="h-5 w-5"/></button>
                    </div>
                </div>
            </div>
        @endforeach
    @else

    @endif
</div>
