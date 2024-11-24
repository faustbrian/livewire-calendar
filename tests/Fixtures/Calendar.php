<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Fixtures;

use BaseCodeOy\LivewireCalendar\Data\Event;
use BaseCodeOy\LivewireCalendar\Http\Livewire\AbstractCalendar;
use Illuminate\Support\Collection;

final class Calendar extends AbstractCalendar
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
}
