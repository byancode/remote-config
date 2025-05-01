# Laravel Remote Config

This package allows you to save the configuration in a more persistent way. Use the database to save your settings, you can save values in json format. You can also override the Laravel configuration.

## Getting Started

### 1. Install

Run the following command:

```bash
composer require byancode/remote-config
```

### 2. Register (for Laravel > 6.0)

Register the service provider in `config/app.php`

```php
Byancode\RemoteConfig\Provider::class,
```

Add alias if you want to use the facade.

```php
'RemoteConfig' => Byancode\RemoteConfig\Facade::class,
```

### 3. Publish

Publish config file.

```bash
php artisan vendor:publish --provider="Byancode\RemoteConfig\Provider"
```


### 4. Configure

You can change the options of your app from `config/remote_config.php` file

## Usage

You can either use the helper method like `remote_config('foo')` or the facade `RemoteConfig::get('foo')`

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

You can get the remote_config directly in your blade templates using the helper method or the blade directive like `@remote_config('foo')`
