Data Migrations for Laravel
===========================
This extension allows you to separate data migrations from structure migrations.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

With Composer installed, you can then install the extension using the following commands:

```bash
$ php composer.phar require jlorente/laravel-data-migrations "*"
```

or add 

```json
...
    "require": {
        // ... other configurations ...
        "jlorente/laravel-data-migrations": "*"
    }
```

to the ```require``` section of your `composer.json` file.

### Configuration

1. Register the ServiceProvider in your config/app.php service provider list. This step can be skipped in Laravel 5.5+

```php
\Jlorente\DataMigrations\DataMigrationsServiceProvider::class
```

2. Publish the new assets.
```shell
php artisan vendor:publish --tag=data-migrations
```

### Usage

You can use this package the same way as the regular migrations package. The data migrations will be stored in a different folder.

`make:data-migration` creates a new data migration. The firts time you use it the data migrations table will be created.

`migrate:data` runs the data migration

`migrate:rollback-data` rolls back the migration.

## License 
Copyright &copy; 2018 José Lorente Martín <jose.lorente.martin@gmail.com>.

Licensed under the MIT license. See LICENSE.txt for details.
