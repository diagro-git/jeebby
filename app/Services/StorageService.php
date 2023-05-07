<?php
namespace App\Services;

use App\Models\FlowStorageField;
use App\Models\Installation;
use App\Models\StorageValue;
use Illuminate\Database\Eloquent\Builder;

class StorageService
{

    protected function getStorageValueQuery(Installation $installation, FlowStorageField $storageField): Builder
    {
        return StorageValue::query()
            ->where('installation_id', '=', $installation->id)
            ->where('flow_storage_field_id','=' , $storageField->id);
    }

    public function getLastValue(Installation $installation, FlowStorageField $storageField)
    {
        return $this->getStorageValueQuery($installation, $storageField)
            ->latest()
            ->first()
            ->value;
    }

}
