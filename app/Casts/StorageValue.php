<?php

namespace App\Casts;

use App\Models\Enums\StorageFieldType;
use App\Models\FlowStorageField;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class StorageValue implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if($model instanceof \App\Models\StorageValue) {
            /** @var StorageFieldType $storageFieldType */
            $storageFieldType = $model->storageField->type;
            switch($storageFieldType)
            {
                case StorageFieldType::ARRAY:
                    return json_decode($value, true);
                case StorageFieldType::BOOLEAN:
                    return boolval($value);
                case StorageFieldType::DATE:
                    return Carbon::createFromFormat('Y-m-d', $value);
                case StorageFieldType::DATETIME:
                    return Carbon::createFromFormat('Y-m-d H:i:s', $value);
                case StorageFieldType::DECIMAL:
                    return floatval($value);
                case StorageFieldType::INT:
                    return intval($value);
                case StorageFieldType::JSON:
                    return json_decode($value);
                case StorageFieldType::TIME:
                    return Carbon::createFromFormat('H:i:s', $value);
            }
        }

        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if($model instanceof \App\Models\StorageValue) {
            /** @var StorageFieldType $storageFieldType */
            $storageFieldType = $model->storageField->type;
            switch($storageFieldType)
            {
                case StorageFieldType::JSON:
                case StorageFieldType::ARRAY:
                    $value = json_encode($value);
                    break;
                case StorageFieldType::BOOLEAN:
                    $value = $value ? '1' : '0';
                    break;
                case StorageFieldType::DATE:
                    $value = $value->format('Y-m-d');
                    break;
                case StorageFieldType::DATETIME:
                    $value = $value->format('Y-m-d H:i:s');
                    break;
                case StorageFieldType::INT:
                case StorageFieldType::DECIMAL:
                    $value = (string) $value;
                    break;
                case StorageFieldType::TIME:
                    $value = $value->format('H:i:s');
                    break;
            }
        }

        return ['value' => $value];
    }
}
