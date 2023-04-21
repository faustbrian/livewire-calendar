<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire\Concerns;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use PreemStudio\LivewireCalendar\Data\Day;
use PreemStudio\LivewireCalendar\Data\Month;
use PreemStudio\LivewireCalendar\Data\Week;
use PreemStudio\LivewireCalendar\Data\Year;

trait ManagesGrid
{
    public function getYear(): Year
    {
        return new Year(
            collect(
                CarbonPeriod::create(
                    $this->selectedDateTime->clone()->startOfYear()->startOfWeek($this->weekStartsAt),
                    '1 month',
                    $this->selectedDateTime->clone()->endOfYear()->endOfWeek($this->weekEndsAt)->startOfDay(),
                ),
            )->mapWithKeys(fn (Carbon $month) => [
                $month->month => $this->mapMonth($month->month, $month->clone()->startOfMonth(), $month->clone()->endOfMonth()),
            ]),
        );
    }

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
