<div class="flex gap-3">
    <div class="sm:w-1/2">
        <div class="font-bold text-lg border-b">
            <input wire:keydown.enter="changeRecipe({{$getRecipe->id}}, 'name', $event.target.value)" type="text" value="{{$getRecipe->name}}" class="font-bold text-lg border-0 bg-gray-800 py-0.5 px-1 -ml-1 w-full">
        </div>

        <div class="mb-4">
            <div class="font-bold text-base">Link</div>
            <div class="flex gap-1 mt-1">
                @if ($getRecipe->link)
                    <div class="grow flex gap-1">
                        <div class="mt-1">http://</div>
                        <input wire:keydown.enter="changeRecipe({{$getRecipe->id}}, 'link', $event.target.value)" type="text" value="{{$getRecipe->link}}" class="bg-gray-800 w-full py-1 px-0.5 rounded-md border-gray-800 text-blue-400">
                    </div>
                    <div class="text-blue-500 hover:underline text-sm border border-gray-700 rounded-md px-1 py-1 hover:border-gray-300 hover:bg-gray-700">
                        <a href="{{$getRecipe->link}}" target="_blank" class="">
                            <x-app.icons.link class="h-5 w-5 mt-0.5" />
                        </a>
                    </div>
                @else
                    <div class="grow">
                        <input wire:keydown.enter="changeRecipe({{$getRecipe->id}}, 'link', $event.target.value)" type="text" value="" class="bg-gray-800 w-full py-1 px-1 text-center rounded-md border-gray-700" placeholder="No link">
                    </div>
                @endif
            </div>
        </div>

        <div>
            <div class=" font-bold">Description</div>
            <div class="italic mt-1">
                @if ($getRecipe->description)
                    <textarea wire:keydown.enter="changeRecipe({{$getRecipe->id}}, 'description', $event.target.value)" rows="2" class="bg-gray-800 rounded-md border-gray-800 w-full px-0.5 py-0.5 -ml-0.5">{{$getRecipe->description}} </textarea>
                @else
                    <textarea wire:keydown.enter="changeRecipe({{$getRecipe->id}}, 'description', $event.target.value)" rows="2" class="bg-gray-800 rounded-md border-gray-800 w-full -ml-0.5" placeholder="There is no description added">{{$getRecipe->description}} </textarea>
                @endif
            </div>
        </div>

        @if ($getIngredientsList)
            <div class="mt-4">
                <div class="border-b border-gray-600 font-bold mb-2">Energy for meal</div>
                <div class="text-sm grid grid-cols-4">
                    <div class="font-bold">Protein:</div>
                    <div class="font-bold">@if ($proteinCal) {{number_format($proteinCal, 0, ',', ' ')}} g @else - @endif</div>
                    <div class="font-bold">Calories:</div>
                    <div class="font-bold">@if ($proteinCal) {{number_format($calCal, 0, ',', ' ')}} g @else - @endif</div>
                    <div>Fat:</div>
                    <div>@if ($proteinCal) {{number_format($fatCal, 0, ',', ' ')}} g @else - @endif</div>
                    <div>Sugar:</div>
                    <div>@if ($proteinCal) {{number_format($sugarCal, 0, ',', ' ')}} g @else - @endif</div>
                    <div>Carbs:</div>
                    <div>@if ($proteinCal) {{number_format($carbCal, 0, ',', ' ')}} g @else - @endif</div>
                    <div>Salt:</div>
                    <div>@if ($proteinCal) {{number_format($saltCal, 0, ',', ' ')}} g @else - @endif</div>
                </div>
            </div>
            <div class="mt-4  mb-1 pb-2">
                <div class="border-b border-gray-600 font-bold mb-2 flex justify-between">
                    <div>Energy per portion</div>
                    <div>
                        <select wire:change="changePortion($event.target.value)" class="py-0.5 bg-gray-800 border-0 rounded-md text-center">
                            <option value="1" @if ($getRecipe->portion == 1) selected @endif>1</option>
                            <option value="2" @if ($getRecipe->portion == 2) selected @endif>2</option>
                            <option value="3" @if ($getRecipe->portion == 3) selected @endif>3</option>
                            <option value="4" @if ($getRecipe->portion == 4) selected @endif>4</option>
                            <option value="5" @if ($getRecipe->portion == 5) selected @endif>5</option>
                            <option value="6" @if ($getRecipe->portion == 6) selected @endif>6</option>
                            <option value="7" @if ($getRecipe->portion == 7) selected @endif>7</option>
                            <option value="8" @if ($getRecipe->portion == 8) selected @endif>8</option>
                            <option value="9" @if ($getRecipe->portion == 9) selected @endif>9</option>
                            <option value="10" @if ($getRecipe->portion == 10) selected @endif>10</option>
                            <option value="11" @if ($getRecipe->portion == 11) selected @endif>11</option>
                            <option value="12" @if ($getRecipe->portion == 12) selected @endif>12</option>
                        </select>
                    </div>
                </div>
                @if ($getRecipe->portion)
                    <div class="text-sm grid grid-cols-4">
                        <div class="font-bold">Protein:</div>
                        <div class="font-bold">@if ($proteinCal) {{number_format( $proteinCal / $getRecipe->portion , 0, ',', ' ')}} g @else - @endif</div>
                        <div class="font-bold">Calories:</div>
                        <div class="font-bold">@if ($proteinCal) {{number_format($calCal/$getRecipe->portion, 0, ',', ' ')}} kcal @else - @endif</div>
                        <div>Fat:</div>
                        <div>@if ($proteinCal) {{number_format($fatCal/$getRecipe->portion, 0, ',', ' ')}} g @else - @endif</div>
                        <div>Sugar:</div>
                        <div>@if ($proteinCal) {{number_format($sugarCal/$getRecipe->portion, 0, ',', ' ')}} g @else - @endif</div>
                        <div>Carbs:</div>
                        <div>@if ($proteinCal) {{number_format($carbCal/$getRecipe->portion, 0, ',', ' ')}} g @else - @endif</div>
                        <div>Salt:</div>
                        <div>@if ($proteinCal) {{number_format($saltCal/$getRecipe->portion, 0, ',', ' ')}} g @else - @endif</div>
                    </div>
                @endif
            </div>
        @endif

    </div>
    <div class="grow mt-1.5">

        <div class="border-b mb-1 pb-0.5 text-sm flex mt-1">
            <div class="grow">Ingredient</div>
            <div>Volume/Gram</div>
        </div>
        @if ($getIngredientsList)
            @foreach ($getIngredientsList as $item)
                <div class="flex gap-1">
                    <div class="grow">
                        <div class="mt-2">{{$item->name}}</div>
                    </div>
                    <div class="flex gap-1 py-1">
                        <div>
                            <input wire:keydown.enter="changeData({{$getRecipe->id}},{{$item->id}}, 'volume', $event.target.value)" type="text" value="{{$item->pivot->volume}}" class="bg-gray-800 w-16 py-1 px-1 text-center rounded-md border-gray-700">
                        </div>
                        <div>
                            <input wire:keydown.enter="changeData({{$getRecipe->id}},{{$item->id}}, 'type_name', $event.target.value)" type="text" value="{{$item->pivot->type_name}}" class="bg-gray-800 w-12 py-1 px-1 text-center rounded-md border-gray-700">
                        </div>
                    </div>
                    <div class="flex gap-1 py-1">
                        <div>
                            <div class="relative rounded-md shadow-sm">
                                <input wire:keydown.enter="changeData({{$getRecipe->id}},{{$item->id}}, 'gram', $event.target.value)" type="text" value="{{$item->pivot->gram}}" class="w-20 text-center block rounded-md border-0 py-1 pr-6 dark:bg-gray-700 dark:border dark:border-gray-500 dark:text-white text-gray-900 ">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 sm:text-sm">g</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>
<div class="border-b mt-2">

</div>
