<div x-data="{cycles: false}">
    <div class="hidden sm:block">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-2 pt-3">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-xl font-bold leading-7 text-white sm:truncate sm:text-2xl sm:tracking-tight">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="flex gap-2">
                            <div>
                                @if ($settings->private) Private: @else Work: @endif
                            </div>
                            <div>
                                {{ $user->name }}
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="mt-2">
                            {{$dayName}} {{$dayDate}} {{$month}}
                        </div>
                        <div class="flex gap-3 -mt-1">
                            <button @click="cycles = !cycles" class="hover:underline">Cycle: {{$this->getCurrentCycle()['Cykel nr'] ?? 'N/A'}}</button>
                            <button @click="cycles = !cycles" class="hover:underline">Week Nr: {{ $week }}</button>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <div class="text-xs flex gap-2 -mt-1.5">
                            <div>Start: <b>{{$this->getCurrentCycle()['Cykel Start'] ?? 'N/A'}}</b></div>
                            <div>End: <b>{{$this->getCurrentCycle()['Cykel Slut'] ?? 'N/A'}}</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="block sm:hidden">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-1 pt-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-2 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-xl font-bold leading-7 text-white sm:truncate sm:text-2xl sm:tracking-tight">
                                {{$title}}
                            </h2>
                        </div>
                        <div class="mt-0.5">
                            {{$dayName}} {{$dayDate}} {{$month}} | Week:{{ $week }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden sm:block">
        {{-- SLIDER - Show TODOs from list --}}
        <x-app.modal.slider data="cycles" close="cycles = false" >
            <x-slot name="title">
                cycles
            </x-slot>
            <x-slot name="body">
                <div class=" text-gray-900 dark:text-gray-100">

                    <div class="grid grid-cols-3 pb-2 border-b mb-1 px-2">
                        <div>Start date</div>
                        <div>End date</div>
                        <div>Cycle NR</div>
                    </div>
                    @foreach ($this->generateCycleList() as $key => $cycle)
                        <div class="grid grid-cols-3 py-2 rounded-md px-2 @if ($this->getCurrentCycle()['Cykel nr'] == $cycle['Cykel nr']) bg-gray-700 @else hover:bg-gray-700 @endif">
                            <div>{{ $cycle['Startdatum'] }}</div>
                            <div>{{ $cycle['Slutdatum'] }}</div>
                            <div>{{ $cycle['Cykel nr'] }}</div>
                        </div>
                    @endforeach
                </div>
            </x-slot>
        </x-app.modal.slider>
    </div>

</div>
