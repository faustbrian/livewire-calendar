<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use BaseCodeOy\LivewireCalendar\Contracts\DayInterface;
use BaseCodeOy\LivewireCalendar\Contracts\WeekInterface;
use Illuminate\Support\Collection;

trait ManagesWeeks
{
    public function getSelectedWeek(Collection $months): WeekInterface
    {
        return $this
            ->getSelectedMonth($months)
            ->weeks
            ->flatten()
            ->filter(fn (WeekInterface $week) => $week->days->filter(fn (DayInterface $day): bool => $day->date->weekOfYear === $this->selectedDateTime->weekOfYear)->count() > 0)
            ->first();
    }
}
