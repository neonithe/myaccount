<div class="bg-gray-700 rounded-md p-4">
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
