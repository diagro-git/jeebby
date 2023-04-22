<?php

namespace App\Rules;

use App\Extensions\Jetstream\Jetstream;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class JetstreamRole implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $role = Jetstream::findRole($value);

        if($role == null || ! $role->assignable) {
            $fail(__('The :attribute must be a valid role.'));
        }
    }
}
