<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use BaseCodeOy\LivewireCalendar\Calendar;
use BaseCodeOy\LivewireCalendar\Contracts\YearInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

trait ManagesYears
{
    public function getYear(): YearInterface
    {
        return Calendar::createYear(
            months: collect(
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
