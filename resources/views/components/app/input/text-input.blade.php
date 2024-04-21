@props([
    'class' => null,
    'model' => null,
    'title' => null,
    'placeholder' => null,
    ])

<div class="{{$class}}">
    <label class="text-xs ml-1">{{$title}}</label>
    <input wire:model="{{$model}}" type="text" class="w-full bg-gray-700 border-gray-600 border rounded-md py-1 px-2" placeholder="{{$placeholder}}">
</div>
