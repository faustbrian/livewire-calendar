<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Data;

use Carbon\Carbon;

final readonly class TimeLabel
{
    public function __construct(
        private Carbon $dateTime,
    ) {
        //
    }

    public function toString(): string
    {
        return $this->toTwelveHours();
    }

    private function toTwelveHours(): string
    {
        return $this->dateTime->format('g A');
    }
}
