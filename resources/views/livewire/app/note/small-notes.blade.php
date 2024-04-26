<div x-data="{showNow: 'note'}" class="pt-2 pb-24">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="pl-2 pr-4 pb-6 sm:p-6 text-gray-900 dark:text-gray-100">

                <div class="hidden sm:block">
                    <div class="flex justify-between">
                        <div class="text-lg uppercase tracking-widest">Notes</div>
                        <div class="flex justify-end gap-2">
                            <button @click="showNow = 'note'" class="border rounded-md py-1 px-2 text-xs sm:text-sm hover:bg-gray-600">Note</button>
                            <button @click="showNow = 'list'" class="border rounded-md py-1 px-2 text-xs sm:text-sm hover:bg-gray-600">List</button>
                        </div>
                    </div>
                </div>

                <div x-show="showNow === 'note'" class="mt-4">
                    <div>
                        <div>
                            @if ($showNote)
                                <div class="flex gap-2 pb-2">
                                    <div class="grow">
                                        <input wire:keydown.enter="changeNote({{$showNote->id}}, 'name', $event.target.value)" type="text" value="{{$showNote->name}}" class="bg-gray-800 border border-gray-600 rounded-md w-full" placeholder="Name on note">
                                    </div>
                                    <div>
                                        <select wire:change="setSelected($event.target.value)" class="bg-gray-800 border border-gray-600 rounded-md">
                                            <option value="">Select note</option>
                                            @foreach ($notes as $item)
                                                <option value="{{$item->id}}" @if ($showNote->id == $item->id) selected @endif>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <button @click="showNow = 'add'" class="border rounded-md py-1.5 px-1.5"><x-app.icons.circle-plus class="w-7 h-7"/></button>
                                    </div>
                                </div>
                                <div>
                                    <textarea wire:keydown.enter="changeNote({{$showNote->id}}, 'note', $event.target.value)" rows="15" class="bg-gray-800 border border-gray-600 rounded-md w-full">{{$showNote->note}}</textarea>
                                </div>
                            @else
                                <div>
                                    <div class="flex gap-2 pb-2">
                                        <div class="grow">
                                            <input wire:model="name" type="text" class="bg-gray-800 border border-gray-600 rounded-md w-full" placeholder="Name on note">
                                        </div>
                                        <div>
                                            {{$firstpage}}
                                            <button wire:click="toggleFirstpage" class="border rounded-md py-1.5 px-1.5"><x-app.icons.check class="w-7 h-7"/></button>
                                        </div>
                                    </div>
                                    <div>
                                        <textarea wire:model="note" rows="15" class="bg-gray-800 border border-gray-600 rounded-md w-full"></textarea>
                                    </div>
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button wire:click="saveNote" @click="showNow = 'note'" class="border rounded-md py-1.5 px-1.5 uppercase">Save</button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div x-show="showNow === 'add'"  class="mt-4">
                    <div>
                        <div class="flex gap-2 pb-2">
                            <div class="grow">
                                <input wire:model="name" type="text" class="bg-gray-800 border border-gray-600 rounded-md w-full" placeholder="Name on note">
                            </div>
                            <div>
                                {{$firstpage}}
                                <button wire:click="toggleFirstpage" class="border rounded-md py-1.5 px-1.5"><x-app.icons.check class="w-7 h-7"/></button>
                            </div>
                        </div>
                        <div>
                            <textarea wire:model="note" rows="15" class="bg-gray-800 border border-gray-600 rounded-md w-full"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button @click="showNow = 'note'" class="border rounded-md py-1.5 px-1.5 uppercase">Close</button>
                        <button wire:click="saveNote"  @click="showNow = 'note'" class="border rounded-md py-1.5 px-1.5 uppercase">Save</button>
                    </div>
                </div>

                <div x-show="showNow === 'list'" class="mt-6">
                    <div class="border-b pb-2 mb-2">
                        All notes
                    </div>
                    @foreach ($notes as $note)
                        <div class="flex justify-between py-1 border-b border-gray-600">
                            <div>{{$note->name}}</div>
                            <div class="gap-2">
                                @if (!$note->firstpage)
                                    <button wire:click="setSelected({{$note->id}})" class="hover:underline">Set as selected</button>
                                @endif
                                <button wire:click="deleteNote({{$note->id}})" class="hover:underline">Delete</button>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

</div>
