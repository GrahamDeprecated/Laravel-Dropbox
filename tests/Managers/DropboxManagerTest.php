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

namespace GrahamCampbell\Tests\Dropbox\Managers;

use Mockery;
use GrahamCampbell\Dropbox\Managers\DropboxManager;
use GrahamCampbell\TestBench\Classes\AbstractTestCase;

/**
 * This is the dropbox manager test class.
 *
 * @package    Laravel-Dropbox
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Dropbox
 */
class DropboxManagerTest extends AbstractTestCase
{
    public function testConnectionName()
    {
        $config = array('driver' => 'dropbox', 'token' => 'your-token', 'app' => 'your-app');

        $manager = $this->getConfigManager($config);

        $this->assertEquals($manager->getConnections(), array());

        $return = $manager->connection('dropbox');

        $this->assertInstanceOf('Dropbox\Client', $return);

        $this->assertArrayHasKey('dropbox', $manager->getConnections());

        $return = $manager->reconnect('dropbox');

        $this->assertInstanceOf('Dropbox\Client', $return);

        $this->assertArrayHasKey('dropbox', $manager->getConnections());

        $manager = $this->getDropboxManager();

        $manager->disconnect('dropbox');

        $this->assertEquals($manager->getConnections(), array());
    }

    public function testConnectionNull()
    {
        $config = array('driver' => 'dropox', 'path' => __DIR__);

        $manager = $this->getConfigManager($config);

        $manager->getConfig()->shouldReceive('get')->twice()
            ->with('graham-campbell/dropbox::default')->andReturn('dropbox');

        $this->assertEquals($manager->getConnections(), array());

        $return = $manager->connection();

        $this->assertInstanceOf('Dropbox\Client', $return);

        $this->assertArrayHasKey('dropbox', $manager->getConnections());

        $return = $manager->reconnect();

        $this->assertInstanceOf('Dropbox\Client', $return);

        $this->assertArrayHasKey('dropbox', $manager->getConnections());

        $manager = $this->getDropboxManager();

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('graham-campbell/dropbox::default')->andReturn('dropbox');

        $manager->disconnect();

        $this->assertEquals($manager->getConnections(), array());
    }

    public function testConnectionError()
    {
        $manager = $this->getDropboxManager();

        $config = array('driver' => 'error', 'path' => __DIR__);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('graham-campbell/dropbox::connections')->andReturn(array('dropbox' => $config));

        $this->assertEquals($manager->getConnections(), array());

        $return = null;

        try {
            $manager->connection('error');
        } catch (\Exception $e) {
            $return = $e;
        }

        $this->assertInstanceOf('InvalidArgumentException', $return);
    }

    public function testGetDefaultConnection()
    {
        $manager = $this->getDropboxManager();

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('graham-campbell/dropbox::default')->andReturn('dropbox');

        $return = $manager->getDefaultConnection();

        $this->assertEquals($return, 'dropbox');
    }

    public function testSetDefaultConnection()
    {
        $manager = $this->getDropboxManager();

        $manager->getConfig()->shouldReceive('set')->once()
            ->with('graham-campbell/dropbox::default', 'dropbox');

        $manager->setDefaultConnection('dropbox');
    }

    public function testExtend()
    {
        $manager = $this->getDropboxManager();

        $manager->extend('test', 'foo');
    }

    protected function getDropboxManager()
    {
        $config = Mockery::mock('Illuminate\Config\Repository');
        $factory = Mockery::mock('GrahamCampbell\Dropbox\Connectors\ConnectionFactory');

        return new DropboxManager($config, $factory);
    }

    protected function getConfigManager(array $config)
    {
        $manager = $this->getDropboxManager();

        $manager->getConfig()->shouldReceive('get')->twice()
            ->with('graham-campbell/dropbox::connections')->andReturn(array('dropbox' => $config));

        $manager->getFactory()->shouldReceive('make')->twice()
            ->with($config, 'dropbox')->andReturn(Mockery::mock('Dropbox\Client'));

        return $manager;
    }
}
