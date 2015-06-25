<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Dropbox\Facades;

use GrahamCampbell\Dropbox\DropboxManager;
use GrahamCampbell\Dropbox\Facades\Dropbox;
use GrahamCampbell\TestBenchCore\FacadeTrait;
use GrahamCampbell\Tests\Dropbox\AbstractTestCase;

/**
 * This is the dropbox facade test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class DropboxTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'dropbox';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Dropbox::class;
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return DropboxManager::class;
    }
}
