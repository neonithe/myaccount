<div x-show="addNewCrypto" class="border rounded-md p-4 mb-4">
    <div class="flex gap-2">
        <div class="grow">
            <label class="block text-sm">Cryptoname</label>
            <input wire:model="crytoName" type="text" class="bg-gray-700 rounded-md py-1 w-full" placeholder="Btc">
        </div>
        <div class="grow">
            <label class="block text-sm">Comment</label>
            <input wire:model="cryptoComment" type="text" class="bg-gray-700 rounded-md py-1 w-full"
                   placeholder="This is my first crypto investment">
        </div>
        <div>
            <label class="block text-sm">Value in sek</label>
            <input wire:model="cryptoSekValue" type="number" class="bg-gray-700 rounded-md py-1 text-right"
                   placeholder="Enter value in $">
        </div>
        <div>
            <label class="block text-sm">Value</label>
            <input wire:model="cryptoValue" type="number" class="bg-gray-700 rounded-md py-1 text-right"
                   placeholder="Enter value in $">
        </div>
        <div class="mt-5">
            <button wire:click="addToList" @click="addNewCrypto = false" class="border rounded-md py-1 px-1">
                <x-app.icons.circle-plus class="h-6 w-6"/>
            </button>
        </div>
    </div>
</div>
