<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Data;

use BaseCodeOy\LivewireCalendar\Contracts\WeekInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

final class Week implements WeekInterface
{
    use Macroable;

    /**
     * @param Collection<int, Day> $days
     */
    public function __construct(
        public readonly Collection $days,
    ) {
        //
    }
}
