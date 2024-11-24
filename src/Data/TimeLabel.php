<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Data;

use BaseCodeOy\LivewireCalendar\Contracts\TimeLabelInterface;
use Carbon\Carbon;
use Illuminate\Support\Traits\Macroable;

final class TimeLabel implements TimeLabelInterface
{
    use Macroable;

    public function __construct(
        private Carbon $dateTime,
        private string $dateTimeFormat,
    ) {
        //
    }

    public function toString(): string
    {
        return $this->toTwelveHours();
    }

    private function toTwelveHours(): string
    {
        return $this->dateTime->format($this->dateTimeFormat);
    }
}
