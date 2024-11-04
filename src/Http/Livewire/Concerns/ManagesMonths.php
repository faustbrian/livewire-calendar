<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use BaseCodeOy\LivewireCalendar\Contracts\MonthInterface;
use Illuminate\Support\Collection;

trait ManagesMonths
{
    public function getSelectedMonth(Collection $months): MonthInterface
    {
        return $months->get($this->selectedDateTime->month);
    }
}
