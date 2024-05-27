<div x-data="{
            buttonSettings: false,
            adminSettings: false,
            notes: false,
            todoPrivate: false,
            prioPrivate: false,
            private: @entangle('private'),
            }" class="pb-24">

    <livewire:app.top.top-display :title="'Dashboard'"/>

    <livewire:app.dashboard.widgets.settings-widget />

    @if ($settings->dash_link)
        <livewire:app.dashboard.widgets.link-widget />
    @endif

    <livewire:app.dashboard.widgets.todo-widget />

</div>
