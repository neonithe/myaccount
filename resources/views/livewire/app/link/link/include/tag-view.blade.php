<div class="border-b border-gray-600 mb-2 pb-1 uppercase tracking-widest">Add category</div>
<div>
    <div class="flex justify-end gap-2">
        <div class="w-full">
            <label class="text-sm">Name</label>
            <div><input wire:model="tagName" type="text" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full"></div>
        </div>

        <div class="mt-6">
            <button wire:click="addTag" class="border rounded-md bg-gray-700 py-1 px-1">Save</button>
        </div>

    </div>

    <div class="hidden sm:block">
        <div class="mt-4">
            <div class="border-b border-gray-600 mb-2 pb-1 uppercase tracking-widest">Categories</div>
            <div>
                <div class="flex gap-2 flex-wrap">
                    <div class="grow">
                        <input wire:model.live="searchTag" type="text" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full" placeholder="Search">
                    </div>
                </div>
            </div>

            @foreach ($listTag as $item)
                <div class="flex justify-between mt-4 gap-2 border-b border-gray-700 pb-2">
                    <div class="grow">
                        <input wire:keydown.enter="changeTag({{$item->id}}, 'name', $event.target.value, 'Name')" value="{{$item->name}}" type="text" class="bg-gray-800 border border-gray-800 rounded-md py-1 w-full">
                    </div>
                    <div class="flex justify-end gap-1">
                        <button wire:click="deleteTag({{$item->id}})" class="border border-gray-300 hover:bg-red-500 py-1.5 px-1.5 rounded-md"><x-app.icons.trash class="h-5 w-5"/></button>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <div class="block sm:hidden">
        <div class="flex">
            <div>
                <input value="Name" type="text" class="bg-gray-800 border border-gray-800 rounded-md py-1 w-full">
            </div>
            <div class="flex justify-end gap-1">
                <button class="border bg-blue-600 border-gray-300 hover:bg-blue-700 py-1.5 px-1.5 rounded-md"><x-app.icons.link class="h-5 w-5"/></button>
                <button class="border bg-blue-600 border-gray-300 hover:bg-blue-700 py-1.5 px-1.5 rounded-md"><x-app.icons.paperclip class="h-5 w-5"/></button>
                <button class="border bg-yellow-500 border-gray-300 hover:bg-yellow-400 py-1.5 px-1.5 rounded-md"><x-app.icons.star-solid class="h-5 w-5"/></button>
                <button class="border border-gray-300 hover:bg-yellow-500 py-1.5 px-1.5 rounded-md"><x-app.icons.star class="h-5 w-5"/></button>
                <button class="border border-gray-300 hover:bg-red-500 py-1.5 px-1.5 rounded-md"><x-app.icons.trash class="h-5 w-5"/></button>
            </div>
        </div>
    </div>


</div>
