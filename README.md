# Laravel Trait Command

A laravel artisan command to generate trait quickly.

## Install

In your `config/app.php` file, add the following to the providers array:

```php
Rukhsar\TraitCommand\TraitCommandServiceProvider::class,
```

## Usage

Once installed, you should see `make:trait` as one of the artisan commands when you run:

```
php artisan list
```

To use this command, supply it with two arguments, the first is the name of the trait, and the second is the name of the folder you want it to reside in. If the folder does not exist, it will be created for you. If you leave second argument empty, trait will be created under `app/`

For example:

php artisan make:trait ModelTrait Traits

This would create a directory named Traits in your app directory with a php file named ModelTrait.php.

