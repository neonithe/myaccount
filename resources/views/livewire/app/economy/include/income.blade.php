<div class="flex gap-4">
    <div class="w-1/2">
        <div class="flex justify-between gap-4">
            <div class="w-full">
                <div class="border-b mb-2">
                    Add income
                </div>
                <div class="flex gap-2">
                    <div class="grow">
                        <input wire:model="income_name" type="text" class="bg-gray-700 text-white rounded-md py-1 w-full">
                    </div>
                    <div>
                        <div class="relative rounded-md w-32">
                            <input wire:model="income_sum" type="number" class="text-right block w-full rounded-md border border-gray-500 py-1 pr-8 text-gray-900 dark:text-white dark:bg-gray-700" placeholder="0,00">
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 sm:text-sm" id="price-currency">kr</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button wire:click="addIncome" class="border rounded-md py-1 px-1 text-white bg-green-700 hover:bg-green-800"><x-app.icons.circle-plus class="h-6 w-6"/></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-1/2">
        <div class="border-b mb-2">
            List income
        </div>
        @foreach ($income as $inc)
            <div class="flex justify-between gap-1">
                <div class="grow">
                    <input wire:keydown.enter="changeIncome({{$inc->id}}, 'name', $event.target.value )" type="text" class="bg-gray-800 border-0 py-1 rounded-md pl-1 w-full" value="{{$inc->name}}">
                </div>
                <div class="flex gap-2">
                    <div class="relative rounded-md w-32">
                        <input wire:keydown.enter="changeIncome({{$inc->id}}, 'sum', $event.target.value )" type="text" value="{{$inc->sum}}" class="text-right block w-full rounded-md border-0 py-1 pr-8 text-gray-900 dark:text-white dark:bg-gray-800" placeholder="0,00">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <span class="text-gray-500 sm:text-sm" id="price-currency">kr</span>
                        </div>
                    </div>
                    <div class="mt-0.5">
                        <button wire:click="deleteIncome({{$inc->id}})" class="rounded-md py-1 px-1 text-red-600 hover:text-red-500"><x-app.icons.trash class="h-5 w-5"/></button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
