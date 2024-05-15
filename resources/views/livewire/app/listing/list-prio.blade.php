<div>

    <div>
        <input wire:model="name" type="text">
        <button wire:click="addNew">Lägg till</button>
    </div>

    <div>
        <button wire:click="runNewItems">Run New</button>
    </div>

    <div x-data="{ dragged: null }">
        <ul x-ref="list">
            @foreach ($priolists as $item)
                <li draggable="true"
                    @dragstart="dragged = {{ $item->id }}"
                    @dragend="$wire.call('updatePriority', Array.from($refs.list.children).filter(function (child) {
                    return child.hasAttribute('draggable');
                }).map((el, index) => ({ value: el.getAttribute('data-id'), order: index })))"
                    @dragover.prevent
                    @drop.prevent
                    :class="{ 'bg-blue-500': dragged === {{ $item->id }} }"
                    data-id="{{ $item->id }}"
                    class="p-2 mb-1 bg-gray-200 rounded cursor-move select-none">
                    {{ $item->name }}
                </li>
            @endforeach
        </ul>
    </div>


</div>
