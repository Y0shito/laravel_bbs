<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PublicStatus extends Enum
{
    public const CLOSE = 0;
    public const OPEN = 1;
}
