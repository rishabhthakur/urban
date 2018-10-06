# Urban Laravel Ecommerce Package

Urban is a Laravel based CMS platform specifically designed for Ecommerce purposes.
It incorporates an elegantly designed admin and front end. Is fully customizable and easy to use.

The repository contains the Urban online shop package for Laravel 5.7*
integrating the Urban e-commerce library into Laravel. It comes preconfigured with shop theme and is ready
to be used out of the box. The package provides controllers for e.g. faceted filter, product lists and detail views,
for searching products as well as carts and the checkout process. A full set of
pages including routing is also available for a quick start.

[![Urban Laravel demo](https://Urban.org/fileadmin/user_upload/laravel-demo.jpg)](http://laravel.demo.Urban.org/)

## Table of content

- [Distribution](#distribution)
- [Important notice](#important-notice)
- [Installation/Update](#installation-or-update)
- [Setup](#setup)
- [Admin](#admin)
- [Hints](#hints)
- [License](#license)
- [Links](#links)

## Distribution

If you want to set up a new application or test Urban, we recommend the
[Urban distribution](https://github.com/Urban/Urban). It will install a
complete shop system including demo data for a quick start without the need
to follow the steps described in this readme.

## Important notice

If you use **Laravel 5.4+** and don't have the latest MySQL version installed, you
will probably get an error like `Specified key was too long; max key length is 767 bytes`.
To circumvent this problem, you should change the database charset/collation in your
`config/database.php` file **before the tables are created** to:

```php
'mysql' => [
    // ...
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    // ...
]
```

## Installation or update

This document is for the latest Urban Laravel **2018.10 release and later**.

- Stable release: 2018.07 (Laravel 5.6 to 5.7)
- LTS release: 2017.10 (Laravel 5.5 to 5.7)

If you want to **upgrade between major versions**, please have a look into the
[upgrade guide](https://Urban.org/docs/Laravel/Upgrade)!

The Urban Laravel web shop package is a composer based library that can be
installed easiest by using [Composer](https://getcomposer.org). First, you need
to **clone the master repository**:

```sh
git clone https://github.com/Thavarshan/urban.git
```

Make sure that the **database is set up and it is configured** in your
`config/database.php` or `.env` file (depending on the Laravel version). Sometimes,
the .env files are not available in the Laravel application and you will get exceptions
that the connection to the database failed. In that case, add the database credentials
to the **resource/db section of your ./config/shop.php** file too!

If you want to use a database server other than MySQL, please have a look into the article about
[supported database servers](https://Urban.org/docs/Developers/Library/Database_support)
and their specific configuration.

Afterwards, install the Urban shop package using

`composer update`

Next, Urban needs node packages.
simply run:

'npm install'

In the last step you must now execute these artisan commands to get a working
or updated Urban installation:

```
php artisan vendor:publish --all
php artisan migrate
php artisan db:seed
```

In a production environment or if you don't want that the demo data gets
installed, leave out the `php artisan db:seed` option. Although you may want
to run the command since the adin credentials are included in the seeder files.

## Setup

All component should be setup now including the public view.

You should clear the Laravel cache files. Otherwise, you might get
an exception due to old cached data.

```php artisan cache:clear```

Then, you should be able to call the catalog list page in your browser. For a
quick start, you can use the integrated web server that is available since PHP 5.4.
Simply execute this command in the base directory of your application:

```php artisan serve```

Point your browser to the shop page using:

http://127.0.0.1:8000/index.php/shop

**Note:** Integrating the Urban package adds some routes like `/api` or `/admin` to your
Laravel installation but the **home page stays untouched!**

**Caution:** CSRF protection is enabled by default but for the ```/confirm``` and ```/update```
routes, you may have to [disable CSRF](http://laravel.com/docs/5.1/routing#csrf-excluding-uris)
if one of the payment providers is sending data via POST requests.

## Admin

The e-mail address is the user name for login and the account will work for the
frontend too. To protect the new account, the command will ask you for a password.
The same command can create limited accounts by using "--editor" or "--api" instead of
"--admin". If you use "--super" the account will have access to all sites.

As a last step, you need to extend the `boot()` method of your
`App\Providers\AuthServiceProvider` class and add the lines to define how
authorization for "admin" is checked in `app/Providers/AuthServiceProvider.php`:

If your `./public` directory isn't writable by your web server, you have to create these
directories:

```
mkdir public/files public/preview public/uploads
chmod 777 public/files public/preview public/uploads
```

In a production environment, you should be more specific about the granted permissions!
If you've still started the internal PHP web server (`php artisan serve`)
you should now open this URL in your browser:

http://127.0.0.1:8000/index.php/admin

Enter the e-mail address and the password of the newly created user and press "Login".
If you don't get redirected to the admin interface (that depends on the authentication
code you've created according to the Laravel documentation), point your browser to the
`/admin` URL again.

To see your uploaded images, you have to adapt your `.env` file and set the `APP_URL`:

```APP_URL=http://127.0.0.1:8000```

**Caution:** Make sure that you aren't already logged in as a non-admin user! In this
case, login won't work because Laravel requires to log out first.

## License

The Urban Laravel ecommerce package is licensed under the terms of the MIT license and
is available for free.

<!-- * [Web site](https://Urban.org/Laravel)
* [Documentation](https://Urban.org/docs/Laravel)
* [Forum](https://Urban.org/help/laravel-package-f18/)
* [Issue tracker](https://github.com/Urban/Urban-laravel/issues)
* [Composer packages](https://packagist.org/packages/Urban/Urban-laravel)
* [Source code](https://github.com/Urban/Urban-laravel) -->
