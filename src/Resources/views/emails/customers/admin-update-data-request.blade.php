@component('shop::emails.layout')
    <div style="padding: 30px;">
        <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
            <span style="font-weight: bold;">
                @lang('gdpr::app.mail.new-data-request.heading')
            </span> <br>
        </div>

        <div style="flex-direction: row;margin-top: 20px;justify-content: space-between;margin-bottom: 20px;">
            <div style="margin-bottom: 20px;">
                <div style="font-weight: bold;font-size: 16px;color: #242424">
                    @lang('gdpr::app.mail.new-data-request.request-status'):
                </div>
                <div>
                    {{ $adminUpdateRequest['request_status'] }}
                </div>
            </div>

            <div>
                <div style="font-weight: bold;font-size: 16px;color: #242424;">
                    @lang('gdpr::app.mail.new-data-request.message'):
                </div>
                <div style="font-size: 16px; color: #242424;">
                    {{ $adminUpdateRequest['message'] }}
                </div>
            </div>
        </div>

        <div style="margin-top: 40px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: block; width: 100%;">
            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                @lang('gdpr::app.mail.new-data-request.thank-you')
            </p>
        </div>
    </div>
@endcomponent
