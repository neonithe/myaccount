@props([
    'data'  =>  null,
    'close' =>  null,
    'title' =>  null,
    'top'   =>  null,
    'body'  =>  null,
])

<div
    @keydown.window.escape="{{$close}}"
    x-show="{{$data}}" x-cloak
    class="relative z-10 border-l"
    x-ref="dialog"
    aria-modal="true">
    <div class="fixed inset-0"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex sm:max-w-full pl-10 sm:pl-16">

                <div x-show="{{$data}}" x-cloak
                     x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full"
                     x-description="Slide-over panel, show/hide based on slide-over state."
                     @click.away="{{$close}}"
                     class="pointer-events-auto w-screen max-w-2xl sm:border-l sm:border-gray-500">

                    <div class="flex h-full flex-col overflow-y-scroll bg-gray-800 py-6 shadow-xl">
                        <div class="px-4 sm:px-6">
                            <div class="rounded-md">
                                <div class="flex items-start justify-between text-gray-300 border-b pb-1">
                                    @if ($title)
                                        <div class="uppercase tracking-widest font-bold text-2xl">
                                            {{$title}}
                                        </div>
                                    @endif
                                    @if ($top)
                                        {{$top}}
                                    @endif
                                    <div>
                                        <button @click="{{$close}}"><x-app.icons.x class="h-8 w-8"/></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative mt-6 flex-1 px-4 sm:px-6 text-white">
                            {{$body}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
