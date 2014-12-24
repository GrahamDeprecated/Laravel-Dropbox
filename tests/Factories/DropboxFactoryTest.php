<?php

/*
 * This file is part of Laravel Dropbox by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Tests\Dropbox\Factories;

use GrahamCampbell\Dropbox\Factories\DropboxFactory;
use GrahamCampbell\TestBench\AbstractTestCase;

/**
 * This is the dropbox factory test class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md> Apache 2.0
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
