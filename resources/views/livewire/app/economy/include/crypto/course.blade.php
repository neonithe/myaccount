<div class="my-4">
    <div class="pl-1 mb-2 font-bold text-lg flex justify-between">
        <div>Courses</div>
        <div class="-mt-1.5">
            <button wire:click="calc" class="text-xs border rounded-md py-1 px-2 uppercase tracking-widest">Get data
            </button>
        </div>
    </div>
    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
        @if (!$list)
            <div class="col-span-5 text-center">Click on - "Get Data" to get the today course for crypto</div>
        @else
            @foreach ($list as $name => $value)
                <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white dark:bg-gray-800 shadow dark:shadow-none dark:border dark:border-gray-600">
                    <div class="flex w-full items-center justify-between space-x-6 p-3">
                        <div class="flex-1 truncate">
                            <div class="flex justify-between items-center space-x-3">
                                <h3 class="truncate text-sm font-medium text-gray-900 dark:text-white uppercase">
                                    @if ($name == 'usdToSek')
                                        Usd to sek
                                    @else
                                        1 {{$name}}
                                    @endif
                                </h3>
                                @if ($name != 'usdToSek')
                                    <span
                                        class="inline-flex flex-shrink-0 items-center rounded-full bg-gray-700 px-1.5 py-0.5 text-xs">
                                    {{ number_format($value*$list['usdToSek'], 2, ',', ' ') }}kr
                                </span>
                                @endif
                            </div>
                            @if ($name == 'usdToSek')
                                <p class="mt-1 truncate text-sm text-gray-500 dark:text-gray-400">{{ number_format($value, 2, ',', ' ') }}
                                    kr</p>
                            @else
                                <p class="mt-1 truncate text-sm text-gray-500 dark:text-gray-400">
                                    ${{ number_format($value, 2, ',', ' ') }}</p>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>
