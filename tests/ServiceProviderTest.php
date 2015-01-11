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

use GrahamCampbell\TestBench\Traits\ServiceProviderTestCaseTrait;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTestCaseTrait;

    public function testDropboxFactoryIsInjectable()
    {
        $this->assertIsInjectable('GrahamCampbell\Dropbox\Factories\DropboxFactory');
    }

    public function testDropboxManagerIsInjectable()
    {
        $this->assertIsInjectable('GrahamCampbell\Dropbox\DropboxManager');
    }
}
