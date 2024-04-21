<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2 pt-3">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-6 py-4 text-gray-900 dark:text-gray-100">
                <div class="flex justify-between">
                    <div>
                        <h2 class="text-xl font-bold leading-7 text-white sm:truncate sm:text-2xl sm:tracking-tight">
                            {{$title}}
                        </h2>
                    </div>
                    <div>
                        {{ $user->name }}
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="mt-2">
                        {{$dayName}} {{$dayDate}} {{$month}}
                    </div>
                    <div>
                        Week Nr: {{ $week }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
