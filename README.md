Laravel Dropbox
===============

Laravel Dropbox was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a [Dropbox](https://github.com/dropbox/dropbox-sdk-php) bridge for [Laravel 5](http://laravel.com). It utilises my [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package. Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Dropbox/releases), [license](LICENSE), and [contribution guidelines](CONTRIBUTING.md).

![Laravel Dropbox](https://cloud.githubusercontent.com/assets/2829600/4432302/c13ca62a-468c-11e4-93d8-c64cec1b8748.PNG)

<p align="center">
<a href="https://styleci.io/repos/17052285"><img src="https://styleci.io/repos/17052285/shield" alt="StyleCI Status"></img></a>
<a href="https://travis-ci.org/GrahamCampbell/Laravel-Dropbox"><img src="https://img.shields.io/travis/GrahamCampbell/Laravel-Dropbox/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Dropbox/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Dropbox.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Dropbox"><img src="https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Dropbox.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/GrahamCampbell/Laravel-Dropbox/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Laravel-Dropbox.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

Either [PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.6+ are required.

To get the latest version of Laravel Dropbox, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require graham-campbell/dropbox
```

Instead, you may of course manually update your require block and run `composer update` if you so choose:

```json
{
    "require": {
        "graham-campbell/dropbox": "^3.0"
    }
}
```

Once Laravel Dropbox is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Dropbox\DropboxServiceProvider'`

You can register the Dropbox facade in the `aliases` key of your `config/app.php` file if you like.

* `'Dropbox' => 'GrahamCampbell\Dropbox\Facades\Dropbox'`


## Configuration

Laravel Dropbox requires connection configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/dropbox.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are two config options:

##### Default Connection Name

This option (`'default'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'main'`.

##### Dropbox Connections

This option (`'connections'`) is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.


## Usage

##### DropboxManager

This is the class of most interest. It is bound to the ioc container as `'dropbox'` and can be accessed using the `Facades\Dropbox` facade. This class implements the `ManagerInterface` by extending `AbstractManager`. The interface and abstract class are both part of my [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at [that repo](https://github.com/GrahamCampbell/Laravel-Manager#usage). Note that the connection class returned will always be an instance of `\Dropbox\Client`.

##### Facades\Dropbox

This facade will dynamically pass static method calls to the `'dropbox'` object in the ioc container which by default is the `DropboxManager` class.

##### DropboxServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### Real Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
use GrahamCampbell\Dropbox\Facades\Dropbox;
// you can alias this in config/app.php if you like

Dropbox::createFolder('foo');
// we're done here - how easy was that, it just works!

Dropbox::delete('foo');
// this example is simple, and there are far more methods available
```

The dropbox manager will behave like it is a `\Dropbox\Client` class. If you want to call specific connections, you can do with the `connection` method:

```php
use GrahamCampbell\Dropbox\Facades\Dropbox;

// the alternative connection is the other example provided in the default config
// let's create a copy ref so we can copy a file to the main connection
$ref = Dropbox::connection('alternative')->createCopyRef('foo');

// let's copy the file over to the other connection
// note that using the connection method here is optional
Dropbox::connection('main')->copyFromCopyRef($ref, 'bar');
```

With that in mind, note that:

```php
use GrahamCampbell\Dropbox\Facades\Dropbox;

// writing this:
Dropbox::connection('main')->createFolder('foo');

// is identical to writing this:
Dropbox::createFolder('foo');

// and is also identical to writing this:
Dropbox::connection()->createFolder('foo');

// this is because the main connection is configured to be the default
Dropbox::getDefaultConnection(); // this will return main

// we can change the default connection
Dropbox::setDefaultConnection('alternative'); // the default is now alternative
```

If you prefer to use dependency injection over facades like me, then you can easily inject the manager like so:

```php
use GrahamCampbell\Dropbox\DropboxManager;
use Illuminate\Support\Facades\App; // you probably have this aliased already

class Foo
{
    protected $dropbox;

    public function __construct(DropboxManager $dropbox)
    {
        $this->dropbox = $dropbox;
    }

    public function bar()
    {
        $this->dropbox->createFolder('foo');
    }
}

App::make('Foo')->bar();
```

For more information on how to use the `\Dropbox\Client` class we are calling behind the scenes here, check out the docs at http://dropbox.github.io/dropbox-sdk-php/api-docs/v1.1.x/source-class-Dropbox.Client.html, and the manager class at https://github.com/GrahamCampbell/Laravel-Manager#usage.

##### Further Information

There are other classes in this package that are not documented here. This is because they are not intended for public use and are used internally by this package.


## Security

If you discover a security vulnerability within this package, please send an e-mail to Graham Campbell at graham@alt-three.com. All security vulnerabilities will be promptly addressed.


## License

Laravel Dropbox is licensed under [The MIT License (MIT)](LICENSE).
