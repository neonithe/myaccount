<div class="bg-gray-700 rounded-md p-4">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1 flex justify-between">
        <div>
            <button wire:click="openListAdd">Workout</button>
        </div>
        <div class="text-sm ">
            ({{$workoutDay->count()}})
        </div>
    </div>

    <livewire:app.dashboard.widgets.workout-widget />

</div>
