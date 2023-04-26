<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use Illuminate\Support\Collection;
use BombenProdukt\LivewireCalendar\Data\Day;
use BombenProdukt\LivewireCalendar\Data\Month;
use BombenProdukt\LivewireCalendar\Data\Week;

trait ManagesDays
{
    public function getSelectedDay(Collection $months): Day
    {
        return $months
            ->map(fn (Month $month) => $month->weeks)
            ->flatten()
            ->map(fn (Week $week) => $week->days)
            ->flatten()
            ->filter(fn (Day $day) => $day->date->isSameDay($this->selectedDateTime))
            ->first();
    }

    public function isSelectedDay(Day $day): bool
    {
        return $day->date->isSameDay($this->selectedDateTime);
    }
}
