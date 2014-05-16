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
    public function testCreateConnection()
    {
        $config = array('driver' => 'dropox', 'path' => __DIR__);

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('graham-campbell/dropbox::default')->andReturn('dropbox');

        $this->assertEquals($manager->getConnections(), array());

        $return = $manager->connection();

        $this->assertInstanceOf('Dropbox\Client', $return);

        $this->assertArrayHasKey('dropbox', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repo = Mockery::mock('Illuminate\Config\Repository');
        $factory = Mockery::mock('GrahamCampbell\Dropbox\Connectors\ConnectionFactory');

        $manager = new DropboxManager($repo, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('graham-campbell/dropbox::connections')->andReturn(array('dropbox' => $config));

        $config['name'] = 'dropbox';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock('Dropbox\Client'));

        return $manager;
    }
}
