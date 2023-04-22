<?php
namespace App\Extensions\Jetstream;

use Laravel\Jetstream\Jetstream as JetstreamBase;

class Jetstream extends JetstreamBase
{

    public static function role(string $key, string $name, array $permissions, bool $assignable = true)
    {
        static::$permissions = collect(array_merge(static::$permissions, $permissions))
            ->unique()
            ->sort()
            ->values()
            ->all();

        return tap(new Role($key, $name, $permissions, $assignable), function ($role) use ($key) {
            static::$roles[$key] = $role;
        });
    }

}
