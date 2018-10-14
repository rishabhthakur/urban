# Urban Laravel Ecommerce Package

Urban is a Laravel based CMS platform specifically designed for Ecommerce purposes.
It incorporates an elegantly designed admin and front end. Is fully customizable and easy to use.

## Distribution

If you want to set up a new application or test Urban, we recommend the
[Urban distribution](https://github.com/Urban/Urban). It will install a
complete shop system including demo data for a quick start without the need
to follow the steps described in this readme.

The Urban web application is a Laravel application so ti install it
you simply clone the repository **clone the master repository**:

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

## Admin

The e-mail address is the username for login and the account will work for the
frontend too.

**Default admin login credentials**
`Username: admin@urban.com`
`Password: secret`


As a last step, you need to extend the `boot()` method of your
`App\Providers\AuthServiceProvider` class and add the lines to define how
authorization for "admin" is checked in `app/Providers/AuthServiceProvider.php`:

If your `./public` directory isn't writable by your web server, you have to create these
directories:

```
mkdir public/uploads
chmod 777 public/uploads
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
