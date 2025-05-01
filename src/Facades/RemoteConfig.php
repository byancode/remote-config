<?php

namespace Byancode\RemoteConfig\Facades;

use Illuminate\Support\Facades\Facade;

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
