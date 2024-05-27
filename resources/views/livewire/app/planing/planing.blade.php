<div x-data="{

            addProject: false,
            settings: false,
            addCycle: false,
            employees: false,
            activeProjects: false,
            backlogProjects: true,
            }" class="pb-24">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="flex justify-between">
                    <div>
                        <div class="font-bold">{{$dayName}} {{$dayDate}} {{$month}}</div>
                        <div class="flex gap-2 mt-1">
                            <div class="mt-0.5">
                                <div class="py-2.5 px-3 text-3xl border rounded-md border-gray-500 bg-blue-500 ">
                                    {{ $currentQuarter }}
                                </div>
                            </div>
                            <div class="mt-0.5">
                                <div class="flex gap-2 mb-1.5">
                                    <div class="rounded-md  border-gray-500 px-3">Cycle: {{$this->getCurrentCycle()['Cykel nr'] ?? 'N/A'}}</div>
                                    <div class="rounded-md  border-gray-500 px-3">Week: {{ $week }}</div>
                                </div>
                                <div class="flex gap-4  rounded-md border-gray-500 px-3">
                                    <div><span class="font-bold">Start:</span> {{$this->getCurrentCycle()['Cykel Start'] ?? 'N/A'}} <span class="font-bold">End:</span> {{$this->getCurrentCycle()['Cykel Slut'] ?? 'N/A'}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 gap-2 pt-1">
                        <div class="flex gap-2">
                            <button @click="employees = !employees" class="text-sm border rounded-md py-1 px-2 uppercase tracking-widest hover:bg-blue-600">Employees</button>
                            <button @click="addCycle = !addCycle" class="text-sm border rounded-md py-1 px-2 uppercase tracking-widest hover:bg-blue-600">Cycle</button>
                            <button @click="settings = !settings" class="text-sm border rounded-md py-1 px-2 uppercase tracking-widest hover:bg-blue-600"><x-app.icons.gear-1 class="h-5 w-5"/></button>
                        </div>
                        <div class="mt-2">
                            <div class="flex gap-2 grow">
                                <button @click="activeProjects = !activeProjects" class="w-full text-sm border rounded-md py-1 px-2 uppercase tracking-widest hover:bg-blue-600">
                                    Active
                                </button>
                                <button @click="backlogProjects = !backlogProjects" class="w-full text-sm border rounded-md py-1 px-2 uppercase tracking-widest hover:bg-blue-600">
                                    Backlog
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div x-show="activeProjects">
        <livewire:app.planing.sec.set-project/>
    </div>
    <div x-show="backlogProjects">
        <livewire:app.planing.sec.set-project-backlog/>
    </div>





    {{-- Employees --}}
    <x-app.modal.slider data="employees" close="employees = false">
        <x-slot name="title">
            employees
        </x-slot>
        <x-slot name="body">
            <livewire:app.planing.sec.set-employees/>
        </x-slot>
    </x-app.modal.slider>

    {{-- Add Project --}}
    <x-app.modal.slider data="addProject" close="addProject = false">
        <x-slot name="title">
            Add Project
        </x-slot>
        <x-slot name="body">
            <livewire:app.planing.sec.add-project/>
        </x-slot>
    </x-app.modal.slider>

    {{-- Edit Settings --}}
    <x-app.modal.slider data="settings" close="settings = false">
        <x-slot name="title">
            Planing settings
        </x-slot>
        <x-slot name="body">
            <livewire:app.planing.sec.set-settings/>
        </x-slot>
    </x-app.modal.slider>

    {{-- Add cycle --}}
    <x-app.modal.slider data="addCycle" close="addCycle = false">
        <x-slot name="title">
            Cycles
        </x-slot>
        <x-slot name="body">
            <livewire:app.planing.sec.add-cycle/>
        </x-slot>
    </x-app.modal.slider>

</div>
