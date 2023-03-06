<?php

namespace Tahiryasin\Reports\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class ReportsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'reports');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'reports');

//        Event::listen('bagisto.admin.layout.head', function ($viewRenderEventManager) {
//            $viewRenderEventManager->addTemplate('reports::admin.layouts.style');
//        });
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
            dirname(__DIR__) . '/Config/menu.php', 'menu.admin'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/acl.php', 'acl'
        );

    }
}