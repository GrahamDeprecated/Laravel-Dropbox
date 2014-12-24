<?php

/*
 * This file is part of Laravel Dropbox by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Dropbox;

use Illuminate\Support\ServiceProvider;

/**
 * This is the dropbox service provider class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md> Apache 2.0
 */
class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('graham-campbell/dropbox', 'graham-campbell/dropbox', __DIR__);
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
