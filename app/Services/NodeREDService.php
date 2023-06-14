<?php
namespace App\Services;

use App\Services\NodeRED\Flow;

class NodeREDService
{


    public function factory(array $flowData): Flow
    {
        //FlowFactory
        //NodeFactory
    }


    public function generateId(): string
    {
        $bytes = [];
        for ($i = 0 ; $i < 8 ; $i++) {
            $rand = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
            $bytes[] = str_pad(dechex(round(0xFF * $rand)), 2, '0', STR_PAD_LEFT);
        }
        return implode('', $bytes);
    }


}
