<div>

    <div class="grid grid-cols-4 pb-12 gap-2">
        <div class="uppercase mt-1">
            Workhours/day:
        </div>
        <div>
            <div>
                <input type="number" value="{{$settings->work_day_hours}}" class="bg-gray-600 rounded-md border-0 p-1 w-16 text-center">
            </div>
        </div>

        <div class="uppercase mt-1">
            Days in week:
        </div>
        <div>
            <div>
                <input type="number" value="{{$settings->days_in_week}}" class="bg-gray-600 rounded-md border-0 p-1 w-16 text-center">
            </div>
        </div>

        <div class="uppercase mt-1">
            Weeks in cycle:
        </div>
        <div>
            <div>
                <input type="number" value="{{$settings->cycle_weeks}}" class="bg-gray-600 rounded-md border-0 p-1 w-16 text-center">
            </div>
        </div>

        <div class="uppercase mt-1">
            Points per hour:
        </div>
        <div>
            <div>
                <input type="number" value="{{$settings->points_per_hour}}" class="bg-gray-600 rounded-md border-0 p-1 w-16 text-center">
            </div>
        </div>

        <div class="uppercase mt-1">
            Focus factor:
        </div>
        <div>
            <div>
                <input type="number" value="{{$settings->focus_factor}}" class="bg-gray-600 rounded-md border-0 p-1 w-16 text-center">
            </div>
        </div>
    </div>

</div>
