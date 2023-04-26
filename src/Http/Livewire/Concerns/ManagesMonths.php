<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use BombenProdukt\LivewireCalendar\Data\Month;
use Illuminate\Support\Collection;

trait ManagesMonths
{
    public function getSelectedMonth(Collection $months): Month
    {
        return $months->get($this->selectedDateTime->month);
    }
}
