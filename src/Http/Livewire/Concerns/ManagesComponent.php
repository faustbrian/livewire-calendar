<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use Carbon\Carbon;
use Illuminate\View\View;

trait ManagesComponent
{
    public function mount(
        ?int $year = null,
        ?int $month = null,
        ?int $day = null,
    ): self {
        $this->selectedDateTime = Carbon::now();

        if ($day !== null) {
            $this->selectedDateTime->setDay($day);
        }

        if ($month !== null) {
            $this->selectedDateTime->setMonth($month);
        }

        if ($year !== null) {
            $this->selectedDateTime->setYear($year);
        }

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
            'dayLabels' => $this->getDayLabels(),
            'timeLabels' => $this->getTimeLabels(),
        ]);
    }
}
