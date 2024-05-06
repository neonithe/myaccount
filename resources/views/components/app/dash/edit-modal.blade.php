<div x-data="{ editModal: @entangle('editModal') }" class="flex">
    <div class="grow">
        <button wire:click="openEdit({{$id}})" wire:loading.attr="disabled" class="py-0.5 bg-gray-700 border-0 text-sm pl-0.5 w-full text-start hover:bg-gray-600 rounded-md cursor-pointer">
            <span wire:target="openEdit">{{$todo}}</span>
        </button>
    </div>

    <div  class="flex justify-center">

        <div
            x-show="editModal"
            style="display: none"
            x-on:keydown.escape.prevent.stop="editModal = false"
            role="dialog"
            aria-modal="true"
            x-id="['modal-title']"
            :aria-labelledby="$id('modal-title')"
            class="fixed inset-0 z-10 overflow-y-auto"
        >
            <!-- Overlay -->
            <div x-show="editModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-20"></div>

            <!-- Panel -->
            <div
                x-show="editModal" x-transition
                x-on:click="editModal = false"
                class="relative flex min-h-screen items-center justify-center p-4"
            >
                <div x-on:click.stop class="relative w-full max-w-xl overflow-y-auto rounded-xl bg-gray-700 p-2 shadow-lg border border-gray-400">
                    <div>
                        <div class="flex gap-2">
                            <div class="grow">
                                <input wire:model="editTodo" type="text" class="bg-gray-700 py-0.5 text-base rounded-md w-full border-gray-600 font-bold">
                            </div>
                            <div>
                                <button wire:click="editTodoPrivate" class="border rounded-md py-1 px-1 hover:bg-blue-600 @if ($isPrivate) bg-blue-500 @endif"><x-app.icons.fingerprint class="h-5 w-5"/></button>
                            </div>
                            <div>
                                <button wire:click="editTodoPrio" class="border rounded-md py-1 px-1 hover:bg-red-600 @if ($isPrio) bg-red-500 @endif"><x-app.icons.varning class="h-5 w-5"/></button>
                            </div>
                        </div>
                        <div class="grow mt-2">
                            <input wire:model="editLink" type="text" class="text-sm bg-gray-700 py-0.5 text-base rounded-md w-full border-gray-600 font-bold" @if (!$editLink) placeholder="No link" @endif>
                        </div>
                        <div class="mt-2">
                            <textarea wire:model="editComment" rows="5" class="text-sm bg-gray-700 py-0.5 text-base rounded-md w-full border-gray-600" @if (!$editComment) placeholder="No comment" @endif></textarea>
                        </div>
                        <div class="flex justify-end gap-1">
                            <button wire:click="updateTodo" class="border rounded-md py-1 px-1 hover:bg-blue-600">Save</button>
                            <button wire:click="cleanModal" class="border rounded-md py-1 px-1 hover:bg-gray-600">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
