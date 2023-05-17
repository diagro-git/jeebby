<?php
namespace App\Http\Requests;

use Laravel\Diagro\Http\ActionMethodRulesRequest;
use Illuminate\Validation\Rules\Enum;
use App\Models\Enums\StatusType;

class StatusRequest extends ActionMethodRulesRequest
{
    /**
     * @inheritDoc
     */
    protected function defaultRules(): array
    {
        return [];
    }

    protected function store(): array
    {
        return [
            'status' => ['present', new Enum(StatusType::class)],
            'message' => 'present|string|max:255'
        ];
    }
}
