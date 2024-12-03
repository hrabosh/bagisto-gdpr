<div class="main-container-wrapper">
    @php
        $gdpr = app('Webkul\GDPR\Repositories\GDPRRepository')->first();

        try {
    @endphp

    @if($gdpr && $gdpr->gdpr_status == 1 && $gdpr->cookie_status == 1)
        @include('gdpr::cookie.index')
    @endif

    @php
        } catch(\Exception $e) {}
    @endphp
</div>
