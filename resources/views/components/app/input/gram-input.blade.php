@props([
    'class' => null,
    'model' => null,
    'title' => null,
    'placeholder' => null,
    ])

<div class="{{$class}}">
    <label class="text-xs">{{$title}}</label>
    <div class="relative rounded-md">
        <input wire:model.live="{{$model}}" type="number" class="w-32 text-right bg-gray-700 border-gray-600 border rounded-md py-1 pr-6" placeholder="{{$placeholder}}">
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <span class="text-gray-500 sm:text-sm" id="price-currency">g</span>
        </div>
    </div>
</div>
