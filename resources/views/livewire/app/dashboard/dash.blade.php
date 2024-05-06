<div x-data="{
            buttonSettings: false,
            adminSettings: false,
            notes: false,
            todoPrivate: false,
            prioPrivate: false,
            }" class="pb-24">
    <livewire:app.top.top-display :title="'Dashboard'"/>

    @include('livewire.app.dashboard.include.buttons')
    @include('livewire.app.dashboard.include.admin-settings')
    @include('livewire.app.dashboard.include.button-settings')
    @include('livewire.app.dashboard.include.note')

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-1">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-4">

                    @include('livewire.app.dashboard.include-sec.todo')
                    @include('livewire.app.dashboard.include-sec.prio')
                    @include('livewire.app.dashboard.include-sec.reminders')
                    @include('livewire.app.dashboard.include-sec.meeting')
                    @include('livewire.app.dashboard.include-sec.contact')

                    <div class="bg-gray-700 rounded-md p-4">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1 flex justify-between">
                            <div>Economy</div>
                            <div class="-mt-0.5"><button wire:click="calc" class="text-xs uppercase tracking-widest border rounded-md px-2 hover:bg-gray-500">Get data</button></div>
                        </div>

                        <div class="mt-1">
                            Budget
                        </div>
                        <div class="px-2">
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                                <div class="tracking-widest ">Income</div>
                                <div>{{ number_format( $this->getTotalIncomeSum() , 0, ',', ' ') }} kr</div>
                            </div>
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                                <div class="tracking-widest ">Expense</div>
                                <div>{{ number_format( $this->getTotalExpenseSum() , 0, ',', ' ') }} kr</div>
                            </div>
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                                <div class="tracking-widest ">Result</div>
                                <div>{{ number_format( $this->getTotalIncomeSum()+$this->getTotalExpenseSum() , 0, ',', ' ') }} kr</div>
                            </div>
                        </div>

                        <div class="mt-2">
                            Crypto
                        </div>
                        <div class="px-2">
                            @if (!$cryptoList)
                                <div class="px-4 mt-2 w-full text-center">Click on "get data" to show</div>
                            @else
                                @if (!$investList)
                                @else
                                    @foreach ($investList as $item)
                                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                                            <div class="tracking-widest uppercase">{{$item->name}}</div>
                                            <div>{{ number_format($item->value * ($cryptoList[$item->name] * $cryptoList['usdToSek']), 0, ',', ' ') }} kr</div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>

                    {{-- LINKS --}}
                    <div class="bg-gray-700 rounded-md p-4 col-span-1 sm:col-span-2">
                        <div class="border-b border-gray-500 mb-1 flex justify-between -mt-1">
                            <div class="uppercase tracking-widest mt-1">Links</div>
                            <div>
                                <select wire:model.live="showLinks" class="border-0 py-0.5 bg-gray-700 rounded-md text-center">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex gap-1">
                            <div class="grow">
                                <input wire:model.live="search" type="text" class="border border-gray-600 rounded-md py-0.5 bg-gray-700 w-full text-sm" placeholder="Search">
                            </div>
                            <div class="hidden sm:block">
                                <select wire:model.live="filterCat" class="border border-gray-600 rounded-md py-0.5 bg-gray-700 text-sm">
                                    <option value="">Filter cat</option>
                                    @foreach ($cats as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="hidden sm:block">
                                <select wire:model.live="filterTag" class="border border-gray-600 rounded-md py-0.5 bg-gray-700 text-sm">
                                    <option value="">Filter tag</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <select wire:model.live="filterFav" class="border border-gray-600 rounded-md py-0.5 bg-gray-700 text-sm">
                                    <option value="all">All</option>
                                    <option value="fav">Fav</option>
                                    <option value="nofav">No fav</option>
                                </select>
                            </div>
                        </div>
                        @foreach ($links as $link)
                            <div class="grid grid-cols-2 text-sm py-1 border-b border-gray-600 px-1 rounded-md py-2">
                                <div class="tracking-widest truncate grow">
                                    <a href="{{$link->link}}" target="_blank" class="font-bold text-blue-200 hover:underline inline-flex">
                                        {{$link->name}}
                                    </a>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                    <div class="text-end hidden sm:block">
                                        <select wire:change="changeLink({{$link->id}}, 'cat_id', $event.target.value, 'Category')" class="bg-gray-700 border-0 py-0.5 text-xs">
                                            @foreach ($this->getCat() as $cat)
                                                <option value="{{$cat->id}}" @if ($cat->id == $link->cat_id) selected @endif>{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-end hidden sm:block">
                                        <select wire:change="changeLink({{$link->id}}, 'tag_id', $event.target.value, 'Tag')" class="bg-gray-700 border-0 py-0.5 text-xs">
                                            @foreach ($this->getTag() as $tag)
                                                <option value="{{$tag->id}}" @if ($tag->id == $link->tag_id) selected @endif>{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex justify-end">
                                        @if ($link->fav)
                                            <button wire:click="changeFav({{$link->id}})" class="text-yellow-500"><x-app.icons.star-solid class="h-5 w-5" /></button>
                                        @else
                                            <button wire:click="changeFav({{$link->id}})" class="text-yellow-500"><x-app.icons.star class="h-5 w-5" /></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{--
    <x-app.other.loading event="openEdit" />
    --}}

</div>
