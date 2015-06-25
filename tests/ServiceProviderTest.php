<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Dropbox;

use Dropbox\Client;
use GrahamCampbell\Dropbox\DropboxFactory;
use GrahamCampbell\Dropbox\DropboxManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testDropboxFactoryIsInjectable()
    {
        $this->assertIsInjectable(DropboxFactory::class);
    }

    public function testDropboxManagerIsInjectable()
    {
        $this->assertIsInjectable(DropboxManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);

        $original = $this->app['dropbox.connection'];
        $this->app['dropbox']->reconnect();
        $new = $this->app['dropbox.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
