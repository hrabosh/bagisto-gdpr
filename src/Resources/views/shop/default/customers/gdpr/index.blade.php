<x-shop::layouts.account>
    <x-slot:title>
        @lang('shop::app.customer.account.profile.index.title')
    </x-slot:title>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="shop.customer.profile.gdpr" />
        @endSection
    @endif

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto max-md:mx-6 max-sm:mx-4">
        <div class="mb-8 flex items-center max-md:mb-5">
            <!-- Back Button -->
            <a
                class="grid md:hidden"
                href="{{ route('shop.customers.account.index') }}"
            >
                <span class="icon-arrow-left rtl:icon-arrow-right text-2xl"></span>
            </a>

            <h2 class="text-2xl font-medium max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0">
                @lang('gdpr::app.shop.customer-gdpr-data-request.heading')
            </h2>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-y-6 max-md:mt-5 max-sm:gap-y-4">
            <div class="grid w-full grid-cols-3 border-b border-zinc-200 py-3 max-md:px-0 items-center">
                <p class="text-lg dark:text-white">
                    @lang('gdpr::app.shop.customer-gdpr-data-request.request-data-access')
                </p>
                <p>
                    <a href="{{ route('gdpr.customers.pdfview', ['download'=>'pdf']) }}"
                       class="inline-flex secondary-button border-zinc-200 px-5 py-3 font-normal max-md:rounded-lg max-md:py-2 max-sm:py-1.5 max-sm:text-sm">
                        @lang('gdpr::app.shop.customer-gdpr-data-request.get-pdf')
                    </a>
                    <a href="{{ route('gdpr.customers.htmlview') }}"
                       target="_blank"
                       class="inline-flex secondary-button border-zinc-200 px-5 py-3 font-normal max-md:rounded-lg max-md:py-2 max-sm:py-1.5 max-sm:text-sm">
                        @lang('gdpr::app.shop.customer-gdpr-data-request.get-html')
                    </a>
                </p>
            </div>
        </div>

        <x-shop::form
            method="POST"
            :action="route('gdpr.customer.store')"
            enctype="multipart/form-data"
            onSubmit="return update_request_validate(event)"
            name="update_request_form"
        >
            <div class="mt-16 mb-8 grid grid-cols-1 gap-y-6 max-md:mt-5 max-sm:gap-y-4">
                <h3 class="mb-10 font-medium text-lg">
                    @lang('gdpr::app.shop.customer-gdpr-data-request.request-data-update')
                </h3>

                <input type="hidden" id="request_type" name="request_type" value="@lang('gdpr::app.shop.customer-gdpr-data-request.request-type-update')">

                <x-shop::form.control-group
                    class="!mb-0"
                >
                    @php $message = 'update_message'; @endphp

                    <x-shop::form.control-group.label class="required" :for="$message">
                        @lang('gdpr::app.shop.customer-gdpr-data-request.update-description')
                    </x-shop::form.control-group.label>

                    <x-admin::form.control-group.control
                        type="textarea"
                        :id="$message"
                        :name="$message"
                        rules="required"
                        value="{{ old($message) }}"
                        maxlength="500"
                    />

                    <x-shop::form.control-group.error :control-name="$message" />
                </x-shop::form.control-group>

                <div class="flex items-center gap-x-2.5">
                    <x-admin::button
                        type="submit"
                        class="secondary-button"
                        button-type="submit"
                        :title="trans('gdpr::app.shop.customer-gdpr-data-request.submit-request')"
                    />
                </div>
            </div>
        </x-shop::form>

        <x-shop::form
            method="POST"
            :action="route('gdpr.customer.store')"
            enctype="multipart/form-data"
            onSubmit="return delete_request_validate(event)"
            name="delete_request_form"
        >
            <div class="mt-16 mb-8 grid grid-cols-1 gap-y-6 max-md:mt-5 max-sm:gap-y-4">
                <h3 class="mb-10 font-medium text-lg">
                    @lang('gdpr::app.shop.customer-gdpr-data-request.request-to-delete-account')
                </h3>

                <input type="hidden" id="request_type" name="request_type" value="@lang('gdpr::app.shop.customer-gdpr-data-request.request-type-delete')">

                <x-shop::form.control-group
                    class="!mb-0"
                >
                    @php $message = 'delete_message'; @endphp

                    <x-shop::form.control-group.label class="required" :for="$message">
                        @lang('gdpr::app.shop.customer-gdpr-data-request.delete-reason')
                    </x-shop::form.control-group.label>

                    <x-admin::form.control-group.control
                        type="textarea"
                        :id="$message"
                        :name="$message"
                        rules="required"
                        value="{{ old($message) }}"
                        maxlength="500"
                    />

                    <x-shop::form.control-group.error :control-name="$message" />
                </x-shop::form.control-group>

                <div class="flex items-center gap-x-2.5">
                    <x-admin::button
                        type="submit"
                        class="secondary-button"
                        button-type="submit"
                        :title="trans('gdpr::app.shop.customer-gdpr-data-request.submit-request')"
                    />
                </div>
            </div>
        </x-shop::form>

        <div class="mt-16 grid grid-cols-1 max-md:mt-5">
            <h3 class="mb-10 font-medium text-lg">
                @lang('gdpr::app.shop.customer-gdpr-data-request.request-list')
            </h3>

            {!! view_render_event('customer.account.gdpr.list.before') !!}
            <x-shop::datagrid :src="route('gdpr.customers.allgdpr')"></x-shop::datagrid>
            {!! view_render_event('customer.account.gdpr.list.after') !!}
        </div>
    </div>
</x-shop::layouts>
