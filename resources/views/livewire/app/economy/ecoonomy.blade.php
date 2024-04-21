<div x-data="{sec: 'dash'}" class="pb-24">
    <livewire:app.top.top-display :title="'Economy'"/>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="bg-gray-800 pb-6 -mt-4">
                    <div class="mx-auto max-w-7xl">

                        <div class="sm:hidden">
                            <label for="tabs" class="sr-only">Select a tab</label>
                            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                            <select id="tabs" name="tabs" class="block w-full rounded-md border-none bg-white/5 py-2 pl-3 pr-10 text-base text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm">
                                <option selected>Overview</option>
                                <option>Activity</option>
                                <option>Settings</option>
                                <option>Collaborators</option>
                                <option>Notifications</option>
                            </select>
                        </div>

                        <div class="hidden sm:block">
                            <nav class="flex justify-end border-b border-white/10 py-4">
                                <ul role="list" class="flex justify-end min-w-full flex-none gap-x-6 px-2 text-sm font-semibold leading-6 text-gray-400">
                                    <li>
                                        <button @click="sec = 'dash'"
                                                class=" hover:text-indigo-300"
                                                :class="{'text-indigo-400': sec === 'dash'}">
                                            Dash</button>
                                    </li>
                                    <li>
                                        <button @click="sec = 'income'"
                                                class=" hover:text-indigo-300"
                                                :class="{'text-indigo-400': sec === 'income'}">
                                            Income</button>
                                    </li>
                                    <li>
                                        <button @click="sec = 'expense'"
                                                class=" hover:text-indigo-300"
                                                :class="{'text-indigo-400': sec === 'expense'}">
                                            Expense</button>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>

                <div x-show="sec === 'dash'">
                    @include('livewire.app.economy.include.crypto.dash')
                    @if (\Illuminate\Support\Facades\Auth::id() == 1)
                        @include('livewire.app.economy.include.crypto.course')
                        @include('livewire.app.economy.include.crypto.invest')
                    @endif
                </div>
                <div x-show="sec === 'income'">
                    @include('livewire.app.economy.include.income')
                </div>
                <div x-show="sec === 'expense'">
                    @include('livewire.app.economy.include.expense')
                </div>

            </div>
        </div>
    </div>
</div>
