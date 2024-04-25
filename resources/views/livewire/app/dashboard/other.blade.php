<div class="bg-gray-700 rounded-md p-4 hidden sm:block">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Todos</div>

    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">All Todos</div>
        <div>{{$allCount}} st</div>
    </div>
    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">Todos</div>
        <div>{{$regularCount}} st</div>
    </div>
    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">Prio</div>
        <div>{{$prioCount}} st</div>
    </div>
    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">Reminders</div>
        <div>{{$remindCount}} st</div>
    </div>
    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">Meetings</div>
        <div>{{$meetingCount}} st</div>
    </div>
    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">Contact</div>
        <div>{{$contactCount}} st</div>
    </div>
    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">Paused</div>
        <div>{{$pausedCount}} st</div>
    </div>
    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">Done</div>
        <div>{{$doneCount}} st</div>
    </div>
</div>

<div class="bg-gray-700 rounded-md p-4 hidden sm:block">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Workout</div>
    @foreach ($workouts as $workout)
        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
            <div class="tracking-widest">{{$workout->workout_set}}</div>
            <div></div>
        </div>
    @endforeach
</div>

<div class="bg-gray-700 rounded-md p-4 hidden sm:block">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Food</div>
    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">Recipes</div>
        <div>{{$recipeCount}} st</div>
    </div>
    <div class="flex justify-between text-sm border-b border-gray-600 py-1">
        <div class="tracking-widest">Ingredients</div>
        <div>{{$ingCount}} st</div>
    </div>
</div>
