<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire\Concerns;

use Illuminate\Support\Collection;
use PreemStudio\LivewireCalendar\Data\Month;

trait ManagesMonths
{
    public function getSelectedMonth(Collection $months): Month
    {
        return $months->get($this->selectedDateTime->month);
    }
}
