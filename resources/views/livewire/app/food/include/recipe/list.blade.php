<div x-show="!showRecipe" class="py-2 px-2">
    <div class="font-bold text-lg border-b px-1 flex justify-between">
        <div>
            Recipes
        </div>
        <div class="text-sm mt-1">
            ({{ \App\Models\recipe\Recipe::where('user_id', \Illuminate\Support\Facades\Auth::id())->count() }} st)
        </div>
    </div>
    <div class="mt-2 border-b pb-2">
        <input wire:model.live="search" type="text" class="w-full text-sm bg-gray-700 py-1 px-2 rounded-md" placeholder="Search">
    </div>
    @foreach ($recipeList as $item)
        <div class="flex justify-between py-2 border-b border-gray-600 px-1">
            <div>
                <button wire:click="getIngredients({{$item->id}})" @click="showRecipe = true" class="truncate text-blue-400 hover:underline">{{$item->name}}</button>
            </div>
            <div class="truncate italic hidden sm:block">
                {{$item->description}}
            </div>
            <div class="flex gap-2">
                <div class="mt-1">
                    @if ($item->link)
                        <a href="{{$item->link}}" target="_blank" class="truncate text-blue-600 hover:text-blue-400"><x-app.icons.link class="h-5 w-5"/></a>
                    @endif
                </div>
                <div class="mt-1">
                    <button wire:click="getIngredients({{$item->id}})" @click="showRecipe = true" class="truncate text-blue-600 hover:text-blue-400"><x-app.icons.mag class="h-5 w-5"/></button>
                </div>
                <div class="mt-0.5">
                    <button wire:click="deleteRecipe({{$item->id}})" class="truncate text-red-600 hover:text-red-400"><x-app.icons.trash class="h-5 w-5"/></button>
                </div>

            </div>
        </div>
    @endforeach
    <div class="mt-2">
        {{$recipeList->links()}}
    </div>
</div>

@if ($getRecipe)
    <div class="hidden sm:block py-2 px-2">
        <div x-show="showRecipe">
            @include('livewire.app.food.include.lg-show-recipe')
            @include('livewire.app.food.include.add-new-ingredient')
        </div>
    </div>

    <div class="block sm:hidden">
        <div x-show="showRecipe">
            {{----}}
            @include('livewire.app.food.include.sm-show-recipe')
            @include('livewire.app.food.include.add-new-ingredient')
        </div>
    </div>
@endif
