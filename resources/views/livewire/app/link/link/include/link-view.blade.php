<div class="border-b border-gray-600 mb-2 pb-1 uppercase tracking-widest">Add link</div>
<div>
    {{-- ADD LINKS --}}
    <div class="grid grid-cols-1 sm:grid-cols-5 gap-2">
        <div class="w-full">
            <label class="text-sm">Name</label>
            <div><input wire:model="name" type="text" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full"></div>
        </div>
        <div class="w-full">
            <label class="text-sm">Link</label>
            <div><input wire:model="link" type="text" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full"></div>
        </div>
        <div class="w-full">
            <label class="text-sm">Category</label>
            <div>
                <select wire:model="cat_id" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full">
                    <option value="">Choose category</option>
                    @foreach ($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-full">
            <label class="text-sm">Tag</label>
            <div>
                <select wire:model="tag_id" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full">
                    <option value="">Choose tag</option>
                    @foreach ($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="text-sm">Type <span class="text-xs">(@if ($app) Application @elseif($fold) Folder @elseif($doc) Document @endif)</span></label>
            <div class="flex justify-between">
                <div class="flex gap-1">
                    <button wire:click="setType('app')" class="border rounded-md py-1 px-1 @if ($app) bg-blue-500 @else bg-gray-700 @endif"><x-app.icons.app class="h-6 w-6"/></button>
                    <button wire:click="setType('fold')" class="border rounded-md py-1 px-1 @if ($fold) bg-blue-500 @else bg-gray-700 @endif"><x-app.icons.folder class="h-6 w-6"/></button>
                    <button wire:click="setType('doc')" class="border rounded-md py-1 px-1 @if ($doc) bg-blue-500 @else bg-gray-700 @endif"><x-app.icons.document class="h-6 w-6"/></button>
                </div>
                <div class="flex gap-2">
                    <div>
                        <button wire:click="setFav" class="border rounded-md @if ($fav) bg-blue-500 @else bg-gray-700 @endif py-1 px-1"><x-app.icons.star class="h-6 w-6"/></button>
                    </div>
                    <div>
                        <button wire:click="saveLink" class="border rounded-md bg-gray-700 py-1 px-1">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LIST LINKS --}}
    <div class="hidden sm:block">
        <div class="mt-4">
            <div class="border-b border-gray-600 mb-2 pb-1 uppercase tracking-widest">Links</div>
            <div>
                <div class="flex gap-2 flex-wrap">
                    <div class="grow">
                        <input wire:model.live="search" type="text" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full" placeholder="Search">
                    </div>
                    <div class="grow sm:grow-0">
                        <select wire:model.live="filterCat" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full">
                            <option value="">Filter Category</option>
                            @foreach ($cats as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grow sm:grow-0">
                        <select wire:model.live="filterTag" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full">
                            <option value="">Filter Tag</option>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grow sm:grow-0">
                        <select wire:model.live="filterType" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full">
                            <option value="">Filter type</option>
                            <option value="app_link">Application</option>
                            <option value="document_link">Document</option>
                            <option value="folder_link">Folder</option>
                        </select>
                    </div>
                    <div class="grow sm:grow-0">
                        <select wire:model.live="filterFav" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full">
                            <option value="">All</option>
                            <option value="fav">Favorite</option>
                            <option value="nofav">Not favorite</option>
                        </select>
                    </div>
                    <div class="grow sm:grow-0">
                        <select wire:model.live="showLinks" class="bg-gray-700 border border-gray-500 rounded-md py-1 w-full">
                            <option value="500">All</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>

            @foreach ($links as $item)
                <div class="grid grid-cols-5 mt-4 gap-2 border-b border-gray-700 pb-2">
                    <div>
                        <input value="{{$item->name}}" type="text" class="bg-gray-800 border border-gray-800 rounded-md py-1 w-full">
                    </div>
                    <div class="grow">
                        <select wire:change="changeLink({{$item->id}}, 'cat_id', $event.target.value, 'Category')" class="py-1 rounded-md bg-gray-800 border-gray-800 border w-full">
                            @foreach ($cats as $cat)
                                <option value="{{$cat->id}}" @if ($item->cat_id == $cat->id) selected @endif>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-1 w-full">
                        <div class="grow">
                            <select wire:change="changeLink({{$item->id}}, 'tag_id', $event.target.value, 'Tag')" class="py-1 rounded-md bg-gray-800 border-gray-800 border w-full">
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}" @if ($item->tag_id == $tag->id) selected @endif>{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grow">
                            <select wire:change="changeType({{$item->id}}, $event.target.value, 'Type')" class="py-1 rounded-md bg-gray-800 border-gray-800 border w-full">
                                <option value="app_link" @if ($item->app_link) selected @endif>App</option>
                                <option value="folder_link" @if ($item->folder_link) selected @endif>Folder</option>
                                <option value="document_link" @if ($item->document_link) selected @endif>Doc</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <input value="{{$item->link}}" type="text" class="text-sm bg-gray-800 border border-gray-800 rounded-md py-1 w-full">
                    </div>
                    <div class="flex justify-end gap-1">
                        <div class="border bg-blue-600 border-gray-300 hover:bg-blue-700 py-1.5 px-1.5 rounded-md">
                            <a href="{{$item->link}}" target="_blank" class=""><x-app.icons.link class="h-5 w-5"/></a>
                        </div>
                        @if ($item->fav)
                            <button wire:click="toggleFav({{$item->id}})" class="border bg-yellow-500 border-gray-300 hover:bg-yellow-400 py-1.5 px-1.5 rounded-md"><x-app.icons.star-solid class="h-5 w-5"/></button>
                        @else
                            <button wire:click="toggleFav({{$item->id}})" class="border border-gray-300 hover:bg-yellow-500 py-1.5 px-1.5 rounded-md"><x-app.icons.star class="h-5 w-5"/></button>
                        @endif
                        <button wire:click="deleteLink({{$item->id}})" class="border border-gray-300 hover:bg-red-500 py-1.5 px-1.5 rounded-md"><x-app.icons.trash class="h-5 w-5"/></button>
                    </div>
                </div>
            @endforeach

            <div class="mt-2">
                {{$links->links()}}
            </div>

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
