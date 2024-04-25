<div x-data="{showNow: 'showLinks'}" class="pt-2 pb-24">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="pl-2 pr-4 pb-6 sm:p-6 text-gray-900 dark:text-gray-100">

                <div class="hidden sm:block">
                    <div class="flex justify-between">
                        <div class="text-lg uppercase tracking-widest">Links</div>
                        <div class="flex justify-end gap-2">
                            <button @click="showNow = 'showLinks'" class="border rounded-md py-1 px-2 text-xs sm:text-sm hover:bg-gray-600">Links</button>
                            <button @click="showNow = 'cat'" class="border rounded-md py-1 px-2 text-xs sm:text-sm hover:bg-gray-600">Categories</button>
                            <button @click="showNow = 'tag'" class="border rounded-md py-1 px-2 text-xs sm:text-sm hover:bg-gray-600">Tags</button>
                        </div>
                    </div>
                </div>

                <div x-show="showNow === 'showLinks'" class="mt-4">
                    @include('livewire.app.link.link.include.link-view')
                </div>
                <div x-show="showNow === 'cat'">
                    @include('livewire.app.link.link.include.cat-view')
                </div>
                <div x-show="showNow === 'tag'">
                    @include('livewire.app.link.link.include.tag-view')
                </div>

            </div>
        </div>
    </div>

</div>
