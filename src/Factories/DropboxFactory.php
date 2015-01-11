<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Dropbox\Factories;

use Dropbox\Client;

/**
 * This is the dropbox factory class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class DropboxFactory
{
    /**
     * Make a new dropbox client.
     *
     * @param string[] $config
     *
     * @return \Dropbox\Client
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return string[]
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('token', $config) || !array_key_exists('app', $config)) {
            throw new \InvalidArgumentException('The dropbox client requires authentication.');
        }

        return array_only($config, ['token', 'app']);
    }

    /**
     * Get the dropbox client.
     *
     * @param string[] $auth
     *
     * @return \Dropbox\Client
     */
    protected function getClient(array $auth)
    {
        return new Client($auth['token'], $auth['app']);
    }
}
