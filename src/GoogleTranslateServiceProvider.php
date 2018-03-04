<?php

namespace Akib\Translate;

use Akib\Translate\GoogleTranslate;
use Illuminate\Support\ServiceProvider;

class GoogleTranslateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('akib-translate', function()
        {
            return new GoogleTranslate();
        });
    }
}
