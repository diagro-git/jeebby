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


    public function __construct(
        public string $type
    )
    {
        $this->props = new Collection();
    }

    public static function factory(array $data): static
    {
        $node = new static($data['type']);
        $props = new Collection((new ReflectionClass($node))->getProperties(ReflectionProperty::IS_PUBLIC));
        unset($data['type']);
        $props->reject(fn(ReflectionProperty $property) => $property->name === 'type');

        foreach($data as $k => $v) {
            /** @var ReflectionProperty $prop */
            if(($prop = $props->first(fn(ReflectionProperty $property) => $property->name == $k)) !== null) {
                if($prop->getType()->getName() == Collection::class && is_array($v)) {
                    $node->{$k} = new Collection($v);
                } elseif($prop->getType()->getName() == 'int') {
                    $node->{$k} =  intval($v);
                } else {
                    $node->{$k} = $v;
                }
            } else {
                $node->props->put($k, $v);
            }
        }

        $node->afterFactory();
        return $node;
    }

    public function toArray(): array
    {
        $data = $this->props->toArray();
        $props = (new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach($props as $prop) {
            if($prop->getType() == Collection::class) {
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
