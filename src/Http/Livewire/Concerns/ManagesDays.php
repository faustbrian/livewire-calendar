<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use BaseCodeOy\LivewireCalendar\Contracts\DayInterface;
use BaseCodeOy\LivewireCalendar\Contracts\MonthInterface;
use BaseCodeOy\LivewireCalendar\Contracts\WeekInterface;
use Illuminate\Support\Collection;

trait ManagesDays
{
    public function getSelectedDay(Collection $months): DayInterface
    {
        return $months
            ->map(fn (MonthInterface $month) => $month->weeks)
            ->flatten()
            ->map(fn (WeekInterface $week) => $week->days)
            ->flatten()
            ->filter(fn (DayInterface $day) => $day->date->isSameDay($this->selectedDateTime))
            ->first();
    }

    public function isSelectedDay(DayInterface $day): bool
    {
        return $day->date->isSameDay($this->selectedDateTime);
    }
}
