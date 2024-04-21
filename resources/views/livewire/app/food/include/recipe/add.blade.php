<div class="px-2 mt-2">
    <div class="font-bold text-lg border-b">
        Add recipe
    </div>

    <div>
        <div class="flex gap-2 mb-2 flex-wrap">
            <x-app.input.text-input model="name" title="Name" placeholder="Pancakes" class="grow"/>
            <x-app.input.text-input model="link" title="Link" placeholder="www.google.com" class="grow"/>
            <div>
                <label class="text-xs">Portion</label>
                <div>
                    <select wire:model="recipePortion" class="py-1 border-gray-600 border bg-gray-700 rounded-md text-center">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="12">12</option>
                    </select>
                </div>
            </div>
        </div>
        <textarea wire:model="description" placeholder="Description" class="w-full bg-gray-700 rounded-md"></textarea>

        @foreach($ingredients as $index => $ingredient)
            <div class="relative mt-3">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                    <span class="bg-white dark:bg-gray-800 pr-2 text-sm text-gray-500 dark:text-white font-bold">Ingredient {{$index+1}}</span>
                </div>
            </div>
            <div class="flex gap-2 flex-wrap">
                <div class="w-full sm:w-auto sm:grow">
                    <label class="text-xs">Ingredient</label>
                    <div>
                        <select wire:model="ingredients.{{ $index }}.id" class="bg-gray-700 border-gray-600 border rounded-md py-1 w-full">
                            <option value="">Choose an ingredient</option>
                            @foreach($ingredientList as $ing)
                                <option value="{{ $ing->id }}">{{ $ing->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <x-app.input.number-input model="ingredients.{{ $index }}.volume" title="Volume" placeholder="2" class="w-full sm:w-auto"/>
                <x-app.input.text-input model="ingredients.{{ $index }}.type" title="Unit" placeholder="dl, gram, liters..." class="w-full sm:w-auto"/>

                <div class="flex gap-2 justify-between grow sm:w-auto">
                    <div class="grow">
                        <x-app.input.number-input model="ingredients.{{ $index }}.gram"  title="In grams for calc" right="g" pr="pr-6"  placeholder="50" class="pl-0 sm:pl-12 w-full sm:w-auto grow" />
                    </div>
                    <div class="mt-6">
                        <button type="button" wire:click="removeIngredient({{ $index }})" class="border rounded-md py-1.5 px-2 hover:bg-red-500"><x-app.icons.trash class="w-5 h-5"/></button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-4 flex justify-end gap-2">
            <button type="button" wire:click="addIngredientToRecipe" class="border rounded-md py-1.5 px-2 hover:bg-gray-700">Add Ingredient</button>
            <button wire:click="saveRecipe" class="border rounded-md py-1.5 px-2 hover:bg-gray-700">Save Recipe</button>
        </div>
    </div>
</div>
