@component('shop::emails.layout')
    <div style="padding-bottom: 30px;">
        <div style="font-size: 25px;color: #242424;line-height: 30px;">
            <span style="font-weight: bold;">
                @lang('gdpr::app.mail.new-data-request.heading')
            </span>
        </div>
    </div>

    <div style="flex-direction: row;margin-top: 20px;justify-content: space-between;margin-bottom: 20px;">
        <div style="font-weight: bold;font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 20px !important;">
            @lang('gdpr::app.mail.new-data-request.summary'):
        </div>

        <div style="line-height: 25px;">
            <table style="font-weight: bold;font-size: 16px;color: #242424;">
                <tr>
                    <td style="padding: 5px;border: 1px solid #e9e9e9;">@lang('gdpr::app.mail.new-data-request.request-status'):</td>
                    <td style="padding: 5px;border: 1px solid #e9e9e9;">{{ $dataRequest['request_status'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px;border: 1px solid #e9e9e9;">@lang('gdpr::app.mail.new-data-request.request-type'):</td>
                    <td style="padding: 5px;border: 1px solid #e9e9e9;">{{ $dataRequest['request_type'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px;border: 1px solid #e9e9e9;">@lang('gdpr::app.mail.new-data-request.message'):</td>
                    <td style="padding: 5px;border: 1px solid #e9e9e9;">{{ $dataRequest['message'] }}</td>
                </tr>
            </table>
        </div>
    </div>
@endcomponent
