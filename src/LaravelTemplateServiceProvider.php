<?php

namespace Axstarzy\LaravelTemplate;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

use Collective\Html\HtmlServiceProvider;
use Intervention\Image\ImageServiceProvider;

class LaravelTemplateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();

        // laravelcollective/html
        $this->app->register(Collective\Html\HtmlServiceProvider::class);
        $loader->alias('Form', '\Collective\Html\FormFacade');
        $loader->alias('Html', '\Collective\Html\HtmlFacade');

        // intervention/image
        $this->app->register(Intervention\Image\ImageServiceProvider::class);
        $loader->alias('Image', '\Intervention\Image\Facades\Image');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
