<div class="px-2 mt-2">
    <div class="font-bold text-lg border-b flex justify-between">
        <div>Add ingredients</div>
        <div class="font-medium text-sm mt-1">( Add data per 100g )</div>
    </div>

    <div class="flex gap-2 flex-wrap justify-between">
        <x-app.input.text-input model="ingredientName" title="Name" placeholder="Smör" class="grow"/>
        <x-app.input.gram-input model="cal" title="Calories ({{ ($cal >= 0) ? $cal/100 : 0 }})" placeholder="2"/>
        <x-app.input.gram-input model="fat" title="Fat ({{ ($fat >= 0) ? $fat/100 : 0 }})" placeholder="2"/>
        <x-app.input.gram-input model="carb" title="Carbs ({{ ($carb >= 0) ? $carb/100 : 0 }})" placeholder="2"/>
        <x-app.input.gram-input model="sugar" title="Sugars ({{ ($sugar >= 0) ? $sugar/100 : 0 }})" placeholder="2"/>
        <x-app.input.gram-input model="protein" title="Protein ({{ ($protein >= 0) ? $protein/100 : 0 }})" placeholder="2"/>
        <x-app.input.gram-input model="salt" title="Salt ({{ ($salt >= 0) ? $salt/100 : 0 }})" placeholder="2"/>
    </div>


    <div class="flex justify-end mt-3">
        <button wire:click="addIngredient" class="border border-gray-400 rounded-md py-1 px-2 text-sm">Add ingredient</button>
    </div>
</div>
