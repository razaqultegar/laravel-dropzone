<?php

namespace RazaqulTegar\Dropzone\Providers;

use Illuminate\Support\ServiceProvider;
use RazaqulTegar\Dropzone\Dropzone;

class DropzoneServiceProvider extends ServiceProvider
{
    /**
     * Register services into the container.
     */
    public function register(): void
    {
        // Merge package configuration with application's copy
        $this->mergeConfigFrom(__DIR__ . '/../../config/dropzone.php', 'dropzone');

        // Register Dropzone service singleton
        $this->app->singleton('dropzone', function ($app) {
            return new Dropzone();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish resources when running artisan vendor:publish
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/dropzone.php' => config_path('dropzone.php'),
            ], ['dropzone', 'dropzone-config']);

            $this->publishes([
                __DIR__ . '/../../database/migrations/create_dropzones_table.php' =>
                    database_path('migrations/' . date('Y_m_d_His') . '_create_dropzones_table.php'),
            ], ['dropzone', 'dropzone-migrations']);
        }
    }
}
