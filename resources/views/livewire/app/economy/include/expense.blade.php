<div class="flex gap-4">
    <div class="w-1/2">
        <div class="flex justify-between gap-4">
            <div class="w-full">
                <div class="border-b mb-2 flex justify-between">
                    <div>Add expense</div>
                </div>
                <div class="flex gap-2">
                    <div>
                        <select wire:model="expense_cat" class="bg-gray-700 text-white rounded-md py-1">
                            <option value="">Välj kategori</option>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grow">
                        <input wire:model="expense_name" type="text" class="bg-gray-700 text-white rounded-md py-1 w-full">
                    </div>
                    <div>
                        <div class="relative rounded-md w-32">
                            <input wire:model="expense_sum" type="number" class="text-right block w-full rounded-md border border-gray-500 py-1 pr-8 text-gray-900 dark:text-white dark:bg-gray-700" placeholder="0,00">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 sm:text-sm" id="price-currency">kr</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button wire:click="addExpense" class="border rounded-md py-1 px-1 text-white bg-green-700 hover:bg-green-800"><x-app.icons.circle-plus class="h-6 w-6"/></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-1/2">
        <div class="border-b mb-2 flex justify-between">
            <div>List expense</div>
            <div>
                @if ($filterCat)
                    <div class="flex gap-2">
                        <div>Summa:</div>
                        <div>{{ number_format($this->getCatSum($filterCat), 0, ',', ' ') }} kr</div>
                    </div>
                @else
                    <div>
                        Summa: {{ number_format($this->getTotalExpenseSum(), 0, ',', ' ') }}kr
                    </div>
                @endif
            </div>
        </div>
        <div class="border-b border-gray-600 pb-2 flex gap-2">
            <input wire:model.live="search" type="text" class="bg-gray-700 py-1 border rounded-md w-full" placeholder="Search">
            <select wire:model.live="filterCat" class="bg-gray-700 py-1 border rounded-md">
                <option value="">Filter on category</option>
                @foreach ($category as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        @foreach ($expense as $exp)
            <div class="flex justify-between gap-1 border-b border-gray-600 py-1.5">
                <div>
                    <select wire:change="changeExpense({{$exp->id}}, 'cat_id', $event.target.value )" class="bg-gray-800 border-0 py-1 rounded-md pl-1 font-bold">
                        @foreach ($category as $item)
                            <option value="{{$item->id}}" @if ($item->id == $exp->cat_id) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grow">
                    <input wire:keydown.enter="changeExpense({{$exp->id}}, 'name', $event.target.value )" type="text" class="bg-gray-800 border-0 py-1 rounded-md pl-1 w-full" value="{{$exp->name}}">
                </div>
                <div class="flex gap-2">
                    <div class="relative rounded-md w-32">
                        <input wire:keydown.enter="changeExpense({{$exp->id}}, 'sum', $event.target.value )" type="text" value="{{$exp->sum}}" class="text-right block w-full rounded-md border-0 py-1 pr-8 text-gray-900 dark:text-white dark:bg-gray-800" placeholder="0,00">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <span class="text-gray-500 sm:text-sm" id="price-currency">kr</span>
                        </div>
                    </div>
                    <div class="mt-0.5">
                        <button wire:click="deleteExpense({{$exp->id}})" class="rounded-md py-1 px-1 text-red-600 hover:text-red-500"><x-app.icons.trash class="h-5 w-5"/></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
