<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageRequest;
use App\Http\Resources\FlowStorageFieldResource;
use App\Models\Flow;
use App\Models\FlowStorageField;
use App\Models\StorageValue;
use App\Models\Team;
use App\Services\StorageService;
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

    public function lastVale(Request $request, StorageService $storageService, Team $team, Flow $flow, FlowStorageField $storageField)
    {
        return response()->json([
            'value' => $storageService->getLastValue($team, $flow, $storageField)
        ]);
    }

}
