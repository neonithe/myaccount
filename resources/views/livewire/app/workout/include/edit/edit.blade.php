<div x-data="{woAddAl: false, exAddAl: false, showWo: false, showEx: false}"
     class="grid grid-cols-1 sm:grid-cols-3 sm:gap-3 mb-4">

    {{-- Workout --}}
    <div>
        <div class="uppercase tracking-widest border-b border-gray-600 mb-2 flex justify-between">
            <div>
                <div class="block sm:hidden">
                    <button @click="showWo = !showWo" class="uppercase tracking-widest inline-flex">
                        workouts
                        <div x-show="!showWo" class="mt-1 pl-2">
                            <x-app.icons.arrow-down class="h-4 w-4"/>
                        </div>
                        <div x-show="showWo" class="mt-1 pl-2">
                            <x-app.icons.arrow-up class="h-4 w-4"/>
                        </div>
                    </button>
                </div>
                <div class="hidden sm:block">
                    Workouts
                </div>
            </div>
            <div>
                <button @click="woAddAl = !woAddAl"
                        class="uppercase tracking-widest text-green-400 border border-gray-800 hover:border-gray-700 hover:bg-gray-700 hover:text-green-500 rounded-md px-2">
                    add
                </button>
            </div>
        </div>

        <div class="hidden sm:block">
            @include('livewire.app.workout.include.edit.workout')
        </div>

        <div x-show="showWo" class="block sm:hidden">
            @include('livewire.app.workout.include.edit.workout')
        </div>

    </div>

    {{-- Exrecises --}}
    <div class="col-span-2 pt-4 sm:pt-0">
        <div class="uppercase tracking-widest border-b border-gray-600 mb-2 flex justify-between">
            <div>
                <div class="block sm:hidden">
                    <button @click="showEx = !showEx" class="uppercase tracking-widest inline-flex">
                        Exercises
                        <div x-show="!showEx" class="mt-1 pl-2">
                            <x-app.icons.arrow-down class="h-4 w-4"/>
                        </div>
                        <div x-show="showEx" class="mt-1 pl-2">
                            <x-app.icons.arrow-up class="h-4 w-4"/>
                        </div>
                    </button>
                </div>
                <div class="hidden sm:block">
                    Exercises
                </div>
            </div>
            <div>
                <button @click="exAddAl = !exAddAl"
                        class="uppercase tracking-widest text-green-400 border border-gray-800 hover:border-gray-700 hover:bg-gray-700 hover:text-green-500 rounded-md px-2">
                    add
                </button>
            </div>
        </div>

        <div class="hidden sm:block">
            @include('livewire.app.workout.include.edit.exercise')
        </div>

        <div x-show="showEx" class="block sm:hidden">
            @include('livewire.app.workout.include.edit.exercise')
        </div>

    </div>
</div>
