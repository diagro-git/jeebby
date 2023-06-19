<?php
namespace App\Services\NodeRED;

use Illuminate\Support\Collection;

class LinkIn extends Node
{

    public Collection $links;


    public function __construct()
    {
        parent::__construct('link in');
        $this->links = new Collection();
    }

    public function addLink(LinkOut $node)
    {
        if(! $this->links->contains(fn(LinkOut $entry) => $entry->id == $node->id)) {
            $this->links->add($node);
        }
    }

    public function removeLink(LinkOut|string $node)
    {
        if($node instanceof LinkOut) {
            $node = $node->id;
        }

        $this->links->reject(fn(LinkOut $entry) => $entry->id == $node);
    }

}
