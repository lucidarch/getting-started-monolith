<?php

namespace App\Services\Kitchen\Providers;

use Lang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\Kitchen\Providers\RouteServiceProvider;
use App\Services\Kitchen\Providers\BroadcastServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class KitchenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/Kitchen/database/migrations
     * Now:
     * php artisan migrate
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom([
            realpath(__DIR__ . '/../database/migrations')
        ]);
    }

    /**
    * Register the Kitchen service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(BroadcastServiceProvider::class);

        $this->registerResources();
    }

    /**
     * Register the Kitchen service resource namespaces.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Translation must be registered ahead of adding lang namespaces
        $this->app->register(TranslationServiceProvider::class);

        Lang::addNamespace('kitchen', realpath(__DIR__.'/../resources/lang'));

        View::addNamespace('kitchen', base_path('resources/views/vendor/kitchen'));
        View::addNamespace('kitchen', realpath(__DIR__.'/../resources/views'));
    }
}
