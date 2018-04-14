<?php

namespace Viperxes\Rest\Rules;

use Illuminate\Contracts\Validation\Rule;
use Viperxes\Rest\ItemSearch\Filters\Filter;

class NumberOperatorFilter implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match(Filter::NUMBER_OPERATOR_REGEX, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must contain number operator and value';
    }
}
