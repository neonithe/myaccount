<div class="justify-between flex">
    <div class="relative justify-between flex grow">
        <div class="group relative">
            <button @click="state = 'todo'" wire:click="resetTodoList"
                    class="border p-1 rounded-md dark:bg-gray-700"
                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'todo'}">
                <x-app.icons.list-bullet class="w-4 h-4"/>
            </button>
            <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-gray-500 text-white text-xs rounded-md border text-center truncate" style="width: 18px; height: 18px;">
                                                        {{$allCount}}
                                                    </span>
        </div>
        <div class="group relative">
            <button @click="state = 'regular'" wire:click="showListByFilter('regular')" class="border p-1 rounded-md dark:bg-gray-700"
                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'regular'}">
                <x-app.icons.circle-check class="w-4 h-4"/>
            </button>
            <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-gray-500 text-white text-xs rounded-md border text-center truncate" style="width: 18px; height: 18px;">
                                                        {{$regularCount}}
                                                    </span>
        </div>
        <div class="group relative">
            <button @click="state = 'prio'" wire:click="showListByFilter('prio')" class="border p-1 rounded-md dark:bg-gray-700"
                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'prio'}">
                <x-app.icons.varning class="w-4 h-4"/>
            </button>
            <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-gray-500 text-white text-xs rounded-md border text-center truncate" style="width: 18px; height: 18px;">
                                                        {{$prioCount}}
                                                    </span>
        </div>
        <div class="group relative">
            <button @click="state = 'remind'" wire:click="showListByFilter('remind')" class="border p-1 rounded-md dark:bg-gray-700"
                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'remind'}">
                <x-app.icons.bell-2 class="w-4 h-4"/>
            </button>
            <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-gray-500 text-white text-xs rounded-md border text-center truncate" style="width: 18px; height: 18px;">
                                                        {{$remindCount}}
                                                    </span>
        </div>
        <div class="group relative">
            <button @click="state = 'paused'" wire:click="showListByFilter('paused')" class="border p-1 rounded-md dark:bg-gray-700"
                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'paused'}">
                <x-app.icons.circle-pause class="w-4 h-4"/>
            </button>
            <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-gray-500 text-white text-xs rounded-md border text-center truncate" style="width: 18px; height: 18px;">
                                                        {{$pausedCount}}
                                                    </span>
        </div>
        <div class="group relative">
            <button @click="state = 'contact'" wire:click="showListByFilter('contact')" class="border p-1 rounded-md dark:bg-gray-700"
                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'contact'}">
                <x-app.icons.mail class="w-4 h-4"/>
            </button>
            <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-gray-500 text-white text-xs rounded-md border text-center truncate" style="width: 18px; height: 18px;">
                                                        {{$pausedCount}}
                                                    </span>
        </div>
        <div class="group relative">
            <button @click="state = 'meeting'" wire:click="showListByFilter('meeting')" class="border p-1 rounded-md dark:bg-gray-700"
                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'meeting'}">
                <x-app.icons.meeting class="w-4 h-4"/>
            </button>
            <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-gray-500 text-white text-xs rounded-md border text-center truncate" style="width: 18px; height: 18px;">
                                                        {{$pausedCount}}
                                                    </span>
        </div>
        <div class="group relative">
            <button @click="state = 'done'" class="border p-1 rounded-md dark:bg-gray-700"
                    :class="{'bg-blue-100 dark:bg-blue-700': state === 'done'}">
                <x-app.icons.check class="w-4 h-4"/>
            </button>
            <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-gray-500 text-white text-xs rounded-md border text-center truncate" style="width: 18px; height: 18px;">
                                                        {{$doneCount}}
                                                    </span>
        </div>
    </div>
    <div class="pl-2 ml-3 border-l">
        <button x-show="!openAdd" @click="openAdd = true" class="border p-1 rounded-md dark:bg-green-700">
            <x-app.icons.circle-plus class="w-4 h-4"/>
        </button>
        <button x-show="openAdd" @click="openAdd = false" class="border p-1 rounded-md dark:bg-red-700">
            <x-app.icons.x class="w-4 h-4"/>
        </button>
    </div>
</div>
