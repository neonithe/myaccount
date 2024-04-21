<div x-show="listCrypto" class="border rounded-md border-gray-600 p-4">
    <div class="-mt-3 pt-2 font-bold">
        List all investments
    </div>
    <div class="grid grid-cols-4 gap-2 text-sm border-b mb-2 mt-1">
        <div>Cryptoname</div>
        <div>Comment</div>
        <div class="text-right">Buy value</div>
        <div class="text-right">Value</div>
    </div>
    @foreach ($cryptoList as $item)
        <div class="grid grid-cols-4 gap-2 py-1 border-b border-gray-600">
            <div>
                <input wire:keydown.enter="changeCryptoValue({{$item->id}}, 'name', $event.target.value)"
                       type="text" class="pl-0 bg-gray-800 border-0 rounded-md py-1 w-full" value="{{$item->name}}">
            </div>
            <div>
                <input wire:keydown.enter="changeCryptoValue({{$item->id}}, 'comment', $event.target.value)"
                       type="text" class="pl-0 bg-gray-800 border-0 rounded-md py-1 w-full"
                       value="{{$item->comment}}">
            </div>
            <div class="flex">
                <input wire:keydown.enter="changeCryptoValue({{$item->id}}, 'buy_value_sek', $event.target.value)"
                       type="number" class="px-0 bg-gray-800 border-0 rounded-md py-1 w-full text-right"
                       value="{{$item->buy_value_sek}}">
                <div class="mt-1 pl-0.5">kr</div>
            </div>
            <div>
                <input wire:keydown.enter="changeCryptoValue({{$item->id}}, 'value', $event.target.value)"
                       type="number" class="px-0 bg-gray-800 border-0 rounded-md py-1 w-full text-right"
                       value="{{$item->value}}">
            </div>
        </div>
    @endforeach
</div>
