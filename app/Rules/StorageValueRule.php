<?php

namespace App\Rules;

use App\Models\Enums\StorageFieldType;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StorageValueRule implements ValidationRule
{

    public function __construct(private StorageFieldType $fieldType)
    {}

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        switch($this->fieldType)
        {
            case StorageFieldType::ARRAY:
                if(! is_array(json_decode($value, true)))
                    $fail(':attribute is not a valid array.');
                break;
            case StorageFieldType::BOOLEAN:
                if(! is_bool(boolval($value)))
                    $fail(':attribute is not a valid boolean.');
                break;
            case StorageFieldType::DATE:
                if(! Carbon::createFromFormat('Y-m-d', $value)) {
                    $fail(':attribute is not a valid date. Only format Y-m-d is allowed.');
                }
                break;
            case StorageFieldType::DATETIME:
                if(! Carbon::createFromFormat('Y-m-d H:i:s', $value)) {
                    $fail(':attribute is not a datetime. Only format Y-m-d H:i:s is allowed.');
                }
                break;
            case StorageFieldType::DECIMAL:
                if(! is_double(doubleval($value))) {
                    $fail(':attribute is not a valid decimal.');
                }
                break;
            case StorageFieldType::INT:
                if(! is_int(intval($value))) {
                    $fail(':attribute mus be a valid integer.');
                }
                break;
            case StorageFieldType::JSON:
                if(is_null(json_decode($value))) {
                    $fail(':attribute must be a valid json object.');
                }
                break;
            case StorageFieldType::TEXT:
                if(! is_string($value)) {
                    $fail(':attribute must be a valid string.');
                }
                break;
            case StorageFieldType::TIME:
                if(! Carbon::createFromFormat('H:i:s', $value)) {
                    $fail(':attribute is not a valid time. Only format H:i:s is allowed.');
                }
                break;
        }
    }
}
