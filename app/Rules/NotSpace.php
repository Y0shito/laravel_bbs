<?php

declare(strict_types=1);

namespace App\Rules;

use App\Traits\Spaceremoval;
use Illuminate\Contracts\Validation\Rule;

class NotSpace implements Rule
{
    use Spaceremoval;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //全角スペースの除去後、5文字未満ならfalse
        if (mb_strlen(Spaceremoval::spaceRemoval($value), 'UTF-8') < 5) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '内容を入力してください';
    }
}
