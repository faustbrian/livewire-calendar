<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire\Concerns;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use PreemStudio\LivewireCalendar\Data\DayLabel;
use PreemStudio\LivewireCalendar\Data\TimeLabel;

trait ManagesLabels
{
    protected function getDayLabels(): array
    {
        return \array_map(
            fn (Carbon $date): DayLabel => new DayLabel($date->format('l')),
            CarbonPeriod::create(
                $this->selectedDateTime->clone()->startOfWeek($this->weekStartsAt),
                '1 day',
                $this->selectedDateTime->clone()->endOfWeek($this->weekEndsAt),
            )->toArray(),
        );
    }

    protected function getTimeLabels(): array
    {
        return \array_map(
            fn (Carbon $date): TimeLabel => new TimeLabel($date),
            CarbonPeriod::create(
                $this->selectedDateTime->clone()->startOfDay(),
                '1 hour',
                $this->selectedDateTime->clone()->endOfDay(),
            )->toArray(),
        );
    }
}
