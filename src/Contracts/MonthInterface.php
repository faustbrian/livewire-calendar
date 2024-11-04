<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Contracts;

use Illuminate\Support\Collection;

/**
 * @property int                            $number
 * @property Collection<int, WeekInterface> $weeks
 */
interface MonthInterface
{
    public function getName(): string;
}
