<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Data;

use Carbon\Carbon;
use Illuminate\Support\Traits\Macroable;

final class TimeLabel
{
    use Macroable;

    public function __construct(
        private string $dateTimeFormat,
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
        return $this->dateTime->format($this->dateTimeFormat);
    }
}
