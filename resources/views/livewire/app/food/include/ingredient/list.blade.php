<div class="pt-2 px-2">
    <div class="font-bold text-lg border-b flex sm:justify-between flex-wrap">
        <div>Ingredients</div>
        <div class="font-medium text-sm mt-1">( All data is per 100g - On change, enter per 100g ) ({{ \App\Models\recipe\Ingredient::where('user_id', \Illuminate\Support\Facades\Auth::id())->count() }} st)</div>
    </div>
    <div class="pt-2">
        <input wire:model.live="ingSearch" type="text" class="w-full py-1 rounded-md bg-gray-700" placeholder="Search">
    </div>
    <div class="flex text-sm border-b border-gray-500 font-bold pt-4">
        <div class="grow">Namn</div>
        <div class="w-20 text-center">Cal</div>
        <div class="w-20 hidden sm:block text-center">Fat</div>
        <div class="w-20 hidden sm:block text-center">Car</div>
        <div class="w-20 hidden sm:block text-center">Sug</div>
        <div class="w-20 text-center">Pro</div>
        <div class="w-20 hidden sm:block text-center">Sal</div>
        <div class="w-20 hidden sm:block text-center"></div>
    </div>

    <div>
        @if ($ingredientList)
            @foreach ($ingredientList as $item)
                <div class="flex text-sm border-b border-gray-700 py-1.5">
                    <div class="grow"><input type="text" class="bg-gray-800 py-0.5 pl-1.5 pr-1 text-sm border-0 text-white rounded-sm w-full" value="{{$item->name}}"> </div>
                    <div class="w-24 flex">             <input wire:keydown.enter="changeIngredient({{$item->id}}, 'calories', $event.target.value)" type="number" class="bg-gray-800 py-0.5 pl-1.5 pr-1 text-sm border-0 w-16 text-white rounded-sm text-right"    value="{{ ($item->calories == null) ? 0 : number_format($item->calories*100, ($item->calories < 0.1) ? 2 : 0, '.', ' ') }}"> <span class="text-xs mt-1">kcal</span> </div>
                    <div class="w-20 hidden sm:block">  <input wire:keydown.enter="changeIngredient({{$item->id}}, 'fat', $event.target.value)" type="number" class="bg-gray-800 py-0.5 pl-1.5 pr-1 text-sm border-0 w-16 text-white rounded-sm text-right"         value="{{ ($item->fat == null) ? 0 :      number_format($item->fat*100,      ($item->fat < 0.1) ? 2 : 0, '.', ' ') }}"><span class="text-xs mt-1">g</span></div>
                    <div class="w-20 hidden sm:block">  <input wire:keydown.enter="changeIngredient({{$item->id}}, 'carbs', $event.target.value)" type="number" class="bg-gray-800 py-0.5 pl-1.5 pr-1 text-sm border-0 w-16 text-white rounded-sm text-right"       value="{{ ($item->carbs == null) ? 0 :    number_format($item->carbs*100,    ($item->carbs < 0.1) ? 2 : 0, '.', ' ') }}"><span class="text-xs mt-1">g</span></div>
                    <div class="w-20 hidden sm:block">  <input wire:keydown.enter="changeIngredient({{$item->id}}, 'sugars', $event.target.value)" type="number" class="bg-gray-800 py-0.5 pl-1.5 pr-1 text-sm border-0 w-16 text-white rounded-sm text-right"      value="{{ ($item->sugars == null) ? 0 :   number_format($item->sugars*100,   ($item->sugars < 0.1) ? 2 : 0, '.', ' ') }}"><span class="text-xs mt-1">g</span></div>
                    <div class="w-20">                  <input wire:keydown.enter="changeIngredient({{$item->id}}, 'protein', $event.target.value)" type="number" class="bg-gray-800 py-0.5 pl-1.5 pr-1 text-sm border-0 w-16 text-white rounded-sm text-right"     value="{{ ($item->protein == null) ? 0 :  number_format($item->protein*100,  ($item->protein < 0.1) ? 2 : 0, '.', ' ') }}"><span class="text-xs mt-1">g</span></div>
                    <div class="w-20 hidden sm:block">  <input wire:keydown.enter="changeIngredient({{$item->id}}, 'salt', $event.target.value)" type="number" class="bg-gray-800 py-0.5 pl-1.5 pr-1 text-sm border-0 w-16 text-white rounded-sm text-right"        value="{{ ($item->salt == null) ? 0 :     number_format($item->salt*100,     ($item->salt < 0.1) ? 2 : 0, '.', ' ') }}"><span class="text-xs mt-1">g</span></div>

                    <div class="w-20 hidden sm:block mt-1"><button wire:click="deleteIngredient({{$item->id}})" class="text-red-500 hover:text-red-400"><x-app.icons.trash class="h-4 w-4"/></button></div>
                </div>
            @endforeach
        @else
            <p>There is no records</p>
        @endif
    </div>
    <div class="mt-2">
        {{$ingredientList->links()}}
    </div>
</div>
