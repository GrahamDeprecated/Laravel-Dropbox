<?php

/**
 * This file is part of Laravel Dropbox by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Dropbox;

use GrahamCampbell\Dropbox\Factories\DropboxFactory;
use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Config\Repository;

/**
 * This is the dropbox manager class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md> Apache 2.0
 */
class DropboxManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @type \GrahamCampbell\Dropbox\Factories\DropboxFactory
     */
    protected $factory;

    /**
     * Create a new dropbox manager instance.
     *
     * @param \Illuminate\Config\Repository                    $config
     * @param \GrahamCampbell\Dropbox\Factories\DropboxFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, DropboxFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Dropbox\Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'graham-campbell/dropbox';
    }

    /**
     * Get the factory instance.
     *
     * @return \GrahamCampbell\Dropbox\Factories\DropboxFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
