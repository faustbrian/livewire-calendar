<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Data;

use Illuminate\Support\Collection;

final readonly class Year
{
    /**
     * @param Collection<int, Month> $months
     */
    public function __construct(
        public Collection $months,
    ) {
        //
    }
}
