{{-- LINKS --}}
<div class="bg-gray-700 rounded-md p-4 col-span-1 sm:col-span-3">
    <div class="border-b border-gray-500 mb-1 flex justify-between -mt-1">
        <div class="uppercase tracking-widest mt-1">Links</div>
        <div>
            <select wire:model.live="showLinks" class="border-0 py-0.5 bg-gray-700 rounded-md text-center">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>
    <div class="flex gap-1">
        <div class="grow">
            <input wire:model.live="search" type="text" class="border border-gray-600 rounded-md py-0.5 bg-gray-700 w-full text-sm" placeholder="Search">
        </div>
        <div class="hidden sm:block">
            <select wire:model.live="filterCat" class="border border-gray-600 rounded-md py-0.5 bg-gray-700 text-sm">
                <option value="">Filter cat</option>
                @foreach ($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="hidden sm:block">
            <select wire:model.live="filterTag" class="border border-gray-600 rounded-md py-0.5 bg-gray-700 text-sm">
                <option value="">Filter tag</option>
                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <select wire:model.live="filterFav" class="border border-gray-600 rounded-md py-0.5 bg-gray-700 text-sm">
                <option value="all">All</option>
                <option value="fav">Fav</option>
                <option value="nofav">No fav</option>
            </select>
        </div>
    </div>
    @foreach ($links as $link)
        <div class="grid grid-cols-2 text-sm py-1 border-b border-gray-600 px-1 rounded-md py-2">
            <div class="tracking-widest truncate grow">
                <a href="{{$link->link}}" target="_blank" class="font-bold text-blue-200 hover:underline inline-flex">
                    {{$link->name}}
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="text-end hidden sm:block">
                    <select wire:change="changeLink({{$link->id}}, 'cat_id', $event.target.value, 'Category')" class="bg-gray-700 border-0 py-0.5 text-xs">
                        @foreach ($this->getCat() as $cat)
                            <option value="{{$cat->id}}" @if ($cat->id == $link->cat_id) selected @endif>{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-end hidden sm:block">
                    <select wire:change="changeLink({{$link->id}}, 'tag_id', $event.target.value, 'Tag')" class="bg-gray-700 border-0 py-0.5 text-xs">
                        @foreach ($this->getTag() as $tag)
                            <option value="{{$tag->id}}" @if ($tag->id == $link->tag_id) selected @endif>{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    @if ($link->fav)
                        <button wire:click="changeFav({{$link->id}})" class="text-yellow-500"><x-app.icons.star-solid class="h-5 w-5" /></button>
                    @else
                        <button wire:click="changeFav({{$link->id}})" class="text-yellow-500"><x-app.icons.star class="h-5 w-5" /></button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
