<?php

namespace Webkul\GDPR\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('bagisto.shop.layout.head', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('gdpr::shop.default.layouts.style');
        });

        Event::listen('bagisto.shop.layout.body.after', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('gdpr::shop.default.layouts.index');
        });

        Event::listen('bagisto.shop.customers.signup_form.password_confirmation.after', function(\Webkul\Theme\ViewRenderEventManager $viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('gdpr::shop.components.sign-up');
        });

    }
}
