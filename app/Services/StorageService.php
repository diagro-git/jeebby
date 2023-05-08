<?php
namespace App\Services;

use App\Models\Flow;
use App\Models\FlowStorageField;
use App\Models\StorageValue;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;

class StorageService
{

    protected function getStorageValueQuery(Team $team, Flow $flow, FlowStorageField $storageField): Builder
    {
        return StorageValue::query()
            ->where('team_id', '=', $team->id)
            ->where('flow_id', '=', $flow->id)
            ->where('flow_storage_field_id','=' , $storageField->id);
    }

    public function getLastValue(Team $team, Flow $flow, FlowStorageField $storageField)
    {
        return $this->getStorageValueQuery($team, $flow, $storageField)
            ->latest()
            ->first()
            ->value;
    }

}
