<div x-data="{
            buttonSettings: false,
            adminSettings: false,
            notes: false,
            todoPrivate: false,
            prioPrivate: false,
            private: @entangle('private'),
            }" class="pb-24">
    <livewire:app.top.top-display :title="'Dashboard'"/>

    @include('livewire.app.dashboard.include.note')

    <livewire:app.dashboard.widgets.settings-widget />

    <livewire:app.dashboard.widgets.todo-widget />

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-1">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="flex justify-between pb-1">
                    <div>
                        <span x-show="private">PRIVATE TRUE</span>
                        <span x-show="!private">PRIVATE FALSE</span>
                    </div>
                    <button wire:click="changePrivate" class="uppercase tracking-widest">
                        <span x-show="!private" x-cloak>Change to Private</span>
                        <span x-show="private" x-cloak>Change to Regular</span>
                    </button>
                </div>

                <div x-show="private" x-cloak>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-4">
                        @include('livewire.app.dashboard.include-sec.todo')
                        @include('livewire.app.dashboard.include-sec.prio')
                        @include('livewire.app.dashboard.include-sec.reminders')
                        @include('livewire.app.dashboard.include-sec.meeting')
                        @include('livewire.app.dashboard.include-sec.contact')
                        @include('livewire.app.dashboard.include-sec.paused')
                        @include('livewire.app.dashboard.include-sec.eco')
                        @if ($private)
                            @include('livewire.app.dashboard.include-sec.workout')
                        @endif
                    </div>
                </div>

                <div x-show="!private" x-cloak>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-4">
                        @include('livewire.app.dashboard.include-sec.todo')
                        @include('livewire.app.dashboard.include-sec.prio')
                        @include('livewire.app.dashboard.include-sec.reminders')
                        @include('livewire.app.dashboard.include-sec.meeting')
                        @include('livewire.app.dashboard.include-sec.contact')
                        @include('livewire.app.dashboard.include-sec.eco')
                        @include('livewire.app.dashboard.include-sec.paused')
                        @include('livewire.app.dashboard.include-sec.links')
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{--
    <x-app.other.loading event="openEdit" />
    --}}

</div>
