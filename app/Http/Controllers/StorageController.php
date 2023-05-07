<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageRequest;
use App\Http\Resources\FlowStorageFieldResource;
use App\Models\Flow;
use App\Models\FlowStorageField;
use App\Models\Installation;
use App\Models\StorageValue;
use Illuminate\Http\Request;

class StorageController extends Controller
{

    public function fields(Request $request, Flow $flow)
    {
        return FlowStorageFieldResource::collection($flow->storageFields());
    }

    public function store(StorageRequest $request, Installation $installation, FlowStorageField $storageField)
    {
        $data = $request->validationData();
        $storageValue = new StorageValue($data);
        $storageValue->installation()->associate($installation);
        $storageValue->storageField()->associate($storageField);
        $storageValue->saveOrFail();
    }

    public function getValue(Request $request, Installation $installation, FlowStorageField $storageField)
    {
        //aggregation method
        //
    }

}
