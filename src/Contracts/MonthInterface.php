<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Contracts;

use Illuminate\Support\Collection;

/**
 * @property int                            $number
 * @property Collection<int, WeekInterface> $weeks
 */
interface MonthInterface
{
    public function getName(): string;
}
