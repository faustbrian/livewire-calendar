<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Data;

use BaseCodeOy\LivewireCalendar\Contracts\YearInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

final class Year implements YearInterface
{
    use Macroable;

    /**
     * @param Collection<int, Month> $months
     */
    public function __construct(
        public readonly Collection $months,
    ) {
        //
    }
}
