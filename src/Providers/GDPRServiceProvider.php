<?php

namespace Webkul\GDPR\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Webkul\GDPR\Console\Commands\Install;

class GDPRServiceProvider extends ServiceProvider
    {
        /**
        * Bootstrap services.
        *
        * @return void
        */
        public function boot(Router $router)
        {
            include __DIR__ . '/../Http/admin-routes.php';
            include __DIR__ . '/../Http/front-routes.php';

            $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'gdpr');
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'gdpr');
            $this->loadMigrationsFrom(__DIR__ .'/../Database/Migrations');
            $this->loadPublishableAssets();

            /* Breadcrumbs */
            require __DIR__.'/../Routes/breadcrumbs.php';

            $this->app->register(RepositoryServiceProvider::class);
            $this->app->register(EventServiceProvider::class);

            if ($this->app->runningInConsole()) {
                $this->commands([
                    Install::class,
                ]);
            }
        }

        /**
         * This method will load all publishables.
         *
         * @return boolean
         */
        public function loadPublishableAssets()
        {
        }

        /**
        * Register services.
        *
        * @return void
        */
        public function register()
        {
            $this->registerConfig();
        }

        /**
         * Register package config.
         *
         * @return void
         */
        protected function registerConfig()
        {
            $this->mergeConfigFrom(
                dirname(__DIR__) . '/Config/menu.php', 'menu.customer'
            );

            $this->mergeConfigFrom(
                dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
            );
        }
    }
