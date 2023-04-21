<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire\Concerns;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use PreemStudio\LivewireCalendar\Data\DayLabel;
use PreemStudio\LivewireCalendar\Data\TimeLabel;

trait ManagesLabels
{
    protected function getDayLabels(): Collection
    {
        return collect(
            CarbonPeriod::create(
                $this->selectedDateTime->clone()->startOfWeek($this->weekStartsAt),
                '1 day',
                $this->selectedDateTime->clone()->endOfWeek($this->weekEndsAt),
            ),
        )->map(fn (Carbon $date): DayLabel => new DayLabel($date->format('l')));
    }

    protected function getTimeLabels(): Collection
    {
        return collect(
            CarbonPeriod::create(
                $this->selectedDateTime->clone()->startOfDay(),
                '1 hour',
                $this->selectedDateTime->clone()->endOfDay(),
            ),
        )->map(fn (Carbon $date): TimeLabel => new TimeLabel($date));
    }
}
