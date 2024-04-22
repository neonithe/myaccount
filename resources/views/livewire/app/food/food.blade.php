<div x-data="{showRecipe: false, showNow: 'showRec'}" class="pb-24">
    <livewire:app.top.top-display :title="'Food'"/>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="pl-2 pr-4 pb-6 sm:p-6 text-gray-900 dark:text-gray-100">

                <div class="hidden sm:block">
                    <div class="flex justify-end gap-2">
                        <button @click="showNow = 'showRec', showRecipe = false" class="border rounded-md py-1 px-2 text-xs sm:text-sm hover:bg-gray-600">Show recipes</button>
                        <button @click="showNow = 'showIng'" class="border rounded-md py-1 px-2 text-xs sm:text-sm hover:bg-gray-600">Show ingredients</button>
                        <button @click="showNow = 'addIng'" class="border rounded-md py-1 px-2 text-xs sm:text-sm hover:bg-gray-600">Add ingredient</button>
                        <button @click="showNow = 'addRec'" class="border rounded-md py-1 px-2 text-xs sm:text-sm hover:bg-gray-600">Add recipe</button>
                    </div>
                </div>

                <div x-show="showNow === 'addRec'">@include('livewire.app.food.include.recipe.add')</div>
                <div x-show="showNow === 'showRec'">@include('livewire.app.food.include.recipe.list')</div>
                <div x-show="showNow === 'addIng'">@include('livewire.app.food.include.ingredient.add')</div>
                <div x-show="showNow === 'showIng'">@include('livewire.app.food.include.ingredient.list')</div>

            </div>
        </div>
    </div>

    {{-- Small Screens --}}
    <div class="block sm:hidden">
        {{-- Add + Menu --}}
        <div x-data="{openAdd: false}" class="fixed inset-x-0 bottom-0 bg-gray-600 shadow-lg px-3 z-50 border-t border-b">
            <div class="pt-3 pb-2">
                <div class="justify-between flex">
                    <div class="relative justify-between flex grow">
                        <div class="group relative">
                            <button @click="showNow = 'showRec'"
                                    class="border p-1 rounded-md dark:bg-gray-700 dark:text-white px-2 text-xs"
                                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'showRec'}">
                                Recipe
                            </button>
                        </div>

                        <div class="group relative">
                            <button @click="showNow = 'addRec'"
                                    class="border p-1 rounded-md dark:bg-gray-700 dark:text-white px-2 text-xs"
                                    :class="{'bg-blue-100 dark:bg-blue-700': showNow === 'addRec'}">
                                Recipe +
                            </button>
                        </div>

                        <div class="group relative">
                            <button @click="showNow = 'showIng'"
                                    class="border p-1 rounded-md dark:bg-gray-700 dark:text-white px-2 text-xs"
                                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'showIng'}">
                                Ingred
                            </button>
                        </div>

                        <div class="group relative">
                            <button @click="showNow = 'addIng'"
                                    class="border p-1 rounded-md dark:bg-gray-700 dark:text-white px-2 text-xs"
                                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'addIng'}">
                                Ingred +
                            </button>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>



</div>
