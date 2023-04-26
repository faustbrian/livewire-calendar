<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Data;

use Carbon\Carbon;

final readonly class Day
{
    public function __construct(
        public Carbon $date,
        public bool $isCurrentMonth,
        public bool $isToday,
        public bool $isSelected = false,
    ) {
        //
    }

    public function isToday(): bool
    {
        return $this->date->isToday();
    }

    public function shortName(): string
    {
        return $this->date->format('D');
    }

    public function character(): string
    {
        return \mb_strtoupper(\mb_substr($this->shortName(), 0, 1));
    }

    public function characterSuffix(): string
    {
        return \mb_substr($this->shortName(), 1);
    }

    public function number(): string
    {
        return $this->date->format('d');
    }
}
