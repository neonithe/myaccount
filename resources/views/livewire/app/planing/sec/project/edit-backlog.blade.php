<div x-data="{display: 'show'}">
    <div class="flex justify-between gap-2 border-b border-gray-500 mb-4 pb-2">
        <div class="tracking-widest uppercase text-lg">
            <span x-show="display == 'show'">Show</span>
            <span x-show="display == 'update'">Edit/Update</span>
        </div>
        <div class="flex gap-2">
            <button @click="display = 'update'" class="border rounded-md py-1 px-2 hover:bg-blue-600">Edit/Update</button>
            <button @click="display = 'show'" class="border rounded-md py-1 px-2 hover:bg-blue-600">Show</button>
        </div>
    </div>

    <div x-show="display == 'show'">
        <div>
            <div>
                <label class="text-sm">Name</label>
                <div class="font-bold text-xl">
                    {{$editProject->name}}
                </div>
            </div>
            <div>
                <label class="text-sm">Link</label>
                <div class="truncate">
                    @if ($editProject->link)
                        <a href="{{$editProject->link}}" target="_blank" class="underline text-blue-500">
                            {{$editProject->link}}
                        </a>
                    @else
                        <span class="italic"> No link set</span>
                    @endif
                </div>
            </div>
            <div class="flex gap-10 mt-3">
                <div>
                    <label class="text-sm">Prio</label>
                    <div>
                        {{$editProject->prio}}
                    </div>
                </div>
                <div>
                    <label class="text-sm">Quarter</label>
                    <div>
                        @switch($editProject->quarter)
                            @case(0) Not set @break
                            @case(1) Q1 @break
                            @case(2) Q2 @break
                            @case(3) Q3 @break
                            @case(4) Q4 @break
                        @endswitch
                    </div>
                </div>
                <div>
                    <label class="text-sm">Size</label>
                    <div>
                        @switch($editProject->size)
                            @case(5) Small @break
                            @case(10) Medium @break
                            @case(20) Large @break
                            @case(30) Extra large @break
                        @endswitch
                    </div>
                </div>
                <div>
                    <label class="text-sm">Frontend</label>
                    <div>
                        {{number_format($editProject->fe_perc, 0, ',', ' ')}}%
                    </div>
                </div>
                <div>
                    <label class="text-sm">Backend</label>
                    <div>
                        {{number_format($editProject->be_perc, 0, ',', ' ')}}%
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="border-b mb-2">
                    <label class="text-sm">Comment</label>
                </div>
                <div>
                    @if ($editProject->comment)
                        {{$editProject->comment}}
                    @else
                        <span class="italic">No comment</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div x-show="display == 'update'">
        <div>
            <div>
                <div class="text-sm">Name</div>
                <div>
                    <input wire:model="name" type="text" class="bg-gray-600 rounded-md py-1 w-full">
                </div>
            </div>
            <div class="mt-3">
                <div class="text-sm">Link</div>
                <div>
                    <input wire:model="link" type="text" class="bg-gray-600 rounded-md py-1 w-full">
                </div>
            </div>

            <div class="flex gap-2 my-3">
                <div>
                    <div class="text-sm">Prio</div>
                    <div>
                        <select wire:model="prio" class="bg-gray-600 rounded-md py-1">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="text-sm">Quarter</div>
                    <div>
                        <select wire:model="quarter" class="bg-gray-600 rounded-md py-1">
                            <option value="">Not set</option>
                            <option value="">Q1</option>
                            <option value="">Q2</option>
                            <option value="">Q3</option>
                            <option value="">Q4</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="text-sm">Size</div>
                    <div>
                        <select wire:model="size" class="bg-gray-600 rounded-md py-1">
                            <option value="2">XS</option>
                            <option value="5">S</option>
                            <option value="10">M</option>
                            <option value="20">L</option>
                            <option value="30">XL</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="text-sm">Frontend</div>
                    <div>
                        <input wire:model="fe" type="text" class="bg-gray-600 rounded-md py-1 w-16">
                        %
                    </div>
                </div>
                <div>
                    <div class="text-sm">Backend</div>
                    <div>
                        <input wire:model="be" type="text" class="bg-gray-600 rounded-md py-1 w-16">
                        %
                    </div>
                </div>
            </div>
            <div class="grow">
                <div class="text-sm">Comment</div>
                <textarea wire:model="comment" rows="5" class="w-full bg-gray-600">{{$editProject->comment}}</textarea>
            </div>
            <div class="flex justify-end">
                <button wire:click="updateProject({{$editProject->id}})" class="border rounded-md py-1 px-2 hover:bg-blue-600">Update project</button>
            </div>
        </div>
    </div>

</div>
