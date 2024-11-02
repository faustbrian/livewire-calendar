<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use BaseCodeOy\LivewireCalendar\Calendar;
use BaseCodeOy\LivewireCalendar\Contracts\DayLabelInterface;
use BaseCodeOy\LivewireCalendar\Contracts\TimeLabelInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

trait ManagesLabels
{
    protected function getDayLabels(): array
    {
        return \array_map(
            fn (Carbon $date): DayLabelInterface => Calendar::createDayLabel(name: $date->format('l')),
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
            fn (Carbon $date): TimeLabelInterface => Calendar::createTimeLabel(dateTime: $date, dateTimeFormat: $this->formatTimeLabel),
            CarbonPeriod::create(
                $this->selectedDateTime->clone()->startOfDay(),
                '1 hour',
                $this->selectedDateTime->clone()->endOfDay(),
            )->toArray(),
        );
    }
}
