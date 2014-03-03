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

namespace GrahamCampbell\Dropbox\Connectors;

/**
 * This is the connection factory class.
 *
 * @package    Laravel-Dropbox
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Dropbox
 */
class ConnectionFactory
{
    /**
     * Establish a connection based on the configuration.
     *
     * @param  array   $config
     * @param  string  $name
     * @return mixed
     */
    public function make(array $config, $name)
    {
        $config = $this->parseConfig($config, $name);

        return $this->createConnector($config)->connect($config);
    }

    /**
     * Parse and prepare the adapter configuration.
     *
     * @param  array   $config
     * @param  string  $name
     * @return mixed
     */
    protected function parseConfig(array $config, $name)
    {
        return array_add($config, 'name', $name);
    }

    /**
     * Create a connector instance based on the configuration.
     *
     * @param  array  $config
     * @return \GrahamCampbell\Dropbox\Connectors\ConnectorInterface
     */
    public function createConnector(array $config)
    {
        if (!isset($config['driver'])) {
            throw new \InvalidArgumentException("A driver must be specified.");
        }

        switch ($config['driver']) {
            case 'dropbox':
                return new DropboxConnector();
        }

        throw new \InvalidArgumentException("Unsupported driver [{$config['driver']}]");
    }
}
