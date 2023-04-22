<?php
namespace App\Extensions\Jetstream;

use Laravel\Jetstream\Role as RoleBase;

class Role extends RoleBase
{

    public bool $assignable = true;

    public function __construct(string $key, string $name, array $permissions, bool $assignable = true)
    {
        parent::__construct($key, $name, $permissions);
        $this->assignable = $assignable;
    }

    public function jsonSerialize() : array
    {
        $json =  parent::jsonSerialize();
        $json['assignable'] = $this->assignable;
        return $json;
    }

}
