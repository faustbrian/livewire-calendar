<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use Carbon\Carbon;

trait ManagesCursor
{
    public Carbon $selectedDateTime;

    public function moveCursor(string $action, ?string $period = null): void
    {
        if ($action === 'today') {
            $this->selectedDateTime = Carbon::now();

            return;
        }

        match ($period ?? $this->selectedView) {
            'day' => $action === 'next' ? $this->selectedDateTime->addDay() : $this->selectedDateTime->subDay(),
            'week' => $action === 'next' ? $this->selectedDateTime->addWeek() : $this->selectedDateTime->subWeek(),
            'month' => $action === 'next' ? $this->selectedDateTime->addMonth() : $this->selectedDateTime->subMonth(),
            'year' => $action === 'next' ? $this->selectedDateTime->addYear() : $this->selectedDateTime->subYear(),
        };
    }

    public function setDay(string $date): void
    {
        $this->beforeDayChange();

        $this->selectedDateTime = Carbon::parse($date);

        $this->selectView('day');

        $this->afterDayChange();
    }

    public function setWeek(string $startOfWeek): void
    {
        $this->beforeWeekChange();

        $this->selectedDateTime = Carbon::parse($startOfWeek);

        $this->selectView('week');

        $this->afterWeekChange();
    }

    public function setMonth(int $month): void
    {
        $this->beforeMonthChange();

        $this->selectedDateTime->setMonth($month);

        $this->selectView('month');

        $this->afterMonthChange();
    }

    public function setYear(int $year): void
    {
        $this->beforeYearChange();

        $this->selectedDateTime->setYear($year);

        $this->selectView('year');

        $this->afterYearChange();
    }
}
