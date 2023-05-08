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
        return FlowStorageFieldResource::collection($flow->storageFields);
    }

    public function store(StorageRequest $request, Team $team, Flow $flow, FlowStorageField $storageField)
    {
        $data = $request->validationData();
        $storageValue = new StorageValue($data);
        $storageValue->team()->associate($team);
        $storageValue->flow()->associate($flow);
        $storageValue->storageField()->associate($storageField);
        $storageValue->saveOrFail();
    }

    public function lastVale(Request $request, StorageService $storageService, Team $team, Flow $flow, FlowStorageField $storageField)
    {
        return response()->json([
            'value' => $storageService->getLastValue($team, $flow, $storageField)
        ]);
    }

}
