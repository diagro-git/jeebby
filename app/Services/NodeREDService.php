<?php
namespace App\Services;

use App\Services\NodeRED\NodeRED;

class NodeREDService
{

    public ?NodeRED $nodeRED = null;


    public function make(array $flowData): NodeRED
    {
        $this->nodeRED = new NodeRED($flowData);
        return $this->nodeRED;
    }

    public function toJSON(): string
    {
        return json_encode($this->nodeRED->toArray());
    }


}
