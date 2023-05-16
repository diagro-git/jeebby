<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageRequest;
use App\Http\Resources\FlowStorageFieldResource;
use App\Models\Flow;
use App\Models\FlowStorageField;
use App\Models\StorageValue;
use App\Models\Team;
use App\Services\Storage\Enums\Aggregation;
use App\Services\StorageService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StorageController extends Controller
{

    public function fields(Request $request, Flow $flow)
    {
        return FlowStorageFieldResource::collection($flow->flowStorageFields);
    }

    public function store(StorageRequest $request, Team $team, Flow $flow, FlowStorageField $flowStorageField)
    {
        $data = $request->validationData();
        $storageValue = new StorageValue();
        $storageValue->team()->associate($team);
        $storageValue->flow()->associate($flow);
        $storageValue->flowStorageField()->associate($flowStorageField);
        $storageValue->value = $data['value'];
        $storageValue->saveOrFail();
    }

    public function lastValue(Request $request, StorageService $storageService, Team $team, Flow $flow, FlowStorageField $flowStorageField)
    {
        return response()->json([
            'value' => $storageService->getLastValue($team, $flow, $flowStorageField)
        ]);
    }

    public function betweenDates(Request $request, StorageService $storageService, Team $team, Flow $flow, FlowStorageField $flowStorageField, string $from, string $to, ?Aggregation $aggregation = null)
    {
        return response()->json( $storageService->aggregation($aggregation)->getValuesBetweenDates(
            $team,
            $flow,
            $flowStorageField,
            Carbon::createFromFormat('Y-m-d', $from),
            Carbon::createFromFormat('Y-m-d', $to),
        ));
    }

    public function today(Request $request, StorageService $storageService, Team $team, Flow $flow, FlowStorageField $flowStorageField, ?Aggregation $aggregation = null)
    {
        return response()->json( $storageService->aggregation($aggregation)->getValuesToday(
            $team,
            $flow,
            $flowStorageField
        ));
    }

    public function yesterday(Request $request, StorageService $storageService, Team $team, Flow $flow, FlowStorageField $flowStorageField, ?Aggregation $aggregation = null)
    {
        return response()->json( $storageService->aggregation($aggregation)->getValuesYesterday(
            $team,
            $flow,
            $flowStorageField
        ));
    }

    public function yesterdayToday(Request $request, StorageService $storageService, Team $team, Flow $flow, FlowStorageField $flowStorageField, ?Aggregation $aggregation = null)
    {
        return response()->json( $storageService->aggregation($aggregation)->getValuesYesterdayToday(
            $team,
            $flow,
            $flowStorageField
        ));
    }

}
