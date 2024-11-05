<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Contracts;

use Carbon\Carbon;

/**
 * @property Carbon $dateTime
 * @property string $dateTimeFormat
 */
interface TimeLabelInterface
{
    public function toString(): string;
}
