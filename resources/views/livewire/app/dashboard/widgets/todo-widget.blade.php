<div x-data="{
            sliderListAddTodo: @entangle('sliderListAddTodo'),
            sliderShow: @entangle('sliderShow'),
            showModal: @entangle('showModal'),
            }">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-1">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">

                        @if ($settings->private)
                            @if ($this->getTodos('todo')->where('private', true)->count())
                                @include('livewire.app.dashboard.widgets.sections.todo')
                            @endif
                            @if ($this->getTodos('notice')->where('private', true)->count())
                                @include('livewire.app.dashboard.widgets.sections.prio')
                            @endif
                            @if ($this->getTodos('contact')->where('private', true)->count())
                                @include('livewire.app.dashboard.widgets.sections.contact')
                            @endif
                            @if ($this->getTodos('meeting')->where('private', true)->count())
                                @include('livewire.app.dashboard.widgets.sections.meeting')
                            @endif
                            @if ($this->getTodoReminders()->where('private', true)->count())
                                @include('livewire.app.dashboard.widgets.sections.reminder')
                            @endif
                            @if ($this->getTodoRepeat()->where('private', true)->count())
                                @include('livewire.app.dashboard.widgets.sections.repeat')
                            @endif
                            @if ($this->getTodos('paused')->where('private', true)->count())
                                @include('livewire.app.dashboard.widgets.sections.pause')
                            @endif
                            {{-- Extra - workout, eco --}}
                            @include('livewire.app.dashboard.widgets.sections.workout')
                            @include('livewire.app.dashboard.widgets.sections.eco')

                        @else

                            @if ($this->getTodos('todo')->where('private', false)->count())
                                @include('livewire.app.dashboard.widgets.sections.todo')
                            @endif
                            @if ($this->getTodos('notice')->where('private', false)->count())
                                @include('livewire.app.dashboard.widgets.sections.prio')
                            @endif
                            @if ($this->getTodos('contact')->where('private', false)->count())
                                @include('livewire.app.dashboard.widgets.sections.contact')
                            @endif
                            @if ($this->getTodos('meeting')->where('private', false)->count())
                                @include('livewire.app.dashboard.widgets.sections.meeting')
                            @endif
                            @if ($this->getTodoReminders()->where('private', false)->count())
                                @include('livewire.app.dashboard.widgets.sections.reminder')
                            @endif
                            @if ($this->getTodoRepeat()->where('private', false)->count())
                                @include('livewire.app.dashboard.widgets.sections.repeat')
                            @endif
                            @if ($this->getTodos('paused')->where('private', false)->count())
                                @include('livewire.app.dashboard.widgets.sections.pause')
                            @endif
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- SLIDER - Show TODOs from list --}}
    <x-app.modal.slider data="sliderShow" close="sliderShow = false">
        <x-slot name="title">
            todo
        </x-slot>
        <x-slot name="body">
            @include('livewire.app.dashboard.widgets.todo.list-edit')
        </x-slot>
    </x-app.modal.slider>

    {{-- SLIDER - Add, List, Edit TODOs --}}
    <x-app.modal.slider data="sliderListAddTodo" close="sliderListAddTodo = false">
        <x-slot name="title">
            todo
        </x-slot>
        <x-slot name="body">

            <div x-data="{add: true, list: false, doneTodo: false}" class="hidden sm:block">
                <div class="-mt-4 text-white flex justify-end gap-2 pr-1 mt-0.5">
                    <div>
                        <button wire:click="showList" @click="add = true, list = false, doneTodo = false"
                                class="text-sm uppercase tracking-widest border-t border-r border-l pt-0.5 pb-0.5 px-2 rounded-t-md border-gray-500 hover:bg-gray-700 bg-gray-700">
                            Add todo
                        </button>
                    </div>
                    <div>
                        <button wire:click="showList" @click="add = false, list = true, doneTodo = false"
                                class="text-sm uppercase tracking-widest border-t border-r border-l pt-0.5 pb-0.5 px-2 rounded-t-md border-gray-500 hover:bg-gray-600">
                            All todos
                        </button>
                    </div>
                    <div>
                        <button wire:click="showDone" @click="add = false, list = true, doneTodo = true"
                                class="text-sm uppercase tracking-widest border-t border-r border-l pt-0.5 pb-0.5 px-2 rounded-t-md border-gray-500 hover:bg-gray-600">
                            Done
                        </button>
                    </div>
                </div>

                <div x-show="add">
                    @include('livewire.app.dashboard.widgets.todo.add')
                </div>

                <div x-show="list">
                    @include('livewire.app.dashboard.widgets.todo.list')
                </div>
            </div>

            <div x-data="{list: true, doneTodo: false}">

                <div x-show="list" class="sm:hidden">
                    @include('livewire.app.dashboard.widgets.todo.sm-list')
                </div>

                @include('livewire.app.dashboard.widgets.todo.sm-add')
            </div>

        </x-slot>
    </x-app.modal.slider>


</div>


