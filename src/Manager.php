<?php

namespace Byancode\RemoteConfig;

use Byancode\RemoteConfig\Model;
use Illuminate\Support\Facades\Cache;

class Manager
{
    protected $cacheKey;
    protected $cacheStore;

    public function __construct()
    {
        $driver = config('remote_config.cache.driver', 'file');
        $this->cacheKey = config('remote_config.cache.key', 'app.remote_config');
        $this->cacheStore = Cache::driver($driver);
    }

    public function load()
    {
        try {
            return Model::get()->mapWithKeys(function ($item) {
                return [$item['key'] => $item['value']];
            })->all();
        } catch (\Throwable $th) {
            \Log::error('RemoteConfig: Error loading settings', ['exception' => $th]);
            return null;
        }
    }

    public function all()
    {
        return $this->cacheStore->get($this->cacheKey) ?? $this->sync();
    }

    public function update(array $data, bool $override = true)
    {
        foreach ($data as $key => $value) {
            $this->set($key, $value, $override);
        }
    }

    public function get(string $key = '*', $default = null)
    {
        $key = str_replace('__', '.', $key);
        return \data_get($this->all(), $key) ?? \config($key) ?? $default;
    }

    public function set(string $keys, $data, bool $override = true): bool
    {
        $keys = str_replace('__', '.', $keys);
        $key = explode('.', $keys)[0];
        # -------------------------
        $settings = $this->all();
        # -------------------------
        \data_set($settings, $keys, $data, $override);
        \config([$keys => $data]);
        # -------------------------
        $value = json_encode($settings[$key]);
        # -------------------------
        $this->cacheStore->forever($this->cacheKey, $settings);
        # -------------------------
        try {
            Model::getQuery()->updateOrInsert(
                compact('key'),
                compact('value')
            );
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function sync()
    {
        try {
            $settings = $this->load();
            # ------------------------
            if (is_null($settings)) {
                return [];
            }
            # ------------------------
            \config(array_flatten_keys($settings));
            # ------------------------
            $this->cacheStore->forever($this->cacheKey, $settings);

            return $settings;
        } catch (\Throwable $th) {
            \Log::error('RemoteConfig: Error synchronizing settings', [
                'exception' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()
            ]);
            return [];
        }
    }

    public function push(string $key, $value): bool
    {
        $data = $this->get($key);
        # -----------------------
        if (!\is_array($data)) {
            $data = [];
        }
        # -----------------------
        $data[] = $value;
        # -----------------------
        return $this->set($key, $data);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        return $this->set($name, $value);
    }
}
