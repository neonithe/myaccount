<div x-data="{addNewIn: false}">
    <div x-show="addNewIn" class="border rounded-md py-2 px-2 border-gray-600 my-3">
        <div class="flex gap-2 flex-wrap">
            <div class="w-full sm:w-auto sm:grow">
                <label class="text-xs">Ingredient</label>
                <div>
                    <select wire:model="newIngredient" class="bg-gray-700 border-gray-600 border rounded-md py-1 w-full">
                        <option value="">Choose an ingredient</option>
                        @foreach($ingredientList as $ing)
                            <option value="{{ $ing->id }}">{{ $ing->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <x-app.input.number-input model="newVolume" title="Volume" placeholder="2" class="w-full sm:w-auto"/>
            <x-app.input.text-input model="newType" title="Unit" placeholder="dl, gram, liters..." class="w-full sm:w-auto"/>

            <div class="flex gap-2 justify-between grow sm:w-auto">
                <div class="grow">
                    <x-app.input.number-input model="newGram"  title="In grams for calc" right="g" pr="pr-6"  placeholder="50" class="pl-0 sm:pl-12 w-full sm:w-auto grow" />
                </div>
            </div>
        </div>
        <div class="mt-2 flex justify-end py-1">
            <button wire:click="addNewIngredientToRecipe" @click="addNewIn = false" class="border rounded-md px-2 py-1 text-sm hover:bg-gray-700">Add ingredient</button>
        </div>
    </div>
    <div class="flex justify-end mt-3 gap-2">
        <button wire:click="addFoodToTodo" class="border rounded-md px-2 py-1 text-sm hover:bg-gray-700">Add to todo</button>
        <button x-show="!addNewIn" @click="addNewIn = !addNewIn" class="border rounded-md px-2 py-1 text-sm hover:bg-gray-700">Add ingredient</button>
        <button x-show="addNewIn" @click="addNewIn = !addNewIn" class="border rounded-md px-2 py-1 text-sm hover:bg-gray-700">Close add window</button>

        <button @click="showRecipe = !showRecipe" class="border rounded-md px-2 py-1 text-sm hover:bg-gray-700">Close recipe</button>
    </div>
</div>
