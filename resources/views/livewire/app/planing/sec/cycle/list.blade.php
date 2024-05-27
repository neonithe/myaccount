<div>
    Frontend
</div>
<div class="grid grid-cols-6 pb-1 gap-2 border-b">
    <div>Cycle nr</div>
    <div class="col-span-2">Name</div>
    <div>Start</div>
    <div>End</div>
    <div>Time</div>
</div>
@foreach ($feCycles as $cycle)
    <div class="grid grid-cols-6 pb-1 gap-2">
        <div><input wire:keydown.enter="changeCycle({{$cycle->id}}, 'cycle_nr', $event.target.value)" type="number" class="bg-gray-800 p-0.5 rounded-md border-0" value="{{$cycle->cycle_nr}}"></div>
        <div class="col-span-2">
            <input wire:keydown.enter="changeCycle({{$cycle->id}}, 'name', $event.target.value)" type="text" class="bg-gray-800 p-0.5 rounded-md border-0 w-full" value="{{$cycle->name}}"></div>
        <div><input wire:keydown.enter="changeCycle({{$cycle->id}}, 'cycle_start', $event.target.value)" type="date" class="bg-gray-800 p-0.5 rounded-md border-0" value="{{$cycle->cycle_start}}"></div>
        <div><input wire:keydown.enter="changeCycle({{$cycle->id}}, 'cycle_end', $event.target.value)" type="date" class="bg-gray-800 p-0.5 rounded-md border-0" value="{{$cycle->cycle_end}}"></div>
        <div><input wire:keydown.enter="changeCycle({{$cycle->id}}, 'time', $event.target.value)" type="number" class="bg-gray-800 p-0.5 rounded-md border-0" value="{{$cycle->time}}"></div>
    </div>
@endforeach

<div>
    Backend
</div>
<div class="grid grid-cols-6 pb-1 gap-2 border-b">
    <div>Cycle nr</div>
    <div class="col-span-2">Name</div>
    <div>Start</div>
    <div>End</div>
    <div>Time</div>
</div>
@foreach ($beCycles as $cycle)
    <div class="grid grid-cols-6 pb-1 gap-2">
        <div><input type="number" class="bg-gray-800 p-0.5 rounded-md border-0" value="{{$cycle->cycle_nr}}"></div>
        <div class="col-span-2"><input type="text" class="bg-gray-800 p-0.5 rounded-md border-0 w-full" value="{{$cycle->name}}"></div>
        <div><input type="date" class="bg-gray-800 p-0.5 rounded-md border-0" value="{{$cycle->cycle_start}}"></div>
        <div><input type="date" class="bg-gray-800 p-0.5 rounded-md border-0" value="{{$cycle->cycle_end}}"></div>
        <div><input type="number" class="bg-gray-800 p-0.5 rounded-md border-0" value="{{$cycle->time}}"></div>
    </div>
@endforeach
