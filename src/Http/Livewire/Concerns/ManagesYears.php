<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use BombenProdukt\LivewireCalendar\Data\Year;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

trait ManagesYears
{
    public function getYear(): Year
    {
        return new Year(
            collect(
                CarbonPeriod::create(
                    $this->selectedDateTime->clone()->startOfWeek($this->weekStartsAt)->startOfYear(),
                    '1 month',
                    $this->selectedDateTime->clone()->endOfWeek($this->weekEndsAt)->endOfYear()->startOfDay(),
                ),
            )->mapWithKeys(fn (Carbon $month) => [
                $month->month => $this->mapMonth($month->month, $month->clone()->startOfMonth(), $month->clone()->endOfMonth()),
            ]),
        );
    }
}
