<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Http\Resources\StatusResource;
use App\Models\Flow;
use App\Models\Status;
use App\Models\Team;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function store(StatusRequest $request, Team $team, Flow $flow)
    {
        $data = $request->validationData();
        $status = new Status($data);
        $status->team()->associate($team);
        $status->flow()->associate($flow);
        $status->saveOrFail();
    }

}
