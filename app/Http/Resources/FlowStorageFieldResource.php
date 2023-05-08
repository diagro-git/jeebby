<?php

namespace App\Http\Resources;

use App\Models\Enums\StorageFieldType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlowStorageFieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['type_name'] = StorageFieldType::from($data['type'])->name;
        return $data;
    }
}
