<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Http\Livewire\Concerns;

use BombenProdukt\LivewireCalendar\Data\Day;
use BombenProdukt\LivewireCalendar\Data\Event;
use Illuminate\Support\Collection;

trait ManagesEvents
{
    public function events(): Collection
    {
        return new Collection();
    }

    public function eventsForDay(Day $day, Collection $events): Collection
    {
        return $events->filter(fn (Event $event) => $event->startTime->toDateString() === $day->date->toDateString());
    }
}
