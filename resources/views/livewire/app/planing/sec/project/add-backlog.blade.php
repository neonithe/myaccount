<div class="grow">
    <label class="text-sm">Name</label>
    <div><input wire:model="name" type="text" class="bg-gray-600 rounded-md py-1 px-2 border w-full"></div>
</div>
<div>
    <label class="text-sm">Link</label>
    <div><input wire:model="link" type="text" class="bg-gray-600 rounded-md py-1 px-2 border w-full"></div>
</div>
<div>
    <label class="text-sm">Motivation/comment</label>
    <div><textarea wire:model="comment" rows="5" class="bg-gray-600 rounded-md py-1 px-2 border w-full"></textarea></div>
</div>

<div class="flex gap-2">
    <div>
        <label class="text-sm">Size</label>
        <div>
            <select wire:model="size" class="bg-gray-600 rounded-md py-1 border">
                <option value="">Not set</option>
                <option value="2">XtraSmall</option>
                <option value="5">Small</option>
                <option value="10">Medium</option>
                <option value="20">Large</option>
                <option value="30">XtraLarge</option>
            </select>
        </div>
    </div>
    <div>
        <label class="text-sm">Frontend</label>
        <div><input wire:model="fe" type="text" class="bg-gray-600 rounded-md py-1 px-2 border w-20"></div>
    </div>
    <div>
        <label class="text-sm">Backend</label>
        <div><input wire:model="be" type="text" class="bg-gray-600 rounded-md py-1 px-2 border w-20"></div>
    </div>
    <div>
        <label class="text-sm">Quarter</label>
        <div>
            <select wire:model="quarter" class="bg-gray-600 rounded-md py-1 border">
                <option value="5">Not set</option>
                <option value="1">Q1</option>
                <option value="2">Q2</option>
                <option value="3">Q3</option>
                <option value="4">Q4</option>
            </select>
        </div>
    </div>
    <div>
        <label class="text-sm">Prio</label>
        <div>
            <select wire:model="prio" class="bg-gray-600 rounded-md py-1 border">
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>
        </div>
    </div>
    <div class="grow flex justify-end">
        <div class="mt-6">
            <button wire:click="addProject" class="border rounded-md py-1 px-2 hover:bg-blue-500">Add project</button>
        </div>
    </div>
</div>
