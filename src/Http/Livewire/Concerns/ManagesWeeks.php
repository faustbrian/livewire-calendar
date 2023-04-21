<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire\Concerns;

use Illuminate\Support\Collection;
use PreemStudio\LivewireCalendar\Data\Day;
use PreemStudio\LivewireCalendar\Data\Week;

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
