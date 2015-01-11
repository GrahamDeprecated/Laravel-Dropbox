<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Dropbox;

use GrahamCampbell\Dropbox\DropboxManager;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Mockery;

/**
 * This is the dropbox manager test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class DropboxManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('graham-campbell/dropbox::default')->andReturn('dropbox');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf('Dropbox\Client', $return);

        $this->assertArrayHasKey('dropbox', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repo = Mockery::mock('Illuminate\Contracts\Config\Repository');
        $factory = Mockery::mock('GrahamCampbell\Dropbox\Factories\DropboxFactory');

        $manager = new DropboxManager($repo, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('graham-campbell/dropbox::connections')->andReturn(['dropbox' => $config]);

        $config['name'] = 'dropbox';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock('Dropbox\Client'));

        return $manager;
    }
}
