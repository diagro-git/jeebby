<?php

namespace App\Http\Resources;

use App\Models\Enums\StatusType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['status_name'] = StatusType::from($data['status'])->name;
        return $data;
    }
}
