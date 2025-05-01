<?php

namespace Byancode\RemoteConfig\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array load() Loads configurations from the database
 * @method static array all() Gets all configurations from cache or synchronizes if not available
 * @method static void update(array $data, bool $override = true) Updates multiple configurations at once
 * @method static mixed get(string $key = '*', mixed $default = null) Gets a configuration value by its key
 * @method static bool set(string $keys, mixed $data, bool $override = true) Sets a configuration value by its key
 * @method static array sync() Synchronizes configurations with the database and updates the cache
 * @method static bool push(string $key, mixed $value) Adds a value to a configuration array
 *
 * @see \Byancode\RemoteConfig\RemoteConfigManager
 */
class RemoteConfig extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'remote_config';
    }
}
