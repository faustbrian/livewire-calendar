<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use BombenProdukt\LivewireCalendar\Calendar;
use BombenProdukt\LivewireCalendar\Contracts\DayInterface;
use BombenProdukt\LivewireCalendar\Contracts\MonthInterface;
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
