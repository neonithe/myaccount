<div class="bg-gray-800">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-px bg-white/5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-gray-800 px-4 py-6 sm:px-6 lg:px-8">
                <p class="text-sm font-medium leading-6 text-gray-400">#Income/ #Expense</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-white">{{$this->getTotalIncomeCount()}} / {{$this->getTotalExpenseCount()}}</span>
                </p>
            </div>
            <div class="bg-gray-800 px-4 py-6 sm:px-6 lg:px-8">
                <p class="text-sm font-medium leading-6 text-gray-400">Total income</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-white">{{number_format($this->getTotalIncomeSum(), 0, ',', ' ')}}kr</span>
                </p>
            </div>
            <div class="bg-gray-800 px-4 py-6 sm:px-6 lg:px-8">
                <p class="text-sm font-medium leading-6 text-gray-400">Total expense</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-white">{{number_format($this->getTotalExpenseSum(), 0, ',', ' ')}}kr</span>
                </p>
            </div>
            <div class="bg-gray-800 px-4 py-6 sm:px-6 lg:px-8">
                <p class="text-sm font-medium leading-6 text-gray-400">Result</p>
                <p class="mt-2 flex items-baseline gap-x-2">
                    <span class="text-4xl font-semibold tracking-tight text-white">{{number_format($this->getTotalExpenseSum()+$this->getTotalIncomeSum(), 0, ',', ' ')}}kr</span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-5 gap-2 text-xs pt-2 pb-4 border-b border-gray-700 px-4">
    @foreach ($category as $cat)
        <div class="flex gap-2">
            <div class="w-20">{{$cat->name}}:</div>
            <div class="text-red-500">{{number_format($this->getCatSum($cat->id), 0, ',', ' ')}}kr</div>
        </div>
    @endforeach
</div>
