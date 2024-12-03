<html>
<head>
    <style>
        .hcol {
            color: #FF0000;
            text-decoration: underline;
            margin-bottom: 30px;
        }

        .td_width {
            width: 5%;
        }

        .heading {
            color: blue;
        }

        table td {
            padding: 5px;
        }
    </style>
</head>
<body style="background-image: none;background-color: #fff;">
<div class="container">
    <h1 class="hcol"> {{ __('gdpr::app.shop.pdf.default-store-view') }} </h1>
    <div class="invoice-summary">

        <div class="table address">
            <table>
                <caption style="text-align: left;"><h2>{{ __('gdpr::app.shop.pdf.account-information') }}</h2></caption>
                <tr>
                    <td>{{ __('gdpr::app.shop.pdf.first-name') }}:</td>
                    <td>
                        @if($param['customerInformation']->first_name)
                            <span>{{ $param['customerInformation']->first_name }}</span>
                        @else
                            <span>#NA</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('gdpr::app.shop.pdf.last-name') }}:</td>
                    <td>
                        @if($param['customerInformation']->last_name)
                            <span>{{ $param['customerInformation']->last_name }}</span>
                        @else
                            <span>#NA</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('gdpr::app.shop.pdf.email') }}:</td>
                    <td>
                        @if($param['customerInformation']->email)
                            <span>{{ $param['customerInformation']->email }}</span>
                        @else
                            <span>#NA</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('gdpr::app.shop.pdf.gender') }}:</td>
                    <td>
                        @if($param['customerInformation']->gender)
                            <span>{{ $param['customerInformation']->gender }}</span>
                        @else
                            <span>#NA</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('gdpr::app.shop.pdf.dob') }}:</td>
                    <td>
                        @if($param['customerInformation']->date_of_birth)
                            <span>{{ $param['customerInformation']->date_of_birth }}</span>
                        @else
                            <span>#NA</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('gdpr::app.shop.pdf.phone') }}:</td>
                    <td>
                        @if($param['customerInformation']->phone)
                            <span>{{ $param['customerInformation']->phone }}</span>
                        @else
                            <span>#NA</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        @if(!empty($param['address']))
            <h2> {{ __('gdpr::app.shop.pdf.address-information') }} </h2>
            <div class="table address">
                @foreach($param['address'] as $params)
                    <br>
                    <div>
                        <div class="heading">
                            {{ __('gdpr::app.shop.pdf.address') }} - {{$params->id}}
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.city') }}</label>
                            @if($params->city)
                                <span>{{ $params->city }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.company') }}</label>
                            @if($params->company_name)
                                <span>{{ $params->company_name }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.country') }}</label>
                            @if($params->country)
                                <span>{{ core()->country_name($params->country) }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.first-name') }}</label>
                            @if($params->first_name)
                                <span>{{ $params->first_name }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.last-name') }}</label>
                            @if($params->last_name)
                                <span>{{ $params->last_name }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.phone') }}</label>
                            @if($params->phone)
                                <span>{{ $params->phone }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                    </div><br>
                @endforeach
            </div>
        @endif

        @if(!empty($param['order']))
            <h2>{{ __('gdpr::app.shop.pdf.order-information') }}</h2>
            <div class="table address">
                @foreach($param['order'] as $params)
                    <br>
                    <div>
                        <div class="heading" align="left">
                            {{ __('gdpr::app.shop.pdf.order') }} - {{$params->id}}
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.order-id') }}</label>
                            @if($params->id)
                                <span>{{ $params->id }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.status') }}</label>
                            @if($params->status)
                                <span>{{ $params->status }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.shipping') }}</label>
                            @if($params->shipping_title)
                                <span>{{ $params->shipping_title }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.customer-first-name') }}</label>
                            @if($params->customer_first_name)
                                <span>{{ $params->customer_first_name }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.customer-last-name') }}</label>
                            @if($params->customer_last_name)
                                <span>{{ $params->customer_last_name }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.customer-company-name') }}</label>
                            @if($params->company_name)
                                <span>{{ $params->company_name }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.order-quantity') }}</label>
                            @if($params->total_qty_ordered)
                                <span>{{ $params->total_qty_ordered }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                        <div>
                            <label>{{ __('gdpr::app.shop.pdf.order-amount') }}</label>
                            @if($params->grand_total)
                                <span>{{ $params->grand_total }}</span>
                            @else
                                <span>#NA</span>
                            @endif
                        </div>
                    </div><br>
                @endforeach
            </div>
        @endif
    </div>
</div>
</body>
</html>
