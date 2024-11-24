<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Data;

use BaseCodeOy\LivewireCalendar\Contracts\MonthInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Macroable;

final class Month implements MonthInterface
{
    use Macroable;

    /**
     * @param Collection<int, Week> $weeks
     */
    public function __construct(
        public int $number,
        public readonly Collection $weeks,
    ) {
        //
    }

    public function getName(): string
    {
        return \date('F', \mktime(0, null, null, $this->number, 1));
    }
}
