<div x-data="{buttonSettings: false, adminSettings: false}" class="pb-24">
    <livewire:app.top.top-display :title="'Dashboard'"/>

    @include('livewire.app.dashboard.include.buttons')
    @include('livewire.app.dashboard.include.admin-settings')
    @include('livewire.app.dashboard.include.button-settings')

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-1">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-4">

                    <div class="bg-gray-700 rounded-md p-4">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Todo</div>
                        @foreach ($this->getTodos('todo') as $item)
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                                <div class="tracking-widest">
                                    @if ($item->link)
                                        <a href="{{$item->link}}" target="_blank"  @if ($item->comment) x-tooltip="{{$item->comment}}" @endif  class="text-blue-500 hover:underline">{{$item->todo}}</a>
                                    @else
                                        <div @if ($item->comment) x-tooltip="{{$item->comment}}" class="cursor-pointer" @endif >{{$item->todo}}</div>
                                    @endif
                                </div>
                                <div>
                                    <button wire:click="check({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-3">
                            @if ($workoutDay->count() != 0)
                                <div class="border-b border-gray-600 font-bold">Workout</div>
                            @else
                                <div class="border-b border-gray-600 font-bold">Workout</div>
                                <span class="italic text-sm">No workouts today</span>
                            @endif
                        </div>
                        <div>
                            @foreach ($workoutDay as $workout)
                                <p>{{$workout->workout_set}}</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-gray-700 rounded-md p-4">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Prio</div>
                        @foreach ($this->getTodos('notice') as $item)
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                                <div class="tracking-widest">
                                    @if ($item->link)
                                        <a href="{{$item->link}}" target="_blank"  @if ($item->comment) x-tooltip="{{$item->comment}}" @endif  class="text-blue-500 hover:underline">{{$item->todo}}</a>
                                    @else
                                        <div @if ($item->comment) x-tooltip="{{$item->comment}}" class="cursor-pointer" @endif >{{$item->todo}}</div>
                                    @endif
                                </div>
                                <div>
                                    <button wire:click="check({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gray-700 rounded-md p-4">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Reminders</div>
                        <div>
                            @if ($this->getTodoReminders()->count() != 0)
                                <div class="border-b border-gray-600 font-bold">Reminders</div>
                            @else
                                <div class="border-b border-gray-600 font-bold">Reminders</div>
                                <span class="italic text-sm">No Repeats</span>
                            @endif
                        </div>

                        @foreach ($this->getTodoReminders() as $item)
                            <div @if ($item->comment) x-tooltip="{{$item->comment}}" @endif class="flex justify-between text-sm py-1 px-2 @if ($item->remind_date == date('Y-m-d')) bg-blue-700 rounded-md border my-1 @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->remind_date))) bg-red-700 rounded-md border my-1 @else border-b border-gray-600 my-1 @endif">
                                <div class="tracking-widest w-full">
                                    <div class="flex justify-between">
                                        @if ($item->link)
                                            <a href="{{$item->link}}" target="_blank" class="text-blue-200 font-bold hover:underline">
                                                {{$item->todo}}
                                            </a>
                                        @else
                                            {{$item->todo}}
                                        @endif

                                        <div class="flex gap-1">
                                            @if ($item->remind_time)
                                                <div class="text-white text-xs mt-0.5">{{ date('H:i', strtotime($item->remind_time)) }}</div>
                                            @endif
                                            <div>
                                                <button wire:click="check({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full flex justify-between">
                                        @if ($item->remind_date == date('Y-m-d'))
                                            <div class="text-xs font-bold">
                                                {{$item->remind_date}}
                                            </div>
                                            <div class="text-xs font-bold">
                                                Today
                                            </div>
                                        @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->remind_date)))
                                            <div class="text-xs font-bold">
                                                {{$item->remind_date}}
                                            </div>
                                            <div class="text-xs font-bold">
                                                {{abs($this->getDaysTo($item->remind_date))-1}} days passed
                                            </div>
                                        @else
                                            <div class="text-xs font-bold">
                                                {{$item->remind_date}}
                                            </div>
                                            <div class="text-xs font-bold">
                                                Days:{{$this->getDaysTo($item->remind_date)+1}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div></div>
                            </div>
                        @endforeach

                        <div>
                            @if ($this->getTodoRepeat()->count() != 0)
                                <div class="border-b border-gray-600 mt-3 font-bold">Repeats</div>
                            @else
                                <div class="border-b border-gray-600 mt-3 font-bold">Repeats</div>
                                <span class="italic text-sm">No Repeats</span>
                            @endif
                        </div>
                        @foreach ($this->getTodoRepeat() as $item)
                            <div @if ($item->comment) x-tooltip="{{$item->comment}}" @endif class="flex justify-between text-sm py-1 px-2 @if ($item->repeat == date('Y-m-d')) bg-blue-700 rounded-md border my-1 @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->repeat))) bg-red-700 rounded-md border my-1 @else border-b border-gray-600 my-1 @endif">
                                <div class="tracking-widest w-full">
                                    <div class="flex justify-between">
                                        @if ($item->link)
                                            <a href="{{$item->link}}" target="_blank" class="text-blue-200 font-bold hover:underline">
                                                {{$item->todo}}
                                            </a>
                                        @else
                                            {{$item->todo}}
                                        @endif
                                        <div>
                                            <button wire:click="repeatCheck({{$item->id}})" class="border rounded-md px-0.5 py-0.5 hover:bg-green-600"><x-app.icons.check class="h-3 w-3" /></button>
                                        </div>
                                    </div>

                                    <div class="w-full flex justify-between">
                                        @if ($item->repeat == date('Y-m-d'))
                                            <div class="text-xs font-bold">
                                                {{$item->repeat}}
                                            </div>
                                            <div class="text-xs font-bold">
                                                Today
                                            </div>
                                        @elseif(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->repeat)))
                                            <div class="text-xs font-bold">
                                                {{$item->repeat}}
                                            </div>
                                            <div class="text-xs font-bold">
                                                {{abs($this->getDaysTo($item->repeat))-1}} days passed
                                            </div>
                                        @else
                                            <div class="text-xs font-bold">
                                                {{$item->repeat}}
                                            </div>
                                            <div class="text-xs font-bold">
                                                Days:{{$this->getDaysTo($item->repeat)+1}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div></div>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gray-700 rounded-md p-4">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Meeting</div>
                        @foreach ($this->getTodos('meeting') as $item)
                            <div @if ($item->comment) x-tooltip="{{$item->comment}}" @endif class="flex justify-between text-sm py-1 my-1 @if ($dayName == $item->remind_day) bg-blue-600 border @else border-b border-gray-600 @endif px-1 rounded-md">
                                <div class="tracking-widest truncate">
                                    @if ($item->link)
                                        <a href="{{$item->link}}" target="_blank" class="font-bold text-blue-200 hover:underline inline-flex">
                                            {{$item->todo}}
                                        </a>
                                    @else
                                        {{$item->todo}}
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <div>
                                        {{ substr($item->remind_day, 0, 3) }}
                                    </div>
                                    <div>
                                        {{ date('H:i', strtotime($item->remind_time)) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gray-700 rounded-md p-4">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Contact</div>
                        @foreach ($this->getTodos('contact') as $item)
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                                <div class="tracking-widest">
                                    @if ($item->link)
                                        <a href="{{$item->link}}" target="_blank" @if ($item->comment) x-tooltip="{{$item->comment}}" @endif class="text-blue-500 hover:underline">{{$item->todo}}</a>
                                    @else
                                        <div @if ($item->comment) x-tooltip="{{$item->comment}}" class="cursor-pointer" @endif >{{$item->todo}}</div>
                                    @endif
                                </div>
                                <div></div>
                            </div>
                        @endforeach
                    </div>
                    {{--
                    @include('livewire.app.dashboard.other')
                    --}}
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
</div>
