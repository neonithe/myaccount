<div class="bg-gray-700 rounded-md p-4">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1 flex justify-between">
        <div>Workouts</div>
        <div class="text-sm ">
            ({{$workoutDay->count()}})
        </div>
    </div>

    <div>
        @if ($workoutDay->count() != 0)
            @foreach ($workoutDay as $workout)
                <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                    <div class="tracking-widest grow">
                        {{$workout->workout_set}}
                    </div>
                    <div class="pl-2 mt-0.5 flex gap-1">
                        @if ($workout->link)
                            <div>
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
    </div>

</div>
