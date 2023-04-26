<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use BombenProdukt\LivewireCalendar\Data\Day;
use BombenProdukt\LivewireCalendar\Data\Week;
use Illuminate\Support\Collection;

trait ManagesWeeks
{
    public function getSelectedWeek(Collection $months): Week
    {
        return $this
            ->getSelectedMonth($months)
            ->weeks
            ->flatten()
            ->filter(fn (Week $week) => $week->days->filter(fn (Day $day): bool => $day->date->weekOfYear === $this->selectedDateTime->weekOfYear)->count() > 0)
            ->first();
    }
}
