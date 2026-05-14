<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue(string $key, $default = null)
    {
        $setting = self::firstWhere('key', $key);
        return $setting ? $setting->value : $default;
    }

    public static function setValue(string $key, $value)
    {
        return self::updateOrCreate([
            'key' => $key,
        ], [
            'value' => $value,
        ]);
    }
}
