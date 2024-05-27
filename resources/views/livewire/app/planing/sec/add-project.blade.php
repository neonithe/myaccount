<div>
    <div class="grow">
        <label class="text-sm">Name</label>
        <div>
            <input wire:model="name" type="text" class="border-0 bg-gray-600 py-1.5 rounded-md px-2 w-full">
        </div>
    </div>

    <div class="flex gap-2 pt-2">
        <div class="flex gap-2">
            <div>
                <label class="text-sm">Size</label>
                <div>
                    <select wire:model="size" class="border-0 bg-gray-600 py-1.5 rounded-md">
                        <option value="2" >XS</option>
                        <option value="5" >S</option>
                        <option value="10" >M</option>
                        <option value="20" >L</option>
                        <option value="30" >XL</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="text-sm">Frontend</label>
                <div class="flex justify-center">
                    <div class="relative w-16">
                        <input wire:model.live="addFePerc" type="number" class="block w-full rounded-md border-0 py-1.5 pr-6 text-gray-900 text-end bg-gray-600 text-white">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                            <span class="text-gray-300 sm:text-sm">%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <label class="text-sm">Backend</label>
                <div class="flex justify-center">
                    <div class="relative w-16">
                        <input wire:model.live="addBePerc" type="number" class="block w-full rounded-md border-0 py-1.5 pr-6 text-gray-900 text-end bg-gray-600 text-white">
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                            <span class="text-gray-300 sm:text-sm">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex gap-2 px-2">
            <div>
                <label class="text-sm">Total %</label>
                <div class="border border-gray-600 rounded-md p-1.5 px-2 text-center w-16">


                    {{ $addFePerc + $addBePerc }}%
                </div>
            </div>
            <div>
                <label class="text-sm">FE Days</label>
                <div class="border border-gray-600 rounded-md p-1.5 px-2 text-center">
                    5
                </div>
            </div>
            <div>
                <label class="text-sm">BE Days</label>
                <div class="border border-gray-600 rounded-md p-1.5 px-2 text-center">
                    5
                </div>
            </div>
        </div>
        <div class="mt-6 grow flex justify-end">
            <button class="border rounded-md p-1.5">Create project</button>
        </div>
    </div>

</div>
