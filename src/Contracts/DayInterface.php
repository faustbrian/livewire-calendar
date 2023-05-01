<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Contracts;

use Carbon\Carbon;

/**
 * @property Carbon $date
 * @property bool   $isCurrentMonth
 * @property bool   $isToday
 * @property bool   $isSelected
 */
interface DayInterface
{
    public function isToday(): bool;

    public function shortName(): string;

    public function character(): string;

    public function characterSuffix(): string;

    public function number(): string;
}
