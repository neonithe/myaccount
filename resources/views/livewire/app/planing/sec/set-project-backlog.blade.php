<div x-data="{add: false, edit: @entangle('editSlider')}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div>
                    <div class="flex justify-between pb-4">
                        <div class="text-xl tracking-widest uppercase">
                            Backlog
                        </div>
                        <div class="flex gap-2 -mt-2">
                            <div>
                                <select wire:model.live="filterQ" class="bg-gray-800 border  rounded-md py-1">
                                    <option value="">Quarter</option>
                                    <option value="5">Not set</option>
                                    <option value="1">Q1</option>
                                    <option value="2">Q2</option>
                                    <option value="3">Q3</option>
                                    <option value="4">Q4</option>
                                </select>
                            </div>
                            <div>
                                <button @click="add = !add" class="border rounded-md py-1 px-2 border-gray-500 hover:bg-blue-500">Add project</button>
                            </div>
                            <button wire:click="reorder">REORDER</button>
                        </div>
                    </div>

                    <div>
                        <div class="grid grid-cols-8 border-b mb-3 text-lg gap-2">
                            <div>Prio</div>
                            <div class="col-span-3">Name</div>
                            <div class="col-span-2">Comment</div>
                            <div class="col-span-1">Size/Quarter</div>
                            <div class="col-span-1 text-end">Actions</div>
                        </div>
                        @foreach ($backlog as $project)
                            <div class="grid grid-cols-8 gap-2 hover:bg-gray-700 mb-2">
                                <div class="flex gap-2">

                                    <div class="flex justify-center grow">
                                        <div
                                            x-data="{
                                                        open: false,
                                                        toggle() {
                                                            if (this.open) {
                                                                return this.close()
                                                            }

                                                            this.$refs.button.focus()

                                                            this.open = true
                                                        },
                                                        close(focusAfter) {
                                                            if (! this.open) return

                                                            this.open = false

                                                            focusAfter && focusAfter.focus()
                                                        }
                                                    }"
                                            x-on:keydown.escape.prevent.stop="close($refs.button)"
                                            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                            x-id="['dropdown-button']"
                                            class="relative grow"
                                        >
                                            <!-- Button -->
                                            <button
                                                x-ref="button"
                                                x-on:click="toggle()"
                                                :aria-expanded="open"
                                                :aria-controls="$id('dropdown-button')"
                                                type="button"
                                                class="w-full hover:bg-blue-600 py-0.5"
                                            >
                                                {{$project->prio}}
                                            </button>

                                            <!-- Panel -->
                                            <div
                                                x-ref="panel"
                                                x-show="open"
                                                x-transition.origin.top.left
                                                x-on:click.outside="close($refs.button)"
                                                :id="$id('dropdown-button')"
                                                style="display: none;"
                                                class="absolute left-0 mt-2 w-20 rounded-md bg-gray-700 shadow-md z-50"
                                            >
                                                <button wire:click="setPrio({{$project->id}}, 1)" @click="open = false" class="hover:bg-gray-600 w-full py-2">1</button>
                                                <button wire:click="setPrio({{$project->id}}, 2)" @click="open = false" class="hover:bg-gray-600 w-full py-2">2</button>
                                                <button wire:click="setPrio({{$project->id}}, 3)" @click="open = false" class="hover:bg-gray-600 w-full py-2">3</button>
                                                <button wire:click="setPrio({{$project->id}}, 4)" @click="open = false" class="hover:bg-gray-600 w-full py-2">4</button>
                                                <button wire:click="setPrio({{$project->id}}, 5)" @click="open = false" class="hover:bg-gray-600 w-full py-2">5</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:click="openEdit({{$project->id}})" class="col-span-3 truncate mt-0.5 cursor-pointer">
                                    {{$project->name}}
                                </div>
                                <div wire:click="openEdit({{$project->id}})" class="col-span-2 truncate mt-0.5 cursor-pointer">
                                    {{$project->comment}}
                                </div>
                                <div class="flex gap-2">
                                    <div>
                                        <div class="border rounded-md p-0.5 text-sm px-2">
                                            S
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border rounded-md p-0.5 text-sm ">
                                            Q2
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-1 justify-end">
                                    @if ($project->link)
                                        <div>
                                            <a href="{{$project->link}}" target="_blank">
                                                <button class="border rounded-md p-0.5 border-gray-500 bg-blue-600 hover:bg-blue-500"><x-app.icons.link class="h-5 w-5" /></button>
                                            </a>
                                        </div>
                                    @endif
                                    <div x-tooltip="Add to active projects">
                                        <button wire:click="addToActive({{$project->id}})" class="border rounded-md p-0.5 border-gray-500 bg-green-600 hover:bg-green-500"><x-app.icons.check class="h-5 w-5" /></button>
                                    </div>
                                    <div x-tooltip="Delete project">
                                        <button wire:click="delete({{$project->id}})" class="border rounded-md p-0.5 border-gray-500 bg-red-600 hover:bg-red-500"><x-app.icons.trash class="h-5 w-5" /></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @foreach ($backlog as $project)
                        <div x-data="{comment: false, link: false}" class="flex gap-2 pb-2">
                            <div class="flex gap-2 grow">
                                <div class="flex gap-1 mt-6">
                                    <div class="flex gap-1">
                                        <button wire:click="setPrio({{$project->id}}, 1)" class="border rounded-md py-0.5 px-1 @if ($project->prio == 1) bg-blue-600 @endif">1</button>
                                        <button wire:click="setPrio({{$project->id}}, 2)" class="border rounded-md py-0.5 px-1 @if ($project->prio == 2) bg-blue-600 @endif">2</button>
                                        <button wire:click="setPrio({{$project->id}}, 3)" class="border rounded-md py-0.5 px-1 @if ($project->prio == 3) bg-blue-600 @endif">3</button>
                                        <button wire:click="setPrio({{$project->id}}, 4)" class="border rounded-md py-0.5 px-1 @if ($project->prio == 4) bg-blue-600 @endif">4</button>
                                        <button wire:click="setPrio({{$project->id}}, 5)" class="border rounded-md py-0.5 px-1 @if ($project->prio == 5) bg-blue-600 @endif">5</button>
                                    </div>
                                </div>
                                <div class="w-1/2">
                                    <label class="text-sm">Name</label>
                                    <div>
                                        <input wire:keydown.enter="changeProject({{$project->id}}, 'name', $event.target.value)" value="{{$project->name}}" type="text" class="bg-gray-600 rounded-md py-1 px-2 border w-full">
                                    </div>
                                </div>
                                <div x-show="!link" class="w-1/2">
                                    <label @click="comment = !comment" class="text-sm hover:underline cursor-pointer">Comment</label>
                                    <div x-show="!comment" class="border rounded-md p-1 px-2 border-gray-500 truncate">
                                        @if ($project->comment) {{$project->comment}} @else <span class="text-gray-500">No comment</span> @endif
                                    </div>
                                    <div x-show="comment">
                                        <textarea wire:keydown.enter="changeProject({{$project->id}}, 'comment', $event.target.value)" rows="3" class="border rounded-md p-1 px-2 border-gray-500 bg-gray-600 w-full">{{$project->comment}}</textarea>
                                    </div>
                                </div>
                                <div x-show="link" class="w-1/2">
                                    <label class="text-sm">Link</label>
                                    <div>
                                        <input wire:keydown.enter="changeProject({{$project->id}}, 'link', $event.target.value)" value="{{$project->link}}" type="text" class="bg-gray-600 rounded-md py-1 px-2 border w-full">
                                    </div>
                                </div>
                            </div>
                            @if ($project->link)
                                <div>
                                    <label @click="link = !link" class="text-sm hover:underline cursor-pointer">Link</label>
                                    <div x-tooltip="{{$project->link}}">
                                        <a href="{{$project->link}}" target="_blank">
                                            <button class="border rounded-md p-1.5 bg-blue-500 border-gray-500"><x-app.icons.link class="h-5 w-5" /></button>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <label class="text-sm">Link</label>
                                    <div x-tooltip="No link">
                                        <button @click="link = !link" class="border rounded-md p-1.5 text-gray-500 border-gray-500"><x-app.icons.link class="h-5 w-5" /></button>
                                    </div>
                                </div>
                            @endif
                            <div>
                                <label class="text-sm">Size</label>
                                <div>
                                    <select wire:change="changeProject({{$project->id}}, 'size', $event.target.value)" class="bg-gray-600 rounded-md py-1 border">
                                        <option value="2" @if ($project->size == 2) selected @endif>XS</option>
                                        <option value="5" @if ($project->size == 5) selected @endif>S</option>
                                        <option value="10" @if ($project->size == 10) selected @endif>M</option>
                                        <option value="20" @if ($project->size == 20) selected @endif>L</option>
                                        <option value="30" @if ($project->size == 30) selected @endif>XL</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm">Frontend %</label>
                                <div>
                                    <input wire:keydown.enter="changeProject({{$project->id}}, 'fe_perc', $event.target.value)" value="{{number_format($project->fe_perc, 0, ',', ' ')}}" type="text" class="text-center bg-gray-600 rounded-md py-1 px-2 border w-20">
                                </div>
                            </div>
                            <div>
                                <label class="text-sm">Backend %</label>
                                <div>
                                    <input wire:keydown.enter="changeProject({{$project->id}}, 'be_perc', $event.target.value)" value="{{number_format($project->be_perc, 0, ',', ' ')}}" type="text" class="text-center bg-gray-600 rounded-md py-1 px-2 border w-20">
                                </div>
                            </div>
                            <div>
                                <label class="text-sm">Quarter</label>
                                <div>
                                    <select wire:change="changeProject({{$project->id}}, 'quarter', $event.target.value)" class="bg-gray-600 rounded-md py-1 border">
                                        <option value="5" @if ($project->quarter == 0) selected @endif>Not set</option>
                                        <option value="1" @if ($project->quarter == 1) selected @endif>Q1</option>
                                        <option value="2" @if ($project->quarter == 2) selected @endif>Q2</option>
                                        <option value="3" @if ($project->quarter == 3) selected @endif>Q3</option>
                                        <option value="4" @if ($project->quarter == 4) selected @endif>Q4</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm">Prio</label>
                                <div>
                                    <select wire:change="changeProject({{$project->id}}, 'prio', $event.target.value)" class="bg-gray-600 rounded-md py-1 border">
                                        <option value="5" @if ($project->prio == 5) selected @endif>5</option>
                                        <option value="4" @if ($project->prio == 4) selected @endif>4</option>
                                        <option value="3" @if ($project->prio == 3) selected @endif>3</option>
                                        <option value="2" @if ($project->prio == 2) selected @endif>2</option>
                                        <option value="1" @if ($project->prio == 1) selected @endif>1</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm">Actions</label>
                                <div class="flex gap-1">
                                    <div x-tooltip="Add to active projects">
                                        <button wire:click="addToActive({{$project->id}})" class="border rounded-md p-1.5 border-gray-500 bg-green-600 hover:bg-green-500"><x-app.icons.check class="h-5 w-5" /></button>
                                    </div>
                                    <div x-tooltip="Delete project">
                                        <button wire:click="delete({{$project->id}})" class="border rounded-md p-1.5 border-gray-500 bg-red-600 hover:bg-red-500"><x-app.icons.trash class="h-5 w-5" /></button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    {{-- Add project --}}
    <x-app.modal.slider data="add" close="add = false">
        <x-slot name="title">
            Add project
        </x-slot>
        <x-slot name="body">
            @include('livewire.app.planing.sec.project.add-backlog')
        </x-slot>
    </x-app.modal.slider>

    @if ($editProject)
        {{-- Edit project --}}
        <x-app.modal.slider data="edit" close="edit = false">
            <x-slot name="title">
                {{$editProject->name}}
            </x-slot>
            <x-slot name="body">
                @include('livewire.app.planing.sec.project.edit-backlog')
            </x-slot>
        </x-app.modal.slider>
    @endif


</div>
