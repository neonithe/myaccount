
<div class="flex justify-center">
    <div
        x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
        x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
        x-id="['dropdown-button']"
        class="relative"
    >
        <!-- Button -->
        <button
            x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')"
            type="button"
            class="pt-0.5 text-blue-600 hover:text-blue-500 mt-1"

            @if ($stateId) x-tooltip="{{ $this->getStateName($stateId) }}"  @else x-tooltip="Add tag"  @endif
        >

            {{--
            TodoState::create(['state'=>'Mail to']);
        TodoState::create(['state'=>'Contact']);
        TodoState::create(['state'=>'Create']);
        TodoState::create(['state'=>'Update']);
        TodoState::create(['state'=>'Remove']);

        TodoState::create(['state'=>'Meeting']);
        TodoState::create(['state'=>'Economic']);
        TodoState::create(['state'=>'Handle now']);
        TodoState::create(['state'=>'Ask about']);
        TodoState::create(['state'=>'Discover']);

        TodoState::create(['state'=>'Send']);
            --}}

            @switch($stateId)
                @case(1) <x-app.icons.mail class="h-5 w-5"/> @break
                @case(2) <x-app.icons.phone class="h-5 w-5"/> @break
                @case(3) <x-app.icons.circle-plus class="h-5 w-5"/> @break
                @case(4) <x-app.icons.update class="h-5 w-5"/> @break
                @case(5) <x-app.icons.trash class="h-5 w-5"/> @break

                @case(6) <x-app.icons.meeting class="h-5 w-5"/> @break
                @case(7) <x-app.icons.dollar class="h-5 w-5"/> @break
                @case(8) <x-app.icons.bell-2 class="h-5 w-5"/> @break
                @case(9) <x-app.icons.megaphone class="h-5 w-5"/> @break
                @case(10) <x-app.icons.circle-mag class="h-5 w-5"/> @break

                @case(11) <x-app.icons.flag class="h-5 w-5"/> @break
                @case(12) <x-app.icons.clock class="h-5 w-5"/> @break

                @default <x-app.icons.tag class="h-5 w-5 text-blue-300 hover:text-blue-500"/> @break
            @endswitch

        </button>

        <!-- Panel -->
        <div
            x-ref="panel"
            x-show="open"
            x-transition.origin.top.left
            x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')"
            style="display: none;"
            class="absolute right-0 mt-2 w-40 rounded-md bg-white shadow-md z-50"
        >
                <button @click="moreinfo = !moreinfo" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2 text-left text-xs hover:bg-gray-50 disabled:text-gray-500">
                    Add comment & link
                </button>
                <button wire:click="pauseTodo({{ $itemId }})" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2 text-left text-xs hover:bg-gray-50 disabled:text-gray-500">
                    @if (\App\Models\todo\Todo::findOrFail($itemId)->paused)
                        Denna Todo är pausad
                    @else
                        Pausa Todo
                    @endif
                </button>
            <div class="border-b"></div>
            @foreach ($list as $item)
                <button wire:click="changeState({{ $itemId }}, {{$item->id}})" @click="open = false" class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                    {{$item->state}}
                </button>
            @endforeach

        </div>
    </div>
</div>
