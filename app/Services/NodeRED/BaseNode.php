<?php
namespace App\Services\NodeRED;

use App\Services\NodeRED\Traits\WithNodeID;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionProperty;

abstract class BaseNode
{

    use WithNodeID;


    protected Collection $props;

    public string $id;

    public string $type;


    public function __construct()
    {
        $this->props = new Collection();
    }

    public static function factory(array $data): static
    {
        $obj = new static();
        $props = new Collection((new ReflectionClass($obj))->getProperties(ReflectionProperty::IS_PUBLIC));
        foreach($data as $k => $v) {
            /** @var ReflectionProperty $prop */
            if(($prop = $props->first(fn(ReflectionProperty $property) => $property->name == $k)) !== null) {
                if($prop->getType()->getName() == 'Collection' && is_array($v)) {
                    $obj->{$k} = new Collection($v);
                } elseif($prop->getType()->getName() == 'int') {
                    $obj->{$k} =  intval($v);
                } else {
                    $obj->{$k} = $v;
                }
            } else {
                $obj->props->put($k, $v);
            }
        }

        $obj->afterFactory();
        return $obj;
    }

    public function toArray(): array
    {
        $data = $this->props->toArray();
        $props = (new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach($props as $prop) {
            if($prop->getType() == 'Collection') {
                $data[$prop->name] = $prop->getValue()->toArray();
            } else {
                $data[$prop->name] = $prop->getValue();
            }
        }
        return $data;
    }

    protected function afterFactory()
    {}

}
