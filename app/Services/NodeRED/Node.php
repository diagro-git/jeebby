<?php
namespace App\Services\NodeRED;

use App\Services\NodeRED\Traits\WithNodeID;
use Illuminate\Support\Collection;

class Node extends BaseNode
{

    use WithNodeID;


    protected Collection $wires;

    protected ?Tab $tab = null;

    public string $name;

    public int $x;

    public int $y;


    public function __construct(string $type)
    {
        parent::__construct($type);
        $this->wires = new Collection();
    }

    public function setTab(Tab $tab): self
    {
        $this->tab = $tab;
        return $this;
    }

    public function getTab(): ?Tab
    {
        return $this->tab;
    }

    public function addWire(Node $node)
    {
        if(! $this->wires->contains(fn(Node $entry) => $entry->id == $node->id)) {
            $this->wires->add($node);
        }
    }

    public function removeWire(Node|string $node)
    {
        if($node instanceof Node) {
            $node = $node->id;
        }

        $this->wires->reduce(fn(Node $entry) => $entry->id == $node);
    }

    public function toArray(): array
    {
        $data = parent::toArray();
        $data['z'] = $this->tab->id;

        return $data;
    }


}
