<?php

namespace Byancode\RemoteConfig\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class RemoteConfig extends BaseModel
{
    public $timestamps = false;

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
