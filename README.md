# Laravel Remote Config

This package allows you to store configuration in a more persistent way. It uses the database to store your settings, and can save values in JSON format. You can also override Laravel's standard configuration.

## Requirements

- PHP 7.4 or higher
- Laravel 6.0 or higher (includes support for Laravel 11 and 12)

## Installation

### 1. Install

Run the following command:

```bash
composer require byancode/remote-config
```

### 2. Registration

#### For Laravel 6.0 - Laravel 10.x

Register the service provider in `config/app.php`

```php
Byancode\RemoteConfig\ServiceProvider::class,
```

Add the alias if you want to use the facade.

```php
'RemoteConfig' => Byancode\RemoteConfig\Facades\RemoteConfig::class,
```

#### For Laravel 11.x and later

In Laravel 11 and later versions, service providers are registered in the `bootstrap/providers.php` file:

```php
return [
    // Application service providers...
    Byancode\RemoteConfig\ServiceProvider::class,

    // Deferred service providers...
];
```

### 3. Publishing files

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Byancode\RemoteConfig\ServiceProvider"
```

### 4. Configuration

You can change your application options from the `config/remote_config.php` file

## Usage

You can use both the helper method `remote_config('foo')` and the facade `RemoteConfig::get('foo')`

### Facade

```php
# GETTER
RemoteConfig::get('foo');
RemoteConfig::get('foo.bar');
RemoteConfig::get('foo__bar');

# SETTER
RemoteConfig::set('foo', ['bar' => 'test']);
RemoteConfig::set('foo.bar', 'test');
```

### Helper

```php
$remoteConfig = remote_config();

# GETTER
remote_config('foo');
$remoteConfig->foo;
remote_config('foo.bar');
$remoteConfig->foo__bar;
$remoteConfig->get('foo.bar');

# SETTER
remote_config('foo', ['bar' => 'test']);
$remoteConfig->foo = ['bar' => 'test'];
$remoteConfig->foo__bar = 'test';
$remoteConfig->set('foo.bar', 'test');
```

### Blade Directive

You can get remote configuration directly in your blade templates using the helper method or the blade directive as `@remote_config('foo')`

## Laravel Version Compatibility

| Laravel Version   | Status           |
|-------------------|------------------|
| 6.x - 10.x        | Compatible       |
| 11.x - 12.x       | Compatible       |

## Troubleshooting Common Issues

### Configuration not available in some environments

If you find that your configurations are not available in certain environments, check that the migrations have been executed correctly:

```bash
php artisan migrate
```

### Conflicts with configuration cache

In some situations, it may be necessary to clear the configuration cache:

```bash
php artisan config:clear
```

## License

This package is open-source software licensed under the [MIT License](LICENSE.md).
