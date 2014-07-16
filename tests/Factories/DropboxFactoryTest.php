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

namespace GrahamCampbell\Tests\Dropbox\Factories;

use Mockery;
use GrahamCampbell\TestBench\AbstractTestCase;
use GrahamCampbell\Dropbox\Factories\DropboxFactory;

/**
 * This is the dropbox factory test class.
 *
 * @package    Laravel-Dropbox
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Dropbox
 */
class DropboxFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getDropboxFactory();

        $return = $factory->make(array(
            'token'  => 'your-token',
            'app'    => 'your-app'
        ));

        $this->assertInstanceOf('Dropbox\Client', $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutToken()
    {
        $factory = $this->getDropboxFactory();

        $factory->make(array('app' => 'your-app'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSecret()
    {
        $factory = $this->getDropboxFactory();

        $factory->make(array('token' => 'your-token'));
    }

    protected function getDropboxFactory()
    {
        return new DropboxFactory();
    }
}
