@php
    $currentLocale = core()->getCurrentLocale();
    $gdpr = app('Webkul\GDPR\Repositories\GDPRRepository')->findOneWhere(['locale_id' => $currentLocale->id]);
@endphp

@if (! empty($gdpr->agreement_cms_page_id))
    @php
        $page = app('Webkul\CMS\Repositories\PageRepository')->find($gdpr->agreement_cms_page_id);
        $pageUrl = '#';
        if ($page->translate($currentLocale->code)) {
            $pageUrl = route('shop.cms.page', $page->translate($currentLocale->code)['url_key']);
        }
    @endphp

    @if ($gdpr->gdpr_status == 1 && $gdpr->customer_agreement_status == 1)
        <x-shop::form.control-group>
            <div class="flex select-none items-center gap-1.5">
                <x-shop::form.control-group.control
                    type="checkbox"
                    name="agreement"
                    rules="required"
                    id="gdpr_agreement"
                    for="gdpr_agreement"
                    value="1"
                    aria-required="true"
                />

                <label
                    class="cursor-pointer select-none text-base text-zinc-500 max-sm:text-sm ltr:pl-0 rtl:pr-0 required"
                    for="gdpr_agreement"
                >
                    {{ $gdpr->agreement_label }}
                    @if (! empty($gdpr->agreement_label_link_text))
                        <a href="{{ $pageUrl }}" target="_blank" class="underline">{{ $gdpr->agreement_label_link_text }}</a>
                    @endif
                </label>
            </div>
            <x-shop::form.control-group.error control-name="agreement" />
        </x-shop::form.control-group>
    @endif
@endif
