<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use BombenProdukt\LivewireCalendar\Data\Day;
use BombenProdukt\LivewireCalendar\Data\Month;
use BombenProdukt\LivewireCalendar\Data\Week;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

trait ManagesGrid
{
    public function mapMonth(int $month, Carbon $startsAt, Carbon $endsAt): Month
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
            ->map(fn (Carbon $date): Day => new Day(
                date: $date->clone(),
                isCurrentMonth: $date->month === $month,
                isToday: $date->isToday(),
            ))
            ->chunk(7)
            ->map(fn (Collection $days) => new Week($days->values()));

        $weeks->pop();

        return new Month($month, $weeks);
    }
}
