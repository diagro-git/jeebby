<?php
namespace App\Http\Requests;

use App\Models\FlowStorageField;
use App\Rules\StorageValueRule;
use Laravel\Diagro\Http\ActionMethodRulesRequest;

class StorageRequest extends ActionMethodRulesRequest
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
        $storageField = $this->route('flowStorageField');
        if(is_string($storageField)) {
            $storageField = FlowStorageField::query()->find($storageField);
        }
        return [
            'value' => ['present', new StorageValueRule($storageField)]
        ];
    }
}
