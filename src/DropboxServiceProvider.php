<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Dropbox;

use Dropbox\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * This is the dropbox service provider class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
        $this->setupConfig($this->app);
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = realpath(__DIR__.'/../config/dropbox.php');

        if (class_exists('Illuminate\Foundation\Application', false) && $app->runningInConsole()) {
            $this->publishes([$source => config_path('dropbox.php')]);
        } elseif (class_exists('Laravel\Lumen\Application', false)) {
            $app->configure('dropbox');
        }

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
        $this->registerBindings($this->app);
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
            return new DropboxFactory();
        });

        $app->alias('dropbox.factory', DropboxFactory::class);
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

        $app->alias('dropbox', DropboxManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->bind('dropbox.connection', function ($app) {
            $manager = $app['dropbox'];

            return $manager->connection();
        });

        $app->alias('dropbox.connection', Client::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'dropbox.factory',
            'dropbox',
            'dropbox.connection',
        ];
    }
}
