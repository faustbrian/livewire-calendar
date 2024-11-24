<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use BaseCodeOy\LivewireCalendar\Contracts\MonthInterface;
use Illuminate\Support\Collection;

trait ManagesMonths
{
    public function getSelectedMonth(Collection $months): MonthInterface
    {
        return $months->get($this->selectedDateTime->month);
    }
}
