<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Data;

use BombenProdukt\LivewireCalendar\Contracts\YearInterface;
use Illuminate\Support\Collection;

final readonly class Year implements YearInterface
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
