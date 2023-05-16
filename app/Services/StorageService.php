<?php
namespace App\Services;

use App\Models\Flow;
use App\Models\FlowStorageField;
use App\Models\StorageValue;
use App\Models\Team;
use App\Services\Storage\Enums\Aggregation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StorageService
{

    private ?Aggregation $aggregation = null;


    public function aggregation(?Aggregation $aggregation = null): self
    {
        $this->aggregation = $aggregation;
        return $this;
    }

    protected function getStorageValueQuery(Team $team, Flow $flow, FlowStorageField $flowStorageField): Builder
    {
        return StorageValue::query()
            ->where('team_id', '=', $team->id)
            ->where('flow_id', '=', $flow->id)
            ->where('flow_storage_field_id','=' , $flowStorageField->id);
    }

    public function getLastValue(Team $team, Flow $flow, FlowStorageField $flowStorageField): mixed
    {
        return $this->getStorageValueQuery($team, $flow, $flowStorageField)
            ->latest()
            ->first()
            ->value;
    }

    public function getValuesBetweenDates(Team $team, Flow $flow, FlowStorageField $flowStorageField, Carbon $from, Carbon $to): array
    {
        $data = $this->getStorageValueQuery($team, $flow, $flowStorageField)
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();

        if($this->aggregation) {
            $data = $this->aggregation->aggregate($data);
        }

        if(is_array($data)) {
            return ['data' => array_values($data)];
        } elseif($data instanceof Collection) {
            return ['data' => $data->pluck('value')];
        } else {
            return ['data' => $data];
        }
    }

    public function getValuesToday(Team $team, Flow $flow, FlowStorageField $flowStorageField): array
    {
        return $this->getValuesBetweenDates(
            $team,
            $flow,
            $flowStorageField,
            Carbon::now(),
            Carbon::now()
        );
    }

    public function getValuesYesterday(Team $team, Flow $flow, FlowStorageField $flowStorageField): array
    {
        return $this->getValuesBetweenDates(
            $team,
            $flow,
            $flowStorageField,
            Carbon::yesterday(),
            Carbon::yesterday()
        );
    }

    public function getValuesYesterdayToday(Team $team, Flow $flow, FlowStorageField $flowStorageField): array
    {
        return $this->getValuesBetweenDates(
            $team,
            $flow,
            $flowStorageField,
            Carbon::yesterday(),
            Carbon::today()
        );
    }

}
