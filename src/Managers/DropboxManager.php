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

namespace GrahamCampbell\Dropbox\Managers;

use Illuminate\Config\Repository;
use GrahamCampbell\Dropbox\Connectors\ConnectionFactory;
use GrahamCampbell\Manager\Managers\AbstractManager;

/**
 * This is the dropbox manager class.
 *
 * @package    Laravel-Dropbox
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Dropbox
 */
class DropboxManager extends AbstractManager
{
    /**
     * The connection factory instance.
     *
     * @var \GrahamCampbell\Dropbox\Connectors\ConnectionFactory
     */
    protected $factory;

    /**
     * Create a new dropbox manager instance.
     *
     * @param  \Illuminate\Config\Repository   $config
     * @param  \GrahamCampbell\Dropbox\Connectors\ConnectionFactory  $factory
     * @return void
     */
    public function __construct(Repository $config, ConnectionFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param  array  $config
     * @return string
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
     * @return \GrahamCampbell\Dropbox\Connectors\ConnectionFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
