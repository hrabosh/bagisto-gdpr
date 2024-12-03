<x-admin::layouts>
    <x-slot:title>
        @lang('gdpr::app.admin.title.index')
    </x-slot>

    <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            @lang('gdpr::app.admin.gdpr-tab.heading')
        </p>

        <div class="flex items-center gap-x-2.5">
            @if (bouncer()->hasPermission('admin.gdpr.settings.create'))
                <a href="{{ route('admin.gdpr.settings.create') }}" class="primary-button">
                    @lang('gdpr::app.admin.create-gdpr.create-btn-title')
                </a>
            @endif
        </div>
    </div>

    <x-admin::datagrid :src="route('admin.gdpr.settings.index')"></x-admin::datagrid>
</x-admin::layouts>
