<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Config extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'flag_key',
        'flag_value'
    ];

    /**
     * Get a configuration value by key
     *
     * @param string $key
     * @return string|null
     */
    public static function getConfig(string $key)
    {
        $config = self::where('flag_key', $key)->first();
        return $config ? $config->flag_value : null;
    }

    /**
     * Set a configuration value
     *
     * @param string $key
     * @param string $value
     * @return bool
     */
    public static function setConfig(string $key, string $value)
    {
        return self::updateOrCreate(
            ['flag_key' => $key],
            ['flag_value' => $value]
        );
    }
}