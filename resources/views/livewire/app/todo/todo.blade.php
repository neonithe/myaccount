<div>

    <livewire:app.top.top-display :title="'Todo'"/>

    <div class="pb-12 pt-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-1 sm:p-6 text-gray-900 dark:text-gray-100">

                    <div x-data="{state: 'regular', more: false, add: false}" class="h-full overflow-y-auto bg-white dark:bg-gray-800 px-2">
                        <div class="space-y-1 pb-16">

                            {{-- Large Screens --}}
                            <div class="hidden sm:block">
                                @include('livewire.app.todo.include.add')
                            </div>
                            @include('livewire.app.todo.include.lg-menu')

                            {{-- Small Screens --}}
                            <div class="block sm:hidden">
                                {{-- Add + Menu --}}
                                <div x-data="{openAdd: false}" class="fixed inset-x-0 bottom-0 bg-gray-600 shadow-lg px-3 z-50 border-t border-b">
                                    <div class="pt-3 pb-2">
                                        @include('livewire.app.todo.include.sm-menu')
                                    </div>
                                    <div x-show="openAdd" class="">
                                        @include('livewire.app.todo.include.add')
                                    </div>
                                </div>
                            </div>

                            @include('livewire.app.todo.include.all-list')

                            @include('livewire.app.todo.include.done-list')

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
