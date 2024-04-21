@props([
    'class' => null,
    'model' => null,
    'title' => null,
    'placeholder' => null,
    'right' => null,
    'pr'    => 'pr-2',
    ])

<div class="{{$class}}">
    <label class="text-sm">{{$title}}</label>
    <div class="relative rounded-md border-gray-600 border">
        <input wire:model="{{$model}}" type="text" placeholder="{{$placeholder}}" class="text-right block w-full rounded-md border-0 py-1 pl-7 {{$pr}} text-white bg-gray-700 border-gray-600 placeholder:text-gray-400">
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <span class="text-gray-500 sm:text-sm" id="price-currency">{{$right}}</span>
        </div>
    </div>
</div>
