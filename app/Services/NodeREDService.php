<?php
namespace App\Services;

use App\Services\NodeRED\Node;
use App\Services\NodeRED\NodeRED;
use App\Services\NodeRED\Tab;
use Illuminate\Support\Arr;

class NodeREDService
{


    public function factory(array $flowData): NodeRED
    {
        $nodeRED = new NodeRED();

        foreach($flowData as $data) {
            if($data['type'] == 'tab') {
                $tab = Tab::factory($data);
                $nodeRED->addTab($tab);
            } elseif(array_key_exists('z', $data)) {
                /** @var Tab $tab */
                $tab = $nodeRED->tabs()->first(fn(Tab $tab) => $tab->id == $data['z']);
                $node = Node::factory($data);
                $tab->addNode($node);
            } else {
                //configuration nodes
                //andere nodes?
            }
        }

        return $nodeRED;
    }


}
