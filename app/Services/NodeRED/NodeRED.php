<?php
namespace App\Services\NodeRED;

use Illuminate\Support\Collection;

class NodeRED
{

    private Collection $nodes;


    public function __construct(array $flowData)
    {
        $this->nodes = new Collection();
        $this->make($flowData);
    }

    public function make(array $flowData)
    {
        foreach($flowData as $data) {
            if($data['type'] == 'tab') {
                $node = Tab::factory($data);
            } elseif(array_key_exists('z', $data)) {
                if($data['type'] == 'link out') {
                    $node = LinkOut::factory($data);
                } elseif($data['type'] == 'link in') {
                    $node = LinkIn::factory($data);
                } else {
                    $node = Node::factory($data);
                }

                /** @var null|Tab $tab */
                $tab = $this->find($data['z']);
                if($tab instanceof  Tab) {
                    $tab->addNode($node);
                }
            } else {
                $node = ConfigNode::factory($data);
            }

            $this->addNode($node);
        }

        //read the wires.
        foreach($flowData as $data) {
            if(isset($data['wires'])) {
                $node = $this->find($data['id']);
                if($node instanceof Node && is_array($data['wires'])) {
                    foreach ($data['wires'] as $id) {
                        $id = $this->find($id);
                        if($id instanceof Node) {
                            $node->addWire($id);
                        }
                    }
                }
            }
        }
    }

    public function toArray(): array
    {
        $data = [];
        /** @var BaseNode $node */
        foreach($this->nodes as $node) {
            $data[] = $node->toArray();
        }
        return $data;
    }

    public function addNode(BaseNode $node): self
    {
        $this->nodes->add($node);
        return $this;
    }

    public function nodes(): Collection
    {
        return $this->nodes->collect();
    }

    public function removeNode(BaseNode|string $node): self
    {
        if($node instanceof Tab) {
            $node = $node->id;
        }

        $this->tabs = $this->nodes->reject(fn(BaseNode $entry) => $entry->id == $node);
        return $this;
    }

    public function find(string $id): ?BaseNode
    {
        return $this->nodes->first(fn(BaseNode $entry) => $entry->id == $id);
    }

    public function bind(Node $from, Node $to)
    {
        if($from->getTab()->id === $to->getTab()->id) {
            $from->addWire($to);
        } else {
            //make link out and link in nodes
            $linkOut = $this->makeLinkOut($from->getTab());
            $linkIn = $this->makeLinkIn($to->getTab());

            //linkout en linkin attachen
            $from->addWire($linkOut);
            $linkOut->addLink($linkIn);
            $linkIn->addLink($linkOut);
            $linkIn->addWire($to);
        }
    }

    private function makeLinkOut(Tab $tab): LinkOut
    {
        $node = $tab->nodes()->first(fn(Node $node) => $node->type == 'link out');
        if($node == null) {
            $node = LinkOut::factory([
                'id' => LinkOut::generateId(),
                'type' => 'link out',
                'name' => 'link out 1',
                'x' => 500,
                'y' => 500,
            ]);
            $tab->addNode($node);
        }
    }

    private function makeLinkIn(Tab $tab): LinkIn
    {
        $count = $tab->nodes()->countBy(fn(Node $node) => $node->type == 'link in') + 1;
        $node = LinkIn::factory([
            'id' => LinkOut::generateId(),
            'type' => 'link in',
            'name' => 'link in ' . $count,
            'x' => 50,
            'y' => 10 * $count,
        ]);
        $tab->addNode($node);
    }

}
