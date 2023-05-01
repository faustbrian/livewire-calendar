<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use BombenProdukt\LivewireCalendar\Contracts\MonthInterface;
use Illuminate\Support\Collection;

trait ManagesMonths
{
    public function getSelectedMonth(Collection $months): MonthInterface
    {
        return $months->get($this->selectedDateTime->month);
    }
}
