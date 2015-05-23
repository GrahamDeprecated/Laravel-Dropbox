<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Dropbox;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * This is the dropbox service provider class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/dropbox.php');

        $this->publishes([$source => config_path('dropbox.php')]);

        $this->mergeConfigFrom($source, 'dropbox');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('dropbox.factory', function ($app) {
            return new Factories\DropboxFactory();
        });

        $app->alias('dropbox.factory', 'GrahamCampbell\Dropbox\Factories\DropboxFactory');
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('dropbox', function ($app) {
            $config = $app['config'];
            $factory = $app['dropbox.factory'];

            return new DropboxManager($config, $factory);
        });

        $app->alias('dropbox', 'GrahamCampbell\Dropbox\DropboxManager');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'dropbox',
            'dropbox.factory',
        ];
    }
}
