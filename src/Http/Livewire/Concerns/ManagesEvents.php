<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire\Concerns;

use Illuminate\Support\Collection;
use PreemStudio\LivewireCalendar\Data\Day;
use PreemStudio\LivewireCalendar\Data\Event;

trait ManagesEvents
{
    public function events(): Collection
    {
        return new Collection([
            new Event(
                id: 'id',
                name: 'a really long name that needs to be truncated',
                description: 'description',
                href: 'href',
                startTime: $this->selectedDateTime->clone()->startOfDay()->addHours(2),
                endTime: $this->selectedDateTime->clone()->startOfDay()->addHours(4),
            ),
            new Event(
                id: 'id',
                name: 'a really long name that needs to be truncated',
                description: 'description',
                href: 'href',
                startTime: $this->selectedDateTime->clone()->startOfDay()->addHours(6),
                endTime: $this->selectedDateTime->clone()->startOfDay()->addHours(8),
            ),
            new Event(
                id: 'id',
                name: 'a really long name that needs to be truncated',
                description: 'description',
                href: 'href',
                startTime: $this->selectedDateTime->clone()->startOfDay()->addHours(10),
                endTime: $this->selectedDateTime->clone()->startOfDay()->addHours(12),
            ),
        ]);
    }

    public function eventsForDay(Day $day, Collection $events): Collection
    {
        return $events->filter(fn (Event $event) => $event->startTime->toDateString() === $day->date->toDateString());
    }
}
