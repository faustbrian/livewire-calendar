<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Data;

use Illuminate\Support\Collection;

final readonly class Week
{
    /**
     * @param Collection<int, Day> $days
     */
    public function __construct(
        public Collection $days,
    ) {
        //
    }
}
