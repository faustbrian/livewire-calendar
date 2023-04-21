<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire\Concerns;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\View\View;

trait ManagesComponent
{
    public function mount(): self
    {
        $this->selectedDateTime = Carbon::now();

        return $this;
    }

    public function render(): View
    {
        return view('livewire-calendar::calendar')->with([
            'events' => $this->events(),
            'year' => $year = $this->getYear(),
            'month' => $this->getSelectedMonth($year->months),
            'week' => $this->getSelectedWeek($year->months),
            'day' => $this->getSelectedDay($year->months),
            'timesOfDay' => collect(
                CarbonPeriod::create(
                    $this->selectedDateTime->clone()->startOfDay(),
                    '1 hour',
                    $this->selectedDateTime->clone()->endOfDay(),
                ),
            )->map(fn (Carbon $date): string => $date->format('g A')),
        ]);
    }
}
