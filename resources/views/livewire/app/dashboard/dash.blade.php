<div class="pb-24">
    <livewire:app.top.top-display :title="'Dashboard'"/>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-1">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-4">

                    <div class="bg-gray-700 rounded-md p-4">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Prio</div>
                        @foreach ($this->getTodos('notice') as $item)
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                                <div class="tracking-widest">
                                    @if ($item->link)
                                        <a href="{{$item->link}}" target="_blank" class="text-blue-500 hover:underline">{{$item->todo}}</a>
                                    @else
                                        {{$item->todo}}
                                    @endif
                                </div>
                                <div></div>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gray-700 rounded-md p-4">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Reminders</div>
                        <div>
                            @if ($this->getTodoReminders()->count() != 0)
                                <div class="border-b border-gray-600">Reminders</div>
                            @else
                                <div class="border-b border-gray-600">Reminders</div>
                                <span class="italic text-sm">No Repeats</span>
                            @endif
                        </div>
                        @foreach ($this->getTodoReminders() as $item)
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1 px-2">
                                <div class="tracking-widest w-full">
                                    <div>
                                        @if ($item->link)
                                            <a href="{{$item->link}}" target="_blank" class="text-blue-500 hover:underline">{{$item->todo}}</a>
                                        @else
                                            {{$item->todo}}
                                        @endif
                                    </div>
                                    <div class="w-full flex justify-between">
                                        @if (\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->remind_date)))
                                            <div class="text-red-600 text-xs">{{$item->remind_date}}</div>
                                            <div>
                                                Date passed
                                            </div>
                                        @else
                                            <div class="text-white text-xs">{{$item->remind_date}}</div>
                                            <div class="text-white text-xs">{{ date('H:i', strtotime($item->remind_time)) }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div></div>
                            </div>
                        @endforeach

                        <div>
                            @if ($this->getTodoRepeat()->count() != 0)
                                <div class="border-b border-gray-600 mt-3">Repeats</div>
                            @else
                                <div class="border-b border-gray-600 mt-3">Repeats</div>
                                <span class="italic text-sm">No Repeats</span>
                            @endif
                        </div>
                        @foreach ($this->getTodoRepeat() as $item)
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1 px-2">
                                <div class="tracking-widest w-full">
                                    <div class="flex justify-between">
                                        @if ($item->link)
                                            <a href="{{$item->link}}" target="_blank" class="text-blue-500 hover:underline">{{$item->todo}}</a>
                                        @else
                                            <button wire:click="repeatCheck({{$item->id}})" class="text-blue-500 hover:underline">{{$item->todo}}</button>
                                            <a href="{{$item->link}}" target="_blank" class="text-blue-500 hover:underline"><x-app.icons.link class="h-4 w-4" /></a>
                                        @endif
                                    </div>
                                    <div class="w-full flex justify-between">
                                        @if (\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->repeat)))
                                            <div class="text-red-600">{{$item->repeat}}</div>
                                            <div>
                                                Date passed
                                            </div>
                                        @else
                                            <div class="text-white">{{$item->repeat}}</div>
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
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1 @if ($dayName == $item->remind_day) bg-blue-600 @endif px-1 rounded-md">
                                <div class="tracking-widest">
                                    @if ($item->link)
                                        <a href="{{$item->link}}" target="_blank" class="text-blue-500 hover:underline">{{$item->todo}}</a>
                                    @else
                                        {{$item->todo}}
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <div>
                                        {{$item->remind_day}}
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
                                        <a href="{{$item->link}}" target="_blank" class="text-blue-500 hover:underline">{{$item->todo}}</a>
                                    @else
                                        {{$item->todo}}
                                    @endif
                                </div>
                                <div></div>
                            </div>
                        @endforeach
                    </div>


                    <div class="bg-gray-700 rounded-md p-4 hidden sm:block">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Todos</div>

                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">All Todos</div>
                            <div>{{$allCount}} st</div>
                        </div>
                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">Todos</div>
                            <div>{{$regularCount}} st</div>
                        </div>
                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">Prio</div>
                            <div>{{$prioCount}} st</div>
                        </div>
                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">Reminders</div>
                            <div>{{$remindCount}} st</div>
                        </div>
                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">Meetings</div>
                            <div>{{$meetingCount}} st</div>
                        </div>
                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">Contact</div>
                            <div>{{$contactCount}} st</div>
                        </div>
                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">Paused</div>
                            <div>{{$pausedCount}} st</div>
                        </div>
                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">Done</div>
                            <div>{{$doneCount}} st</div>
                        </div>
                    </div>

                    <div class="bg-gray-700 rounded-md p-4 hidden sm:block">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Workout</div>
                        @foreach ($workouts as $workout)
                            <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                                <div class="tracking-widest">{{$workout->workout_set}}</div>
                                <div></div>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-gray-700 rounded-md p-4 hidden sm:block">
                        <div class="uppercase tracking-widest border-b border-gray-500 mb-1">Food</div>
                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">Recipes</div>
                            <div>{{$recipeCount}} st</div>
                        </div>
                        <div class="flex justify-between text-sm border-b border-gray-600 py-1">
                            <div class="tracking-widest">Ingredients</div>
                            <div>{{$ingCount}} st</div>
                        </div>
                    </div>

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
                </div>

            </div>
        </div>
    </div>
</div>
