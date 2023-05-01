<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Data;

use BombenProdukt\LivewireCalendar\Contracts\TimeLabelInterface;
use Carbon\Carbon;
use Illuminate\Support\Traits\Macroable;

final class TimeLabel implements TimeLabelInterface
{
    use Macroable;

    public function __construct(
        private Carbon $dateTime,
        private string $dateTimeFormat,
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
