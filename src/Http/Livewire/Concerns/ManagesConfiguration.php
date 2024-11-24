<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

use Carbon\Carbon;

trait ManagesConfiguration
{
    public int $weekStartsAt = Carbon::MONDAY;

    public int $weekEndsAt = Carbon::SUNDAY;

    public string $formatEventTime = 'g:i A';

    public string $formatTimeLabel = 'gA';
}
