<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Data;

use BaseCodeOy\LivewireCalendar\Contracts\DayLabelInterface;
use Illuminate\Support\Traits\Macroable;

final class DayLabel implements DayLabelInterface
{
    use Macroable;

    public function __construct(
        private string $name,
    ) {
        //
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCharacter(): string
    {
        return \mb_strtoupper(\mb_substr($this->name, 0, 1));
    }

    public function getCharacterSuffix(): string
    {
        return \mb_substr($this->name, 1, 2);
    }
}
