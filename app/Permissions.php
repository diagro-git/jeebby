<?php
namespace App;

use Closure;

final class Permissions
{

    /**
     * Storage permissions
     */
    const STORAGE_READ      = 'storage:read';
    const STORAGE_WRITE     = 'storage:write';
    const STORAGE_DELETE    = 'storage:delete';

    /**
     * Monitor permissions
     */
    const MONITOR_READ      = 'monitor:read';
    const MONITOR_WRITE     = 'monitor:write';

    /**
     * Flow permissions
     */
    const FLOW_INSTALL      = 'flow:install';


    /**
     * Get all the permissions.
     * With a given closure, you filter them out.
     *
     * @param Closure|null $closure
     * @return array
     */
    public static function getAllPermissions(closure $closure = null): array
    {
        $class = new \ReflectionClass(__CLASS__);
        $permissions = tap($class->getConstants(), function(array $permissions) use ($closure) {
            return $closure ? $closure($permissions) : $permissions;
        });

        return array_values($permissions);
    }

}
