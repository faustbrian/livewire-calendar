<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Data;

use BombenProdukt\LivewireCalendar\Contracts\MonthInterface;
use Illuminate\Support\Collection;

final readonly class Month implements MonthInterface
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
