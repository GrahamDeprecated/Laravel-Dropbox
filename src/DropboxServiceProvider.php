<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Dropbox;

use Orchestra\Support\Providers\ServiceProvider;

/**
 * This is the dropbox service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
        $this->addConfigComponent('graham-campbell/dropbox', 'graham-campbell/dropbox', realpath(__DIR__.'/../config'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('dropbox.factory', function ($app) {
            return new Factories\DropboxFactory();
        });

        $this->app->alias('dropbox.factory', 'GrahamCampbell\Dropbox\Factories\DropboxFactory');
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('dropbox', function ($app) {
            $config = $app['config'];
            $factory = $app['dropbox.factory'];

            return new DropboxManager($config, $factory);
        });

        $this->app->alias('dropbox', 'GrahamCampbell\Dropbox\DropboxManager');
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
