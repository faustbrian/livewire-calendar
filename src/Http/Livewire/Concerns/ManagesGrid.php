<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use BaseCodeOy\LivewireCalendar\Calendar;
use BaseCodeOy\LivewireCalendar\Contracts\DayInterface;
use BaseCodeOy\LivewireCalendar\Contracts\MonthInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

trait ManagesGrid
{
    public function mapMonth(int $month, Carbon $startsAt, Carbon $endsAt): MonthInterface
    {
        $firstDayOfGrid = $startsAt->clone()->startOfWeek($this->weekStartsAt);
        $lastDayOfGrid = $endsAt->clone()->endOfWeek($this->weekEndsAt);

        $weeks = collect(
            CarbonPeriod::create(
                $firstDayOfGrid,
                '1 day',
                $lastDayOfGrid->addWeeks(6 - $lastDayOfGrid->diffInWeeks($firstDayOfGrid)),
            ),
        )
            ->map(fn (Carbon $date): DayInterface => Calendar::createDay(
                date: $date->clone(),
                isCurrentMonth: $date->month === $month,
                isToday: $date->isToday(),
            ))
            ->chunk(7)
            ->map(fn (Collection $days) => Calendar::createWeek(days: $days->values()));

        $weeks->pop();

        return Calendar::createMonth(number: $month, weeks: $weeks);
    }
}
