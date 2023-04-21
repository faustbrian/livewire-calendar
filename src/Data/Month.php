<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Data;

use Illuminate\Support\Collection;

final readonly class Month
{
    /**
     * @param Collection<int, Week> $weeks
     */
    public function __construct(
        public int $number,
        public Collection $weeks,
    ) {
        //
    }

    public function name(): string
    {
        return \date('F', \mktime(0, null, null, $this->number, 1));
    }
}
