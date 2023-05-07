<?php
namespace App\Services;

use App\Models\FlowStorageField;
use App\Models\Installation;
use App\Models\StorageValue;

class StorageService
{

    public function getLastValue(Installation $installation, FlowStorageField $storageField)
    {
        return StorageValue::query()
            ->where('installation_id', '=', $installation->id)
            ->where('flow_storage_field_id','=' , $storageField->id)
            ->latest()
            ->first()
            ->value;
    }

}
