<?php

namespace Byancode\RemoteConfig;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public $timestamps = false;

    protected $table = 'remote_configs';

    protected $fillable = [
        'key',
        'value'
    ];

    protected $casts = [
        'value' => 'string',
    ];

    function getValueAttribute($value) {
        return \json_decode($value, true) ?? $value;
    }

    function setValueAttribute($value) {
        $this->attributes['value'] = \json_encode($value);
    }
}
