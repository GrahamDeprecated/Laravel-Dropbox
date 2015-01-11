<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Dropbox\Factories;

use GrahamCampbell\Dropbox\Factories\DropboxFactory;
use GrahamCampbell\TestBench\AbstractTestCase;

/**
 * This is the dropbox factory test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class DropboxFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getDropboxFactory();

        $return = $factory->make([
            'token'  => 'your-token',
            'app'    => 'your-app',
        ]);

        $this->assertInstanceOf('Dropbox\Client', $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutToken()
    {
        $factory = $this->getDropboxFactory();

        $factory->make(['app' => 'your-app']);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSecret()
    {
        $factory = $this->getDropboxFactory();

        $factory->make(['token' => 'your-token']);
    }

    protected function getDropboxFactory()
    {
        return new DropboxFactory();
    }
}
