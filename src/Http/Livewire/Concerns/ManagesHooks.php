<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

trait ManagesHooks
{
    public function beforeDayChange(): void
    {
        //
    }

    public function afterDayChange(): void
    {
        //
    }

    public function beforeWeekChange(): void
    {
        //
    }

    public function afterWeekChange(): void
    {
        //
    }

    public function beforeMonthChange(): void
    {
        //
    }

    public function afterMonthChange(): void
    {
        //
    }

    public function beforeYearChange(): void
    {
        //
    }

    public function afterYearChange(): void
    {
        //
    }

    public function onEventClick(string $id): void
    {
        $this->redirect($this->events()->firstWhere('id', $id)->href);
    }

    public function onEventDropped(string $eventId, string $date): void
    {
        //
    }
}
