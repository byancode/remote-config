# Laravel Remote Config

Este paquete le permite guardar la configuración de manera más persistente. Utiliza la base de datos para almacenar sus ajustes, y puede guardar valores en formato JSON. También puede sobrescribir la configuración estándar de Laravel.

## Requisitos

- PHP 7.4 o superior
- Laravel 6.0 o superior (incluye soporte para Laravel 11 y 12)

## Instalación

### 1. Instalar

Ejecute el siguiente comando:

```bash
composer require byancode/remote-config
```

### 2. Registro

#### Para Laravel 6.0 - Laravel 10.x

Registre el proveedor de servicios en `config/app.php`

```php
Byancode\RemoteConfig\ServiceProvider::class,
```

Agregue el alias si desea utilizar la fachada (facade).

```php
'RemoteConfig' => Byancode\RemoteConfig\Facades\RemoteConfig::class,
```

#### Para Laravel 11.x y posteriores

En Laravel 11 y versiones posteriores, los proveedores de servicios se registran en el archivo `bootstrap/providers.php`:

```php
return [
    // Proveedores de servicios de aplicación...
    Byancode\RemoteConfig\ServiceProvider::class,

    // Proveedores de servicios diferidos...
];
```

Para registrar el alias de la fachada, debe hacerlo en el archivo `config/app.php`:

```php
'aliases' => [
    // ...
    'RemoteConfig' => Byancode\RemoteConfig\Facades\RemoteConfig::class,
],
```

### 3. Publicación de archivos

Publique el archivo de configuración:

```bash
php artisan vendor:publish --provider="Byancode\RemoteConfig\ServiceProvider"
```

### 4. Configuración

Puede cambiar las opciones de su aplicación desde el archivo `config/remote_config.php`

## Uso

Puede utilizar tanto el método helper `remote_config('foo')` como la fachada `RemoteConfig::get('foo')`

### Fachada (Facade)

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

### Directiva Blade

Puede obtener la configuración remota directamente en sus plantillas blade utilizando el método helper o la directiva blade como `@remote_config('foo')`

## Compatibilidad con versiones de Laravel

| Versión de Laravel | Estado            |
|--------------------|-------------------|
| 6.x - 10.x         | Compatible        |
| 11.x - 12.x        | Compatible        |

## Solución de problemas comunes

### Configuración no disponible en algunos entornos

Si encuentra que sus configuraciones no están disponibles en ciertos entornos, verifique que las migraciones se hayan ejecutado correctamente:

```bash
php artisan migrate
```

### Conflictos con cache de configuración

En algunas situaciones, puede ser necesario limpiar la cache de configuración:

```bash
php artisan config:clear
```

## Licencia

Este paquete es software de código abierto licenciado bajo la [Licencia MIT](LICENSE.md).
