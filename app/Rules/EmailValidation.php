<?php

namespace App\Rules;

use App\Models\Constants\BaseConstants;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Application;

class EmailValidation implements Rule
{
    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return (bool)preg_match(BaseConstants::EMAIL_REGEX, $value);
    }

    /**
     * @return Application|array|string|Translator|null
     */
    public function message(): Application|array|string|Translator|null
    {
        return __('The email field must be a valid email address');
    }
}
