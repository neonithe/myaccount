<div x-data="{more: false}" class="justify-between flex">
    <div class="relative justify-between flex grow">

        <div x-show="!more" class="relative justify-between flex grow">


            <div class="group relative">
                <button x-show="state !== 'regular'" @click="state = 'regular'" wire:click="showListByFilter('regular')" class="border p-1 rounded-md dark:bg-gray-700">
                    <x-app.icons.circle-check class="w-7 h-7"/>
                </button>
                <button x-show="state === 'regular'" class="border p-1 rounded-md dark:bg-blue-600">
                    <x-app.icons.circle-check class="w-7 h-7"/>
                </button>
            </div>
            <div class="group relative">
                <button x-show="state !== 'prio'" @click="state = 'prio'" wire:click="showListByFilter('prio')" class="border p-1 rounded-md dark:bg-gray-700">
                    <x-app.icons.varning class="w-7 h-7"/>
                </button>
                <button x-show="state === 'prio'" class="border p-1 rounded-md dark:bg-blue-600">
                    <x-app.icons.varning class="w-7 h-7"/>
                </button>
            </div>
            <div class="group relative">
                <button x-show="state !== 'remind'" @click="state = 'remind'" wire:click="showListByFilter('remind')" class="border p-1 rounded-md dark:bg-gray-700">
                    <x-app.icons.bell-2 class="w-7 h-7"/>
                </button>
                <button x-show="state === 'remind'" class="border p-1 rounded-md dark:bg-blue-600">
                    <x-app.icons.bell-2 class="w-7 h-7"/>
                </button>
            </div>
            <div class="group relative">
                <button x-show="state !== 'meeting'" @click="state = 'meeting'" wire:click="showListByFilter('meeting')" class="border p-1 rounded-md dark:bg-gray-700">
                    <x-app.icons.meeting class="w-7 h-7"/>
                </button>
                <button x-show="state === 'meeting'" class="border p-1 rounded-md dark:bg-blue-600">
                    <x-app.icons.meeting class="w-7 h-7"/>
                </button>
            </div>
            <div class="group relative">
                <button x-show="state !== 'contact'" @click="state = 'contact'" wire:click="showListByFilter('contact')" class="border p-1 rounded-md dark:bg-gray-700">
                    <x-app.icons.mail class="w-7 h-7"/>
                </button>
                <button x-show="state === 'contact'" class="border p-1 rounded-md dark:bg-blue-600">
                    <x-app.icons.mail class="w-7 h-7"/>
                </button>
            </div>
        </div>

        <div x-show="more" class="relative justify-end gap-2 flex grow">
            <div class="group relative">
                <button x-show="state !== 'paused'" @click="state = 'paused'" wire:click="showListByFilter('paused')" class="border p-1 rounded-md dark:bg-gray-700">
                    <x-app.icons.circle-pause class="w-7 h-7"/>
                </button>
                <button x-show="state === 'paused'" class="border p-1 rounded-md dark:bg-blue-600">
                    <x-app.icons.circle-pause class="w-7 h-7"/>
                </button>
            </div>

            <div class="group relative">
                <button x-show="state !== 'todo'" @click="state = 'todo'" wire:click="resetTodoList" class="border p-1 rounded-md dark:bg-gray-700">
                    <x-app.icons.list-bullet class="w-7 h-7"/>
                </button>
                <button x-show="state === 'todo'" class="border p-1 rounded-md dark:bg-blue-600">
                    <x-app.icons.list-bullet class="w-7 h-7"/>
                </button>
            </div>

            <div class="group relative">
                <button x-show="state !== 'done'" @click="state = 'done'" wire:click="showListByFilter('done')" class="border p-1 rounded-md dark:bg-gray-700">
                    <x-app.icons.check class="w-7 h-7"/>
                </button>
                <button x-show="state === 'done'" class="border p-1 rounded-md dark:bg-blue-600">
                    <x-app.icons.check class="w-7 h-7"/>
                </button>
            </div>
        </div>
    </div>
    <div class="pl-2 ml-3 border-l flex gap-2">
        <div class="group relative">
            <button x-show="!more" @click="more = !more" class="border p-1 rounded-md dark:bg-blue-600">
                <x-app.icons.circle-arrow-down class="w-7 h-7"/>
            </button>
            <button x-show="more" @click="more = !more" class="border p-1 rounded-md dark:bg-blue-600">
                <x-app.icons.circle-arrow-up class="w-7 h-7"/>
            </button>
        </div>
        <div>
            <button x-show="!openAdd" @click="openAdd = true" class="border p-1 rounded-md dark:bg-green-700">
                <x-app.icons.circle-plus class="w-7 h-7"/>
            </button>
            <button x-show="openAdd" @click="openAdd = false" class="border p-1 rounded-md dark:bg-red-700">
                <x-app.icons.x class="w-7 h-7"/>
            </button>
        </div>
    </div>
</div>


<!--
<span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-gray-500 text-white text-xs rounded-md border text-center truncate" style="width: 18px; height: 18px;">
      $allCount $regularCount $prioCount $remindCount $pausedCount $pausedCount $pausedCount $doneCount
</span>

-->
