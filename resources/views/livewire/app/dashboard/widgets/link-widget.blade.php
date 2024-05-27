<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-1">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

            <div class="bg-gray-700 p-4 rounded-md">

                <div class="uppercase tracking-widest border-b border-gray-500 mb-1 flex justify-between pb-1">
                    <div>
                        <button wire:click="openListAdd">Links</button>
                    </div>
                    <div class="text-sm flex gap-1">
                        <div>
                            <button class="border border-gray-600 rounded-md hover:bg-green-600 p-1"><x-app.icons.plus class="h-4 w-4" /></button>
                        </div>
                        <div>
                            <select wire:model.live="items" class="text-sm bg-gray-700 border-0 rounded-md py-0.5 w-full">
                                <option value="5" @if ($items == 5) selected @endif>5</option>
                                <option value="10" @if ($items == 10) selected @endif>10</option>
                                <option value="20" @if ($items == 20) selected @endif>20</option>
                                <option value="30" @if ($items == 30) selected @endif>30</option>
                                <option value="50" @if ($items == 50) selected @endif>50</option>
                                <option value="100" @if ($items == 100) selected @endif>100</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- LG Screens --}}
                <div class="hidden sm:block">
                    <div class="flex gap-2">
                        <div class="grow">
                            <input wire:model.live="search" type="text" class="bg-gray-600 rounded-md py-1 w-full" placeholder="Search">
                        </div>
                        <div class="">
                            <select wire:model.live="filterCat" class="bg-gray-600 rounded-md py-1">
                                <option value="">Category</option>
                                @foreach ($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select wire:model.live="filterTag" class="bg-gray-600 rounded-md py-1">
                                <option value="">Tag</option>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select wire:model.live="filterType" class="bg-gray-600 rounded-md py-1">
                                <option value="">Type</option>
                                <option value="app_link">Application</option>
                                <option value="document_link">Document</option>
                                <option value="folder_link">Folder</option>
                            </select>
                        </div>
                        <div>
                            @if ($filterFav)
                                <button wire:click="filterFavFunction" class="border rounded-md p-1">
                                    <x-app.icons.star-solid class="h-6 w-6" />
                                </button>
                            @else
                                <button wire:click="filterFavFunction" class="border rounded-md p-1">
                                    <x-app.icons.star class="h-6 w-6" />
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- SM Screens --}}
                <div class="block sm:hidden">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="flex col-span-2 gap-1">
                            <div class="grow">
                                <input wire:model.live="search" type="text" class="bg-gray-600 rounded-md py-1 w-full" placeholder="Search">
                            </div>
                            <div>
                                @if ($filterFav)
                                    <button wire:click="filterFavFunction" class="border rounded-md p-1">
                                        <x-app.icons.star-solid class="h-6 w-6" />
                                    </button>
                                @else
                                    <button wire:click="filterFavFunction" class="border rounded-md p-1">
                                        <x-app.icons.star class="h-6 w-6" />
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div>
                            <select wire:model.live="filterCat" class="bg-gray-600 rounded-md py-1 w-full">
                                <option value="">Category</option>
                                @foreach ($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select wire:model.live="filterTag" class="bg-gray-600 rounded-md py-1 w-full">
                                <option value="">Tag</option>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <select wire:model.live="filterType" class="bg-gray-600 rounded-md py-1 w-full">
                                <option value="">Type</option>
                                <option value="app_link">Application</option>
                                <option value="document_link">Document</option>
                                <option value="folder_link">Folder</option>
                            </select>
                        </div>

                    </div>
                </div>

                {{-- LIST LINKS --}}
                {{-- LG Screens --}}
                <div class="pt-1">
                    @foreach ($links as $link)
                        <div class="grid grid-cols-3 sm:grid-cols-6 border-t border-gray-600 py-2 px-2 gap-2 hover:bg-gray-700">
                            <div class="col-span-2 sm:col-span-3">
                                <input wire:keydown.enter="changeInputs({{$link->id}}, 'name', $event.target.value)" type="text" class="bg-gray-700 border-0 rounded-md py-1 w-full pl-1" value="{{$link->name}}">
                            </div>
                            <div class="hidden sm:block">
                                <select wire:change="changeInputs({{$link->id}}, 'cat_id', $event.target.value)" class="bg-gray-700 border-0 rounded-md py-1 w-full">
                                    @foreach ($cats as $cat)
                                        <option value="{{$cat->id}}" @if ($cat->id == $link->cat_id) selected @endif>{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="hidden sm:block">
                                <select wire:change="changeInputs({{$link->id}}, 'tag_id', $event.target.value)" class="bg-gray-700 border-0 rounded-md py-1 w-full">
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}" @if ($tag->id == $link->tag_id) selected @endif>{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex gap-2 justify-between">
                                <div class="block sm:hidden"></div>
                                <div class="grow hidden sm:block">
                                    <select wire:change="changeInputs({{$link->id}}, 'type', $event.target.value)" class="bg-gray-700 border-0 rounded-md py-1 w-full">
                                        <option value="folder_link" @if ($link->folder_link) selected @endif>Folder</option>
                                        <option value="app_link" @if ($link->app_link) selected @endif>App</option>
                                        <option value="document_link" @if ($link->document_link) selected @endif>Document</option>
                                    </select>
                                </div>
                                <div>
                                    <div class="p-1.5 border rounded-md border-gray-700 hover:text-blue-500 hover:border-gray-600 hidden sm:block">
                                        <a href="{{$link->link}}"><x-app.icons.link class="h-5 w-5"/></a>
                                    </div>
                                    <div class="p-1.5 border rounded-md border-gray-500 hover:text-blue-500 hover:border-gray-600 block sm:hidden">
                                        <a href="{{$link->link}}"><x-app.icons.link class="h-5 w-5"/></a>
                                    </div>
                                </div>
                                @if ($link->fav)
                                    <div class="hidden sm:block"><button wire:click="setFav({{$link->id}})" class="p-1.5 border rounded-md border-gray-700 text-yellow-500 hover:text-yellow-500 hover:border-gray-600"><x-app.icons.star-solid class="h-5 w-5" /></button></div> @else
                                    <div class="hidden sm:block"><button wire:click="setFav({{$link->id}})" class="p-1.5 border rounded-md border-gray-700 hover:text-yellow-500 hover:border-gray-600"><x-app.icons.star class="h-5 w-5" /></button></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>

        </div>
    </div>
</div>
