<?php
namespace App\Services\NodeRED;

use Illuminate\Database\Eloquent\Collection;

class LinkOut extends Node
{

    public Collection $links;


    public function __construct()
    {
        parent::__construct('link out');
        $this->links = new Collection();
    }

    public function addLink(LinkIn $node)
    {
        if(! $this->links->contains(fn(LinkIn $entry) => $entry->id == $node->id)) {
            $this->links->add($node);
        }
    }

    public function removeLink(LinkIn|string $node)
    {
        if($node instanceof LinkIn) {
            $node = $node->id;
        }

        $this->links->reject(fn(LinkIn $entry) => $entry->id == $node);
    }

}
