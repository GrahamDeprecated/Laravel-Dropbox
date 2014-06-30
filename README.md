Laravel Dropbox
===============


[![Build Status](https://img.shields.io/travis/GrahamCampbell/Laravel-Dropbox/master.svg?style=flat)](https://travis-ci.org/GrahamCampbell/Laravel-Dropbox)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Dropbox.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Dropbox/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Dropbox.svg?style=flat)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Dropbox)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg?style=flat)](LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/GrahamCampbell/Laravel-Dropbox.svg?style=flat)](https://github.com/GrahamCampbell/Laravel-Dropbox/releases)


## Introduction

Laravel Dropbox was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a [Dropbox](https://github.com/dropbox/dropbox-sdk-php) bridge for [Laravel 4.1+](http://laravel.com). It utilises my [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Dropbox/releases), [license](LICENSE.md), [api docs](http://grahamcampbell.github.io/Laravel-Dropbox), and [contribution guidelines](CONTRIBUTING.md).


## Installation

[PHP](https://php.net) 5.4.7+ or [HHVM](http://hhvm.com) 3.1+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Dropbox, simply require `"graham-campbell/dropbox": "~1.0"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel Dropbox is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Dropbox\DropboxServiceProvider'`

You can register the Dropbox facade in the `aliases` key of your `app/config/app.php` file if you like.

* `'Dropbox' => 'GrahamCampbell\Dropbox\Facades\Dropbox'`


## Configuration

Laravel Dropbox requires connection configuration.

To get started, first publish the package config file:

    php artisan config:publish graham-campbell/dropbox

There are two config options:

**Default Connection Name**

This option (`'main'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'local'`.

**Dropbox Connections**

This option (`'connections'`) is where each of the connections are setup for your application. Examples of configuring each supported driver are included in the config file. You can of course have multiple connections per driver. This package only ships with one driver by default, but you may write your own drivers too.


## Usage

**Managers\DropboxManager**

This is the class of most interest. It is bound to the ioc container as `'dropbox'` and can be accessed using the `Facades\Dropbox` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of my [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package so you may want to go and checkout the docs for how to use the manager class over at [that repo](https://github.com/GrahamCampbell/Laravel-Manager#usage). Note that the connection class returned will always be an instance of `\Dropbox\Client`.

**Facades\Dropbox**

This facade will dynamically pass static method calls to the `'dropbox'` object in the ioc container which by default is the `Managers\DropboxManager` class.

**DropboxServiceProvider**

This class contains no public methods of interest. This class should be added to the providers array in `app/config/app.php`. This class will setup ioc bindings.

**Further Information**

There are other classes in this package that are not documented here. This is because they are not intended for public use and are used internally by this package.

Feel free to check out the [API Documentation](http://grahamcampbell.github.io/Laravel-Dropbox
) for Laravel Dropbox.


## License

Apache License

Copyright 2014 Graham Campbell

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
