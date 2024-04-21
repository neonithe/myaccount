<div class="gap-3">
    <div x-data="{editRecipe: false}" class="sm:w-1/2">
        <div class="font-bold text-lg border-b flex justify-between">
            <div class="grow">
                <input wire:keydown.enter="changeRecipe({{$getRecipe->id}}, 'name', $event.target.value)" type="text" value="{{$getRecipe->name}}" class="font-bold text-lg border-0 bg-gray-800 py-0.5 px-1 -ml-1 w-full">
            </div>
            <div>
                <button @click="editRecipe = !editRecipe" class="text-blue-500 underline font-bold border rounded-md border-blue-500 px-0.5 py-0.5"><x-app.icons.edit class="h-4 w-4"/></button>
            </div>
        </div>
        <div x-show="!editRecipe">
            <div class="text-sm">
                Link: <a href="{{$getRecipe->link}}" target="_blank" class="truncate text-blue-500 hover:underline text-sm">{{$getRecipe->link}} </a>
            </div>
            <div class="italic mt-2">
                {{$getRecipe->description}}
            </div>
        </div>
        <div x-show="editRecipe" class="mt-1">
            <div class="text-sm">
                <input wire:keydown.enter="changeRecipe({{$getRecipe->id}}, 'link', $event.target.value)" type="text" value="@if ($getRecipe->link) {{$getRecipe->link}} @endif" class="border border-gray-700 rounded-md py-1 text-xs bg-gray-800 w-full" @if (!$getRecipe->link) placeholder="No link" @endif>
            </div>
            <div class="italic mt-2">
                <textarea wire:keydown.enter="changeRecipe({{$getRecipe->id}}, 'description', $event.target.value)" rows="3" class="border border-gray-700 rounded-md py-1 text-xs bg-gray-800 w-full">{{$getRecipe->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="grow mt-1.5">

        <div class="grid grid-cols-2 gap-3 grow border-b mb-1 pb-0.5">
            <div class="text-sm font-bold">Ingredient</div>
            <div class="grid grid-cols-2 text-sm font-bold">
                <div class="-ml-1.5">Unit</div>
                <div></div>
            </div>
        </div>
        @if ($getIngredientsList)
            @foreach ($getIngredientsList as $item)

                <div x-data="{showData: false, editData: false}" class="border-b border-gray-600 py-1">
                    <div class="grid grid-cols-2">
                        <div>{{$item->name}}</div>
                        <div class="grid grid-cols-2">
                            <div>{{$item->pivot->volume}} {{$item->pivot->type_name}}</div>
                            <div class="text-end">
                                <button @click="editData = !editData" class="text-blue-500 underline font-bold border rounded-md border-blue-500 px-0.5 py-0.5"><x-app.icons.edit class="h-4 w-4"/></button>
                                <button @click="showData = !showData" class="text-blue-500 underline font-bold border rounded-md border-blue-500 px-0.5 py-0.5"><x-app.icons.mag class="h-4 w-4"/></button>
                            </div>
                        </div>
                        <div x-show="editData" class="flex gap-1 w-full col-span-2">
                            <div class="flex gap-1 py-1 grow">
                                <div class="grow">
                                    <input wire:keydown.enter="changeData({{$getRecipe->id}},{{$item->id}}, 'volume', $event.target.value)" type="text" value="{{$item->pivot->volume}}" class="bg-gray-800 w-full py-1 px-1 text-center rounded-md border-gray-700">
                                </div>
                                <div class="grow">
                                    <input wire:keydown.enter="changeData({{$getRecipe->id}},{{$item->id}}, 'type_name', $event.target.value)" type="text" value="{{$item->pivot->type_name}}" class="bg-gray-800 w-12 py-1 px-1 text-center rounded-md border-gray-700">
                                </div>
                            </div>
                            <div class="flex gap-1 py-1">
                                <div>
                                    <div class="relative rounded-md shadow-sm">
                                        <input wire:keydown.enter="changeData({{$getRecipe->id}},{{$item->id}}, 'gram', $event.target.value)" type="text" value="{{$item->pivot->gram}}" class="w-full text-center block rounded-md border-0 py-1 pr-6 dark:bg-gray-700 dark:border dark:border-gray-500 dark:text-white text-gray-900 ">
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 sm:text-sm">g</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-show="showData">
                        <div class="col-span-2">
                            <div class="grid grid-cols-6 gap-4 text-sm font-bold">
                                <div>Cal</div>
                                <div>Fat</div>
                                <div>Car</div>
                                <div>Pro</div>
                                <div>Sug</div>
                                <div>Sal</div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="grid grid-cols-6 gap-4 text-xs">
                                <div>{{$this->getIngredientData($item->pivot->ingredient_id, 'cal') * $item->pivot->gram}}g</div>
                                <div>{{$this->getIngredientData($item->pivot->ingredient_id, 'fat') * $item->pivot->gram}}g</div>
                                <div>{{$this->getIngredientData($item->pivot->ingredient_id, 'car') * $item->pivot->gram}}g</div>
                                <div>{{$this->getIngredientData($item->pivot->ingredient_id, 'pro') * $item->pivot->gram}}g</div>
                                <div>{{$this->getIngredientData($item->pivot->ingredient_id, 'sug') * $item->pivot->gram}}g</div>
                                <div>{{$this->getIngredientData($item->pivot->ingredient_id, 'sal') * $item->pivot->gram}}g</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="mt-4 border-b border-gray-700 mb-1 pb-2">
            <div class="border-b border-gray-600 font-bold mb-2">Energy for meal</div>
            <div class="text-sm grid grid-cols-4">
                <div class="font-bold">Protein:</div>
                <div class="font-bold">@if ($proteinCal) {{number_format($proteinCal, 0, ',', ' ')}} g @else - @endif</div>
                <div class="font-bold">Calories:</div>
                <div class="font-bold">@if ($proteinCal) {{number_format($calCal, 0, ',', ' ')}} kcal @else - @endif</div>
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

        <div class="mt-4 border-b border-gray-700 mb-1 pb-2">
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
            <div class="text-sm grid grid-cols-4">
                <div class="font-bold">Protein:</div>
                <div class="font-bold">@if ($proteinCal) {{number_format($proteinCal/$getRecipe->portion, 0, ',', ' ')}} g @else - @endif</div>
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
        </div>
    </div>
</div>
