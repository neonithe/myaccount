<div x-data="{ workout: 'getWorkouts' }" class="pb-24">

    <livewire:app.top.top-display :title="'Workout'"/>

    <div class="max-w-7xl mx-auto px-1 sm:px-6 lg:px-8 mb-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-2 pb-2 sm:p-6 text-gray-900 dark:text-gray-100">

                {{-- Large screens --}}
                <div class="hidden sm:block ">
                    <div class="flex justify-between mb-4">
                        <div class="uppercase tracking-widest text-lg">
                            <div x-show="workout === 'getWorkouts'">Workouts</div>
                            <div x-show="workout === 'handleWorkouts'">Edit/Create workouts</div>
                        </div>
                        <div>
                            <button @click="workout = 'getWorkouts'" class="text-sm border rounded-md px-2 py-1 uppercase tracking-widest">Workouts</button>
                            <button @click="workout = 'handleWorkouts'" class="text-sm border rounded-md px-2 py-1 uppercase tracking-widest">handle</button>
                        </div>
                    </div>
                </div>

                {{-- Small screens --}}
                <div class="block sm:hidden my-4">
                    <div class="flex gap-2">
                        <button @click="workout = 'getWorkouts'" class="w-full text-sm border rounded-md px-2 py-1 uppercase tracking-widest">Workouts</button>
                        <button @click="workout = 'handleWorkouts'" class="w-full text-sm border rounded-md px-2 py-1 uppercase tracking-widest">handle</button>
                    </div>
                    <div class="uppercase tracking-widest text-lg text-center mt-3">
                        <div x-show="workout === 'handleWorkouts'">Edit/Create workouts</div>
                    </div>
                </div>

                <div x-show="workout === 'handleWorkouts'">
                    @include('livewire.app.workout.include.edit.edit')
                </div>

                <div x-show="workout === 'getWorkouts'" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @include('livewire.app.workout.include.show.workouts')
                    @include('livewire.app.workout.include.show.exercises')
                </div>

            </div>
        </div>
    </div>

</div>
