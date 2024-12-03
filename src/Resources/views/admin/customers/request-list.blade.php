<x-admin::layouts>
    <x-slot:title>
        @lang('gdpr::app.admin.title.data-request')
    </x-slot:title>

    <div class="flex gap-[16px] justify-between max-sm:flex-wrap">
        <p class="py-[11px] text-[20px] text-gray-800 dark:text-white font-bold">
            <!-- Section Title -->
            @lang('gdpr::app.admin.gdpr-tab.data-request-heading')
        </p>
    </div>

    <x-admin::datagrid :src="route('admin.gdpr.dataRequest')"></x-admin::datagrid>
</x-admin::layouts>
