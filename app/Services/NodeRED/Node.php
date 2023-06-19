<?php
namespace App\Services\NodeRED;

use App\Services\NodeRED\Traits\WithNodeID;

class Node
{

    use WithNodeID;


    protected ?Tab $tab = null;

    public string $name;

    public int $x;

    public int $y;

    public function setTab(Tab $tab): self
    {
        $this->tab = $tab;
    }

    public function getTab(): ?Tab
    {
        return $this->tab;
    }

}
