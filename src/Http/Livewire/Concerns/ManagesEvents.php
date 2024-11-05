<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use BaseCodeOy\LivewireCalendar\Contracts\DayInterface;
use BaseCodeOy\LivewireCalendar\Contracts\EventInterface;
use Illuminate\Support\Collection;

trait ManagesEvents
{
    public function events(): Collection
    {
        return new Collection();
    }

    public function eventsForDay(DayInterface $day, Collection $events): Collection
    {
        return $events->filter(fn (EventInterface $event) => $event->startTime->toDateString() === $day->date->toDateString());
    }
}
