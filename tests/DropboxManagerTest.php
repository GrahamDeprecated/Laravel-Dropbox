<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Dropbox;

use Dropbox\Client;
use GrahamCampbell\Dropbox\DropboxFactory;
use GrahamCampbell\Dropbox\DropboxManager;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;

/**
 * This is the dropbox manager test class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class DropboxManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('dropbox.default')->andReturn('dropbox');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf('Dropbox\Client', $return);

        $this->assertArrayHasKey('dropbox', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(DropboxFactory::class);

        $manager = new DropboxManager($repo, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('dropbox.connections')->andReturn(['dropbox' => $config]);

        $config['name'] = 'dropbox';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));

        return $manager;
    }
}
