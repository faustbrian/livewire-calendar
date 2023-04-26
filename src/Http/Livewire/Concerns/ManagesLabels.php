<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use BombenProdukt\LivewireCalendar\Data\DayLabel;
use BombenProdukt\LivewireCalendar\Data\TimeLabel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

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
            fn (Carbon $date): TimeLabel => new TimeLabel($this->formatTimeLabel, $date),
            CarbonPeriod::create(
                $this->selectedDateTime->clone()->startOfDay(),
                '1 hour',
                $this->selectedDateTime->clone()->endOfDay(),
            )->toArray(),
        );
    }
}
