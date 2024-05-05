<div x-show="notes" x-cloak class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 mt-1">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            @if ($note)
                <div class="flex justify-between gap-2 pb-2 font-bold pl-1 uppercase tracking-widest">
                    <div>{{$note->name}}</div>
                    <div class="flex gap-2">
                        <div>
                            <button wire:click="timeStamp">Add timestamp</button>
                        </div>
                        <div>
                            updated: {{$note->updated_at}}
                        </div>
                    </div>
                </div>
                <div>
                    <textarea wire:keydown.enter="changeNote({{$note->id}}, 'note', $event.target.value)" rows="15" class="bg-gray-800 border border-gray-600 rounded-md w-full">{{$note->note}}</textarea>
                </div>
            @else
                No Note
            @endif
        </div>
    </div>
</div>
