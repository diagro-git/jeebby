<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Flow;
use App\Models\Status;
use App\Models\Team;
use Illuminate\Http\Request;

class StorageController extends Controller
{

    public function all(Request $request, Team $team, Flow $flow)
    {
        return StatusResource::collection(
            Status::installation($team, $flow)->get()
        );
    }

    public function current(Request $request, Team $team, Flow $flow)
    {
        return new StatusResource(
            Status::installation($team, $flow)->latest()->first
        );
    }

    public function store(StatusRequest $request, Team $team, Flow $flow)
    {
        $data = $request->validationData();
        $status = new Status($data);
        $status->team()->associate($team);
        $status->flow()->associate($flow);
        $status->saveOrFail();
    }

}
