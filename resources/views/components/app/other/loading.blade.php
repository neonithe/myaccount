@props([
    'label' =>  null,
    'event' =>  null,
])

<div wire:loading wire:target="{{$event}}">
    <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-20 flex items-center justify-center z-50">
        <div class="text-center">
            <div class="inline-block h-12 w-12 animate-spin rounded-full border-4 border-solid border-current border-e-transparent align-[-0.125em] text-surface motion-reduce:animate-[spin_1.5s_linear_infinite] dark:text-white"
                 role="status">
            </div>
        </div>
        @if ($label)
            <div class="text-white font-bold tracking-widest uppercase bg-gray-500 px-3 rounded-md mt-3">
                {{$label}}
            </div>
        @endif
    </div>
</div>
