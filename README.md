Laravel Dropbox
===============


[![Build Status](https://img.shields.io/travis/GrahamCampbell/Laravel-Dropbox/master.svg)](https://travis-ci.org/GrahamCampbell/Laravel-Dropbox)
[![Coverage Status](https://img.shields.io/coveralls/GrahamCampbell/Laravel-Dropbox/master.svg)](https://coveralls.io/r/GrahamCampbell/Laravel-Dropbox)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg)](https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/GrahamCampbell/Laravel-Dropbox.svg)](https://github.com/GrahamCampbell/Laravel-Dropbox/releases)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Dropbox/badges/quality-score.png?s=a42157dd56c672f37e56f6b9f64b64b2457abca0)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Dropbox)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/251da8bb-97f6-473e-a4b5-8998cc4bf5c6/mini.png)](https://insight.sensiolabs.com/projects/251da8bb-97f6-473e-a4b5-8998cc4bf5c6)


## What Is Laravel Dropbox?

Laravel Dropbox is a [Dropbox](https://github.com/dropbox/dropbox-sdk-php) bridge for [Laravel 4.1+](http://laravel.com).

* Laravel Dropbox was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).
* Laravel Dropbox relies on the [Dropbox SDK for PHP](https://github.com/dropbox/dropbox-sdk-php) and my [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package.
* Laravel Dropbox uses [Travis CI](https://travis-ci.org/GrahamCampbell/Laravel-Dropbox) with [Coveralls](https://coveralls.io/r/GrahamCampbell/Laravel-Dropbox) to check everything is working.
* Laravel Dropbox uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Dropbox) and [SensioLabsInsight](https://insight.sensiolabs.com/projects/251da8bb-97f6-473e-a4b5-8998cc4bf5c6) to run additional checks.
* Laravel Dropbox uses [Composer](https://getcomposer.org) to load and manage dependencies.
* Laravel Dropbox provides a [change log](https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Dropbox/releases), and [api docs](http://grahamcampbell.github.io/Laravel-Dropbox).
* Laravel Dropbox is licensed under the Apache License, available [here](https://github.com/GrahamCampbell/Laravel-Dropbox/blob/master/LICENSE.md).


## System Requirements

* PHP 5.4.7+ or HHVM 3.1+.
* You will need [Laravel 4.1+](http://laravel.com) because this package is designed for it.
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Laravel Dropbox.


## Installation

Please check the system requirements before installing Laravel Dropbox.

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

This option (`'default'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'local'`.

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


## Updating Your Fork

Before submitting a pull request, you should ensure that your fork is up to date.

You may fork Laravel Dropbox:

    git remote add upstream git://github.com/GrahamCampbell/Laravel-Dropbox.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).

You can then update the branch:

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.


## Pull Requests

Please review these guidelines before submitting any pull requests.

* When submitting bug fixes, check if a maintenance branch exists for an older series, then pull against that older branch if the bug is present in it.
* Before sending a pull request for a new feature, you should first create an issue with [Proposal] in the title.
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).


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
