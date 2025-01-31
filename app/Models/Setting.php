<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'key';
    protected $keyType = 'string';
    protected $fillable = ['key', 'value'];

        // Cache key for storing settings in memory
        protected static $cacheKey = 'app_settings';

        /**
         * Load all settings from the cache or database.
         *
         * @return array
         */
        public static function loadAll()
        {
            return Cache::rememberForever(self::$cacheKey, function () {
                return self::pluck('value', 'key')->toArray();
            });
        }

        /**
         * Get a setting value with a default fallback.
         *
         * @param string $key
         * @param mixed $default
         * @return mixed
         */
        public static function get($key, $default = null)
        {
            $settings = self::loadAll();
            return $settings[$key] ?? $default;
        }

        /**
         * Save multiple settings at once and update cache.
         *
         * @param array $settings
         */
        public static function saveAll(array $settings)
        {
            foreach ($settings as $key => $value) {
                self::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            // Refresh the cache
            self::clearCache();
            self::loadAll();
        }

        /**
         * Clear settings cache manually.
         */
        public static function clearCache()
        {
            Cache::forget(self::$cacheKey);
        }
}
