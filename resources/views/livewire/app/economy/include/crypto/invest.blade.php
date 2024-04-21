<div x-data="{addNewCrypto: false, listCrypto: false}" class="my-4">
    <div class="pl-1 mb-2 font-bold text-lg flex justify-between">
        <div>My investments</div>
        <div class="-mt-1.5">
            <button x-show="!listCrypto" @click="listCrypto = true, addNewCrypto = false"
                    class="text-xs border rounded-md py-1 px-2 uppercase tracking-widest">List data
            </button>
            <button x-show="listCrypto" @click="listCrypto = false, addNewCrypto = false"
                    class="text-xs border rounded-md py-1 px-2 uppercase tracking-widest">close list data
            </button>

            <button x-show="!addNewCrypto" @click="addNewCrypto = true, listCrypto = false"
                    class="text-xs border rounded-md py-1 px-2 uppercase tracking-widest">add data
            </button>
            <button x-show="addNewCrypto" @click="addNewCrypto = false, listCrypto = false"
                    class="text-xs border rounded-md py-1 px-2 uppercase tracking-widest">close add data
            </button>
        </div>
    </div>

    @include('livewire.app.economy.include.crypto.invest-list')
    @include('livewire.app.economy.include.crypto.invest-add')

    <ul x-show="!addNewCrypto && !listCrypto" role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @if (!$list)
            <div class="col-span-5 text-center">Click on - "Get Data" to get the today course for crypto</div>
        @else
            @if (!$cryptoList)
                <div class="col-span-5 text-center">You don't have any crypto added to this account</div>
            @else
                @foreach ($cryptoList as $item)
                    <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white dark:bg-gray-800 shadow dark:shadow-none dark:border dark:border-gray-600">
                        <div class="flex w-full items-center justify-between space-x-6 p-3">
                            <div class="flex-1 truncate">
                                <div class="flex justify-between items-center space-x-3">
                                    <h3 class="truncate text-sm font-medium text-gray-900 dark:text-white uppercase">
                                        {{$item->name}}:
                                    </h3>
                                    <span
                                        class="inline-flex flex-shrink-0 items-center rounded-full bg-gray-700 px-1.5 py-0.5 text-xs">
                                {{ number_format($item->value, 6, ',', ' ') }}
                            </span>
                                </div>
                                <div class="flex justify-between">
                                    <p class="mt-1 truncate text-sm text-gray-500 dark:text-gray-400">
                                        {{ number_format($item->value * ($list[$item->name] * $list['usdToSek']), 0, ',', ' ') }}
                                        kr
                                    </p>
                                    <p class="mt-1 truncate text-sm text-gray-500 dark:text-gray-400">
                                        + {{ number_format( ($item->value * ($list[$item->name] * $list['usdToSek'])) - $item->buy_value_sek, 0, ',', ' ') }}
                                        kr
                                    </p>
                                </div>
                                <p class="mt-1 truncate text-xs text-gray-500 dark:text-gray-200">
                                    @if ($item->comment)
                                        <span class="italic font-bold">{{$item->comment}}</span>
                                    @else
                                        <span class="italic">No comment</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        @endif
    </ul>
</div>
