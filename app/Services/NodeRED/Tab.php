<?php
namespace App\Services\NodeRED;

use App\Services\NodeRED\Traits\WithNodeID;
use Illuminate\Support\Collection;

class Tab extends  BaseNode
{

    private Collection $nodes;

    public string $label;

    public Collection $env;

    public bool $disabled;

    public string $info;


    public function __construct()
    {
        parent::__construct();
        $this->nodes = new Collection();
    }

    public function addNode(Node $node): self
    {
        $this->nodes->add($node);
        $node->setTab($this);
        return $this;
    }

    public function nodes(): Collection
    {
        return $this->nodes->collect();
    }

    public function removeNode(Node|string $node): self
    {
        if($node instanceof Node) {
            $node = $node->id;
        }

        $this->nodes = $this->nodes->reject(fn(Node $entry) => $entry->id = $node);
        return $this;
    }

    public function find(string $id): ?Node
    {
        return $this->nodes->first(fn(Node $node) => $node->id == $id);
    }

    public function env(): Collection
    {
        return $this->env->collect();
    }

    public function setEnv(string $key, string $value): self
    {
        $this->env[$key] = $value;
        return $this;
    }

    public function removeEnv(string $key): self
    {
        if($this->env->has($key)) {
            $this->env->forget($key);
        }
        return $this;
    }


}
