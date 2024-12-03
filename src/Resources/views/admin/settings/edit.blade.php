<x-admin::layouts>
    <x-slot:title>
        @lang('gdpr::app.admin.title.index')
    </x-slot>

    <x-admin::form
        v-slot="{ meta, errors, handleSubmit }"
        as="div"
    >
        <form
            method="POST"
            enctype="multipart/form-data"
            action="{{ route('admin.gdpr.settings.store', ['id' => $gdprData->id ?? 'new']) }}"
        >
            @csrf

            <div class="grid gap-2.5 mb-4">
                <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
                    <div class="grid gap-1.5">
                        <p class="text-xl font-bold leading-6 text-gray-800 dark:text-white">
                            @lang('gdpr::app.admin.gdpr-tab.heading')
                        </p>
                    </div>

                    <div class="flex items-center gap-x-2.5">
                        <x-admin::button
                            type="submit"
                            class="primary-button"
                            button-type="submit"
                            :title="trans('gdpr::app.admin.create-gdpr.update-gdpr-data')"
                        />
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <x-admin::accordion>
                    <x-slot:header>
                        <p class="p-[10px] text-gray-600 dark:text-gray-300 text-[16px] font-semibold">
                            @lang('gdpr::app.admin.create-gdpr.general')
                        </p>
                    </x-slot:header>

                    <x-slot:content>
                        <x-admin::form.control-group>
                            @php $channelID = 'channel_id'; @endphp
                            <x-admin::form.control-group.label :for="$channelID" class="required">
                                @lang('gdpr::app.admin.settings.fields.channel-code')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="select"
                                :id="$channelID"
                                :name="$channelID"
                                value="{{ old($channelID, $gdprData->$channelID ?? '') }}"
                                rules="required"
                            >
                                @foreach (core()->getAllChannels() as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                @endforeach
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error :control-name="$channelID"/>
                            @if ($errors->has($channelID))
                                <p class="mt-1 text-xs italic text-red-600">{{ $errors->first($channelID) }}</p>
                            @endif
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $localeID = 'locale_id'; @endphp
                            <x-admin::form.control-group.label :for="$localeID" class="required">
                                @lang('gdpr::app.admin.settings.fields.locale-code')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="select"
                                :id="$localeID"
                                :name="$localeID"
                                value="{{ old($localeID, $gdprData->$localeID ?? '') }}"
                                rules="required"
                            >
                                @foreach (core()->getAllLocales() as $locale)
                                    <option value="{{ $locale->id }}">{{ $locale->name }} ({{ $locale->code }})</option>
                                @endforeach
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error :control-name="$localeID"/>
                            @if ($errors->has($localeID))
                                <p class="mt-1 text-xs italic text-red-600">{{ $errors->first($localeID) }}</p>
                            @endif
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $enabledGdpr = 'enabled_gdpr'; @endphp
                            <x-admin::form.control-group.label :for="$enabledGdpr">
                                @lang('gdpr::app.admin.create-gdpr.enabled-gdpr')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="switch"
                                :id="$enabledGdpr"
                                :name="$enabledGdpr"
                                value="on"
                                :checked="(boolean) old($enabledGdpr, $gdprData->gdpr_status ?? false)"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$enabledGdpr"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>
                    </x-slot:content>
                </x-admin::accordion>

                <x-admin::accordion>
                    <x-slot:header>
                        <p class="p-[10px] text-gray-600 dark:text-gray-300 text-[16px] font-semibold">
                            @lang('gdpr::app.admin.create-gdpr.customer-agreement')
                        </p>
                    </x-slot:header>

                    <x-slot:content>
                        <x-admin::form.control-group>
                            @php $customerAgreement = 'customer_agreement'; @endphp
                            <x-admin::form.control-group.label :for="$customerAgreement">
                                @lang('gdpr::app.admin.create-gdpr.enabled-customer-data-agreement')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="switch"
                                :id="$customerAgreement"
                                :name="$customerAgreement"
                                value="on"
                                :checked="(boolean) old($customerAgreement, $gdprData->customer_agreement_status ?? false)"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$customerAgreement"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $agreementLabel = 'agreement_label'; @endphp
                            <x-admin::form.control-group.label :for="$agreementLabel">
                                @lang('gdpr::app.admin.create-gdpr.agreement-checkbox-label')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                style="width: 25% !important"
                                type="text"
                                :id="$agreementLabel"
                                :name="$agreementLabel"
                                value="{{ old($agreementLabel, $gdprData->agreement_label ?? '') }}"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$agreementLabel"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $agreementLabelLinkText = 'agreement_label_link_text'; @endphp
                            <x-admin::form.control-group.label :for="$agreementLabelLinkText">
                                @lang('gdpr::app.admin.create-gdpr.agreement-checkbox-link-label')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                style="width: 25% !important"
                                type="text"
                                :id="$agreementLabelLinkText"
                                :name="$agreementLabelLinkText"
                                value="{{ old($agreementLabelLinkText, $gdprData->agreement_label_link_text ?? '') }}"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$agreementLabelLinkText"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $termsAndConditionPage = 'agreement_cms_page_id'; @endphp
                            <x-admin::form.control-group.label :for="$termsAndConditionPage">
                                @lang('gdpr::app.admin.create-gdpr.agreement-cms-page')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="select"
                                :id="$termsAndConditionPage"
                                :name="$termsAndConditionPage"
                                value="{{ old($termsAndConditionPage, $gdprData->agreement_cms_page_id ?? '') }}"
                            >
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}">{{ $page->page_title }}</option>
                                @endforeach
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error
                                :control-name="$termsAndConditionPage"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>
                    </x-slot:content>
                </x-admin::accordion>

                <x-admin::accordion>
                    <x-slot:header>
                        <p class="p-[10px] text-gray-600 dark:text-gray-300 text-[16px] font-semibold">
                            @lang('gdpr::app.admin.create-gdpr.cookie-message-settings')
                        </p>
                    </x-slot:header>

                    <x-slot:content>
                        <x-admin::form.control-group>
                            @php $enabledCookieNotice = 'enabled_cookie_notice'; @endphp
                            <x-admin::form.control-group.label :for="$enabledCookieNotice">
                                @lang('gdpr::app.admin.create-gdpr.enabled-cookie-notice')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="switch"
                                :id="$enabledCookieNotice"
                                :name="$enabledCookieNotice"
                                value="on"
                                :checked="(boolean) (old($enabledCookieNotice, $gdprData->cookie_status ?? false))"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$enabledCookieNotice"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $cookieBlockPosition = 'cookie_block_position'; @endphp
                            <x-admin::form.control-group.label :for="$cookieBlockPosition">
                                @lang('gdpr::app.admin.create-gdpr.cookie-block-display-position')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="select"
                                :id="$cookieBlockPosition"
                                :name="$cookieBlockPosition"
                                value="{{ old($cookieBlockPosition, $gdprData->cookie_block_position ?? '') }}"
                            >
                                <option value="bottom-right">Bottom Right</option>
                                <option value="bottom-left">Bottom Left</option>
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error
                                :control-name="$cookieBlockPosition"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $cookieStaticBlockIdentifier = 'cookie_static_block_identifier'; @endphp
                            <x-admin::form.control-group.label :for="$cookieStaticBlockIdentifier">
                                @lang('gdpr::app.admin.create-gdpr.cookie-static-block-identifier')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                :id="$cookieStaticBlockIdentifier"
                                :name="$cookieStaticBlockIdentifier"
                                value="{{ old($cookieStaticBlockIdentifier, $gdprData->cookie_static_block_identifier ?? '') }}"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$cookieStaticBlockIdentifier"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>
                    </x-slot:content>
                </x-admin::accordion>

                <x-admin::accordion>
                    <x-slot:header>
                        <p class="p-[10px] text-gray-600 dark:text-gray-300 text-[16px] font-semibold">
                            @lang('gdpr::app.shop.customer.cookie.your-cookie-consent-preferences')
                        </p>
                    </x-slot:header>

                    <x-slot:content>
                        <x-admin::form.control-group>
                            @php $strictlyNecessaryCookie = 'strictly_necessary_cookie'; @endphp
                            <x-admin::form.control-group.label :for="$strictlyNecessaryCookie">
                                @lang('gdpr::app.shop.customer.cookie.strictly-necessary')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                :id="$strictlyNecessaryCookie"
                                :name="$strictlyNecessaryCookie"
                                value="{{ old($strictlyNecessaryCookie, $gdprData->strictly_necessary_cookie ?? '') }}"
                                :tinymce="true"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$strictlyNecessaryCookie"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $basicInteractionsAndFunctionalitiesCookie = 'basic_interactions_and_functionalities_cookie'; @endphp
                            <x-admin::form.control-group.label :for="$basicInteractionsAndFunctionalitiesCookie">
                                @lang('gdpr::app.shop.customer.cookie.basic-interactions-and-functionalities')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                :id="$basicInteractionsAndFunctionalitiesCookie"
                                :name="$basicInteractionsAndFunctionalitiesCookie"
                                value="{{ old($basicInteractionsAndFunctionalitiesCookie, $gdprData->basic_interactions_and_functionalities_cookie ?? '') }}"
                                :tinymce="true"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$basicInteractionsAndFunctionalitiesCookie"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $experienceEnhancementCookie = 'experience_enhancement_cookie'; @endphp
                            <x-admin::form.control-group.label :for="$experienceEnhancementCookie">
                                @lang('gdpr::app.shop.customer.cookie.experience-enhancement')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                :id="$experienceEnhancementCookie"
                                :name="$experienceEnhancementCookie"
                                value="{{ old($experienceEnhancementCookie, $gdprData->experience_enhancement_cookie ?? '') }}"
                                :tinymce="true"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$experienceEnhancementCookie"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $measurementCookie = 'measurement_cookie'; @endphp
                            <x-admin::form.control-group.label :for="$measurementCookie">
                                @lang('gdpr::app.shop.customer.cookie.measurement')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                :id="$measurementCookie"
                                :name="$measurementCookie"
                                value="{{ old($measurementCookie, $gdprData->measurement_cookie ?? '') }}"
                                :tinymce="true"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$measurementCookie"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            @php $targetingAndAdvertisingCookie = 'targeting_and_advertising_cookie'; @endphp
                            <x-admin::form.control-group.label :for="$targetingAndAdvertisingCookie">
                                @lang('gdpr::app.shop.customer.cookie.targeting-and-advertising')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                :id="$targetingAndAdvertisingCookie"
                                :name="$targetingAndAdvertisingCookie"
                                value="{{ old($targetingAndAdvertisingCookie, $gdprData->targeting_and_advertising_cookie ?? '') }}"
                                :tinymce="true"
                            />

                            <x-admin::form.control-group.error
                                :control-name="$targetingAndAdvertisingCookie"></x-admin::form.control-group.error>
                        </x-admin::form.control-group>
                    </x-slot:content>
                </x-admin::accordion>
            </div>
        </form>
    </x-admin::form>
</x-admin::layouts>
