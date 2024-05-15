<div x-data="{slider: false}">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-1 mt-1 dark:text-white flex gap-2 justify-between @if ($settings->button_align == 'right')  @else flex-row-reverse @endif px-2 sm:px-0 @if ($buttons->count() < 5) justify-end @else justify-between @endif">
        <div class="mt-0.5 uppercase tracking-widest">
            @if ($settings->private)
                private
            @else
                regular
            @endif
        </div>
        <div class="sm:flex sm:gap-4">

            <div class="hidden sm:block">
                <div class="flex gap-1">
                    @foreach ($buttons as $button)
                        <div class="flex gap-4">
                            <div class="border px-1 py-1 rounded-md flex gap-1 hover:bg-blue-600">
                                @switch($button->button_id)
                                    @case(1) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.mail class="h-6 w-6"/></a> @break
                                    @case(2) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.calender class="h-6 w-6"/></a> @break
                                    @case(3) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.chip class="h-6 w-6"/></a> @break
                                    @case(4) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.document class="h-6 w-6"/></a> @break

                                    @case(5) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.clock class="h-6 w-6"/></a> @break
                                    @case(6) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.folder class="h-6 w-6"/></a> @break
                                    @case(7) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.office class="h-6 w-6"/></a> @break
                                    @case(8) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.paperclip class="h-6 w-6"/></a> @break

                                    @case(9) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.phone class="h-6 w-6"/></a> @break
                                    @case(10) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.server class="h-6 w-6"/></a> @break
                                    @case(11) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.tools class="h-6 w-6"/></a> @break
                                    @case(12) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.credit-card class="h-6 w-6"/></a> @break
                                @endswitch
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


           <div class="mt-2 sm:mt-0">
               <button wire:click="openTodo" x-tooltip="Open todo - list/add" class="border px-1 py-1 rounded-md hover:bg-green-600">
                   <x-app.icons.check class="h-6 w-6"/>
               </button>

               @if ($settings->private)
                   <button wire:click="changePrivateStatus" x-tooltip="Show Regular" class="border px-1 py-1 rounded-md hover:bg-blue-600">
                       <x-app.icons.lock-open class="h-6 w-6"/>
                   </button>
               @else
                   <button wire:click="changePrivateStatus" x-tooltip="Show Private" class="border px-1 py-1 rounded-md hover:bg-blue-600">
                       <x-app.icons.lock class="h-6 w-6"/>
                   </button>
               @endif

               <button @click="slider = true" wire:click="set('typeOfSettings', 'regular')" x-tooltip="Settings - Buttons, cycles and so on" class="border px-1 py-1 rounded-md hover:bg-blue-600">
                   <x-app.icons.gear-1 class="h-6 w-6"/>
               </button>

               @if ($settings->access = 'admin')
                   <button @click="slider = true" wire:click="set('typeOfSettings', 'admin')" x-tooltip="Settings for Admin Settings" class="border px-1 py-1 rounded-md hover:bg-blue-600">
                       <x-app.icons.key class="h-6 w-6"/>
                   </button>
               @endif
           </div>

        </div>
    </div>

    <x-app.modal.slider data="slider" close="slider = false" >
        <x-slot name="title">
            @if ($typeOfSettings == 'regular') user - settings @elseif ($typeOfSettings == 'admin') admin - settings @endif
        </x-slot>
        <x-slot name="body">
            @if ($typeOfSettings == 'regular')
                <div>
                    @include('livewire.app.dashboard.widgets.settings.settings')
                </div>
            @elseif ($typeOfSettings == 'admin')
                @if ($settings->access = 'admin')
                    <div>
                        @include('livewire.app.dashboard.widgets.settings.admin-settings')
                    </div>
                @endif
            @endif
        </x-slot>
    </x-app.modal.slider>


    <div class="fixed inset-x-0 bottom-0 bg-gray-800 text-white p-4 sm:hidden border-t">
        <div class="flex justify-end gap-2">

            <div class="flex gap-1">
                @foreach ($buttons as $button)
                    <div class="flex gap-4">
                        <div class="border px-1 py-1 rounded-md flex gap-1 hover:bg-blue-600">
                            @switch($button->button_id)
                                @case(1) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.mail class="h-6 w-6"/></a> @break
                                @case(2) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.calender class="h-6 w-6"/></a> @break
                                @case(3) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.chip class="h-6 w-6"/></a> @break
                                @case(4) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.document class="h-6 w-6"/></a> @break

                                @case(5) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.clock class="h-6 w-6"/></a> @break
                                @case(6) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.folder class="h-6 w-6"/></a> @break
                                @case(7) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.office class="h-6 w-6"/></a> @break
                                @case(8) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.paperclip class="h-6 w-6"/></a> @break

                                @case(9) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.phone class="h-6 w-6"/></a> @break
                                @case(10) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.server class="h-6 w-6"/></a> @break
                                @case(11) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.tools class="h-6 w-6"/></a> @break
                                @case(12) <a href="{{$this->getLink($button->link_id)}}" target="_blank" x-tooltip="{{$this->getLinkName($button->link_id)}}"><x-app.icons.credit-card class="h-6 w-6"/></a> @break
                            @endswitch
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex gap-1">
                <div>
                    <button wire:click="openTodo" x-tooltip="Open todo - list/add" class="border px-1 py-1 rounded-md hover:bg-green-600">
                        <x-app.icons.check class="h-6 w-6"/>
                    </button>
                </div>

                <div>
                    @if ($settings->private)
                        <button wire:click="changePrivateStatus" x-tooltip="Show Regular" class="border px-1 py-1 rounded-md hover:bg-blue-600">
                            <x-app.icons.lock-open class="h-6 w-6"/>
                        </button>
                    @else
                        <button wire:click="changePrivateStatus" x-tooltip="Show Private" class="border px-1 py-1 rounded-md hover:bg-blue-600">
                            <x-app.icons.lock class="h-6 w-6"/>
                        </button>
                    @endif
                </div>
            </div>

        </div>
    </div>


</div>
