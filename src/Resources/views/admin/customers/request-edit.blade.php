<x-admin::layouts>
    <x-slot:title>
        @lang('gdpr::app.admin.title.edit')
    </x-slot:title>

    <form method="POST" action="{{ route('admin.gdpr.update') }}">
        <input type="hidden" name="id" value="{{ $data['id'] }}">
        @csrf()

        <div class="grid gap-2.5 my-4">
            <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
                <div class="grid gap-1.5">
                    <p class="text-xl font-bold leading-6 text-gray-800 dark:text-white">
                        @lang('gdpr::app.admin.title.edit-heading') #{{ $data['id'] }} from customer {{ $data['customer_id'] }}
                    </p>
                </div>

                <div class="flex items-center gap-x-2.5">
                    <x-admin::button
                        type="submit"
                        class="primary-button"
                        button-type="submit"
                        :title="trans('gdpr::app.admin.create-gdpr.save-btn')"
                    />
                </div>
            </div>
        </div>

        <div class="page-content">
            <x-admin::accordion>
                <x-slot:header>
                    <p class="p-[10px] text-gray-600 dark:text-gray-300 text-[16px] font-semibold">
                        @lang('gdpr::app.admin.create-gdpr.general-data-request')
                    </p>
                </x-slot:header>

                <x-slot:content>
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            @lang('gdpr::app.shop.customer-index-field.request-status')
                        </x-admin::form.control-group.label>

                        @php $requestStatus = 'request_status'; @endphp
                        <x-admin::form.control-group.control
                            type="select"
                            :id="$requestStatus"
                            :name="$requestStatus"
                            rules="required"
                            value="{{ old($requestStatus, $data[$requestStatus] ?? '') }}"
                        >
                            @php $requestStatusOptions = ['Pending', 'Processing', 'Declined', 'Complete']; @endphp
                            @foreach($requestStatusOptions as $statusVal)
                                <option value="{{ $statusVal }}">
                                    {{ $statusVal }}
                                </option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error :control-name="$requestStatus"></x-admin::form.control-group.error>
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            @lang('gdpr::app.shop.customer-index-field.request-type')
                        </x-admin::form.control-group.label>

                        @php $requestType = 'request_type'; @endphp
                        <x-admin::form.control-group.control
                            type="select"
                            :id="$requestType"
                            :name="$requestType"
                            rules="required"
                            value="{{ old($requestType, $data[$requestType] ?? '') }}"
                        >
                            @php $requestTypeOptions = ['Update', 'Delete']; @endphp
                            @foreach($requestTypeOptions as $statusVal)
                                <option value="{{ $statusVal }}">
                                    {{ $statusVal }}
                                </option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error :control-name="$requestType"></x-admin::form.control-group.error>
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            @lang('gdpr::app.shop.customer-index-field.message')
                        </x-admin::form.control-group.label>

                        @php $message = 'message'; @endphp
                        <x-admin::form.control-group.control
                            type="textarea"
                            :id="$message"
                            :name="$message"
                            rules="required"
                            value="{{ old($message, $data[$message] ?? '') }}"
                            maxlength="500"
                        />

                        <x-admin::form.control-group.error :control-name="$message" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
{{--                            @lang('gdpr::app.admin.create-gdpr.enabled-gdpr')--}}
                            Send a email to the customer
                        </x-admin::form.control-group.label>

                        @php $sentEmail = 'sent_email'; @endphp
                        <x-admin::form.control-group.control
                            type="switch"
                            :id="$sentEmail"
                            :name="$sentEmail"
                            value="1"
                            :checked="false"
                        />

                        <x-admin::form.control-group.error :control-name="$sentEmail"></x-admin::form.control-group.error>
                    </x-admin::form.control-group>
                </x-slot:content>
            </x-admin::accordion>
        </div>
    </form>
</x-admin::layouts>
