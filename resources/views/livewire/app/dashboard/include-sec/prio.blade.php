<div class="bg-gray-700 rounded-md p-4">
    <div class="uppercase tracking-widest border-b border-gray-500 mb-1 flex justify-between">
        <div>Prio</div>
        <div class="-mt-0.5">
            <button @click="prioPrivate = !prioPrivate" class="text-xs uppercase hover:underline pb-1">
                <span x-show="!prioPrivate">private ({{$this->getTodos('notice')->where('private', true)->count()}})</span>
                <span x-show="prioPrivate">all todos ({{$this->getTodos('notice')->count()}})</span>
            </button>
        </div>
    </div>

    <div x-show="prioPrivate">
        @foreach ($this->getTodos('notice')->where('private', true) as $item)
            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                <div class="tracking-widest grow">
                    <x-app.dash.edit-modal id="{{$item->id}}" todo="{{$item->todo}}" :editLink="$editLink" :editComment="$editComment" :isPrio="$isPrio" :isPrivate="$isPrivate" />
                </div>
                <div class="pl-2 mt-0.5 flex gap-1">
                    @if ($item->link)
                        <div>
                            <div class="border rounded-md px-0.5 py-0.5 hover:bg-blue-600">
                                <a href="{{$item->link}}" target="_blank"><x-app.icons.link class="h-3 w-3" /></a>
                            </div>
                        </div>
                    @endif
                    <div>
                        <button wire:click="check({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div x-show="!prioPrivate">
        @foreach ($this->getTodos('notice') as $item)
            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                <div class="tracking-widest grow">
                    <x-app.dash.edit-modal id="{{$item->id}}" todo="{{$item->todo}}" :editLink="$editLink" :editComment="$editComment" :isPrio="$isPrio" :isPrivate="$isPrivate" />
                </div>
                <div class="pl-2 mt-0.5 flex gap-1">
                    @if ($item->link)
                        <div>
                            <div class="border rounded-md px-0.5 py-0.5 hover:bg-blue-600">
                                <a href="{{$item->link}}" target="_blank"><x-app.icons.link class="h-3 w-3" /></a>
                            </div>
                        </div>
                    @endif
                    <div>
                        <button wire:click="check({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>