<div class="hidden sm:block">
    <div class="flex justify-between pt-3 pb-1">
        <button @click="state = 'todo'" wire:click="resetTodoList"
                :class="{'bg-blue-100 dark:bg-blue-700': state === 'todo', 'hover:bg-blue-50 hover:dark:bg-blue-800': state !== 'todo'}"
                class="tracking-widest uppercase text-xs border border-blue-200 rounded-l-md border-r-0 py-1.5 text-center w-full">
            All ({{$allCount}})
        </button>
        <button @click="state = 'regular'" wire:click="showListByFilter('regular')"
                :class="{'bg-blue-100 dark:bg-blue-700': state === 'regular', 'hover:bg-blue-50 hover:dark:bg-blue-800': state !== 'regular'}"
                class="tracking-widest uppercase text-xs border border-blue-200 py-1.5 text-center w-full">
            Todo ({{$regularCount}})
        </button>
        <button @click="state = 'prio'" wire:click="showListByFilter('prio')"
                :class="{'bg-blue-100 dark:bg-blue-700': state === 'prio2', 'hover:bg-blue-50 hover:dark:bg-blue-800': state !== 'prio2'}"
                class="tracking-widest uppercase text-xs border-b border-t border-r border-blue-200 py-1.5 text-center w-full">
            Prio ({{$prioCount}})
        </button>
        <button @click="state = 'remind'" wire:click="showListByFilter('remind')"
                :class="{'bg-blue-100 dark:bg-blue-700': state === 'remind', 'hover:bg-blue-50 hover:dark:bg-blue-800': state !== 'remind'}"
                class="tracking-widest uppercase text-xs border-b border-t border-r border-blue-200 py-1.5 text-center w-full">
            Remind ({{$remindCount}})
        </button>
        <button @click="state = 'paused'" wire:click="showListByFilter('paused')"
                :class="{'bg-blue-100 dark:bg-blue-700': state === 'paused', 'hover:bg-blue-50 hover:dark:bg-blue-800': state !== 'paused'}"
                class="tracking-widest uppercase text-xs border-b border-t border-r border-blue-200 py-1.5 text-center w-full">
            Paused ({{$pausedCount}})
        </button>
        <button @click="state = 'contact'" wire:click="showListByFilter('contact')"
                :class="{'bg-blue-100 dark:bg-blue-700': state === 'contact', 'hover:bg-blue-50 hover:dark:bg-blue-800': state !== 'contact'}"
                class="tracking-widest uppercase text-xs border-b border-t border-r border-blue-200 py-1.5 text-center w-full">
            Contact ({{$contactCount}})
        </button>
        <button @click="state = 'meeting'" wire:click="showListByFilter('meeting')"
                :class="{'bg-blue-100 dark:bg-blue-700': state === 'meeting', 'hover:bg-blue-50 hover:dark:bg-blue-800': state !== 'meeting'}"
                class="tracking-widest uppercase text-xs border-b border-t border-r border-blue-200 py-1.5 text-center w-full">
            Meeting ({{$meetingCount}})
        </button>
        <button @click="state = 'done'"
                :class="{'bg-blue-100 dark:bg-blue-700': state === 'done', 'hover:bg-blue-50 hover:dark:bg-blue-800': state !== 'done'}"
                class="tracking-widest uppercase text-xs border border-blue-200 rounded-r-md border-l-0 py-1.5 text-center w-full">
            Done
        </button>
    </div>
</div>
