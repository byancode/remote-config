<?php

if (!function_exists('remote_config')) {
    function remote_config($key = null, $default = null)
    {
        $manager = app('remote_config');

        if (is_null($key)) {
            return $manager;
        }

        if (is_array($key)) {
            return $manager->update($key);
        }

        return $manager->get($key, $default);
    }
}

if (!function_exists('array_flatten_keys')) {
    function array_flatten_keys(array $array, array $subs = [])
    {
        $result = [];
        foreach ($array as $key => $value) {
            $keys = empty($subs) ? $key : join('.', $subs) . '.' . $key;

            if (is_array($value) && !empty($value)) {
                // Evitamos crear un nuevo array para cada llamada recursiva
                if (empty($subs)) {
                    $result = array_merge($result, array_flatten_keys($value, [$key]));
                } else {
                    $newSubs = $subs;
                    $newSubs[] = $key;
                    $result = array_merge($result, array_flatten_keys($value, $newSubs));
                }
            } else {
                $result[$keys] = $value;
            }
        }
        return $result;
    }
}
