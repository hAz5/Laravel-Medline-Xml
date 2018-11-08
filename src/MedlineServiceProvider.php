<?php

namespace Tresa02\Medline;

use Illuminate\Support\ServiceProvider;
use PhpParser\Node\Scalar\MagicConst\Dir;

class MedlineServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/View', 'medline');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->publishes([
            __DIR__ . '/config/medline.php' => config_path('medline.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
