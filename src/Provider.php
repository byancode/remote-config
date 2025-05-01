<?php

namespace Byancode\RemoteConfig;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $timestamp = date('Y_m_d_His', time());

        $this->publishes([
            __DIR__ . '/../migrations/create_remote_config_table.php' => database_path("/migrations/{$timestamp}_create_remote_config_table.php"),
            __DIR__ . '/../config/' => base_path('/config'),
        ], 'remote_config');

        $this->app->singleton('remote_config', function () {
            return new Manager();
        });

        $this->app->booted(function () {
            app('remote_config')->sync();
        });

        Blade::directive('remote_config', function ($expression) {
            return "<?php echo remote_config($expression); ?>";
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/remote_config.php',
            'remote_config'
        );
    }
}
