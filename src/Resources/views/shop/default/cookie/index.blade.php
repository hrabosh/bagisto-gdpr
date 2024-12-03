@push('scripts')
    <script>
        function getCustomizeCookie()
        {
            const strictly_necessary = document.getElementById("strictly_necessary_cookie").checked;
            const basic_interactions_and_functionalities = document.getElementById("basic_interactions_and_functionalities_cookie").checked;
            const experience_enhancement = document.getElementById("experience_enhancement_cookie").checked;
            const measurement_cookie = document.getElementById("measurement_cookie").checked;
            const targeting_and_advertising = document.getElementById("targeting_and_advertising_cookie").checked;

            window.location = '{{ url('/') }}';
        }
    </script>
@endpush
@php
    $gdpr = app('Webkul\GDPR\Repositories\GDPRRepository')->first();
@endphp
<x-shop::layouts
    :has-header="true"
    :has-feature="true"
    :has-footer="true"
>
    <x-slot:title>
        @lang('gdpr::app.shop.customer.cookie.your-cookie-consent-preferences')
    </x-slot:title>

    <div class="container mt-[34px] px-[60px] max-lg:px-8 max-md:mt-4 max-md:px-4 max-md:text-sm max-sm:text-xs section-gap">
        <div class="flex justify-between items-center mb-7">
            <h2 class="text-3xl max-md:text-2xl max-sm:text-xl dark:text-white font-semibold text-slate-900 mb-9">
                @lang('gdpr::app.shop.customer.cookie.your-cookie-consent-preferences')
            </h2>
        </div>

        <div class="max-w-lg mx-auto">
            <details class="open:bg-white dark:open:bg-slate-900 open:ring-1 open:ring-black/5 dark:open:ring-white/10 open:shadow-lg p-4 rounded-lg" open>
                <summary class="leading-6 text-slate-900 dark:text-white font-semibold select-none">
                    @lang('gdpr::app.shop.customer.cookie.strictly-necessary')
                </summary>
                <div class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-400">
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input type="checkbox" id="strictly_necessary_cookie" name="strictly_necessary_cookie" checked="checked" disabled="disabled" class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div>
                            <label for="strictly_necessary_cookie" class="text-gray-900">{{ $gdpr->strictly_necessary_cookie }}</label>
                        </div>
                    </div>
                </div>
            </details>
        </div>

        <div class="max-w-lg mx-auto">
            <details class="open:bg-white dark:open:bg-slate-900 open:ring-1 open:ring-black/5 dark:open:ring-white/10 open:shadow-lg p-4 rounded-lg" open>
                <summary class="leading-6 text-slate-900 dark:text-white font-semibold select-none">
                    @lang('gdpr::app.shop.customer.cookie.basic-interactions-and-functionalities')
                </summary>
                <div class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-400">
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input type="checkbox" id="basic_interactions_and_functionalities_cookie" name="basic_interactions_and_functionalities_cookie" checked class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div>
                            <label for="basic_interactions_and_functionalities_cookie" class="text-gray-900">{{ $gdpr->basic_interactions_and_functionalities_cookie }}</label>
                        </div>
                    </div>
                </div>
            </details>
        </div>

        <div class="max-w-lg mx-auto">
            <details class="open:bg-white dark:open:bg-slate-900 open:ring-1 open:ring-black/5 dark:open:ring-white/10 open:shadow-lg p-4 rounded-lg" open>
                <summary class="leading-6 text-slate-900 dark:text-white font-semibold select-none">
                    @lang('gdpr::app.shop.customer.cookie.experience-enhancement')
                </summary>
                <div class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-400">
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input type="checkbox" id="experience_enhancement_cookie" name="experience_enhancement_cookie" checked class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div>
                            <label for="experience_enhancement_cookie" class="text-gray-900">{{ $gdpr->experience_enhancement_cookie }}</label>
                        </div>
                    </div>
                </div>
            </details>
        </div>

        <div class="max-w-lg mx-auto">
            <details class="open:bg-white dark:open:bg-slate-900 open:ring-1 open:ring-black/5 dark:open:ring-white/10 open:shadow-lg p-4 rounded-lg" open>
                <summary class="leading-6 text-slate-900 dark:text-white font-semibold select-none">
                    @lang('gdpr::app.shop.customer.cookie.measurement')
                </summary>
                <div class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-400">
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input type="checkbox" id="measurement_cookie" name="measurement_cookie" checked class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div>
                            <label for="measurement_cookie" class="text-gray-900">{{ $gdpr->measurement_cookie }}</label>
                        </div>
                    </div>
                </div>
            </details>
        </div>

        <div class="max-w-lg mx-auto">
            <details class="open:bg-white dark:open:bg-slate-900 open:ring-1 open:ring-black/5 dark:open:ring-white/10 open:shadow-lg p-4 rounded-lg" open>
                <summary class="leading-6 text-slate-900 dark:text-white font-semibold select-none">
                    @lang('gdpr::app.shop.customer.cookie.targeting-and-advertising')
                </summary>
                <div class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-400">
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input type="checkbox" id="targeting_and_advertising_cookie" name="targeting_and_advertising_cookie" checked class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div>
                            <label for="targeting_and_advertising_cookie" class="text-gray-900">{{ $gdpr->targeting_and_advertising_cookie }}</label>
                        </div>
                    </div>
                </div>
            </details>
        </div>

        <div class="flex justify-center items-center my-4">
            <button type="submit" class="primary-button" onclick="getCustomizeCookie();">
                @lang('gdpr::app.shop.customer.cookie.save-and-continue')
            </button>
        </div>
    </div>
</x-shop::layouts>

