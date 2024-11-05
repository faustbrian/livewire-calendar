<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Data;

use BaseCodeOy\LivewireCalendar\Contracts\EventInterface;
use Carbon\Carbon;
use Illuminate\Support\Traits\Macroable;

final class Event implements EventInterface
{
    use Macroable;

    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $href,
        public Carbon $startTime,
        public Carbon $endTime,
        public ?string $priority = null,
        public array $meta = [],
    ) {
        //
    }

    public function getTime(string $dateTimeFormat): string
    {
        return $this->startTime->format($dateTimeFormat);
    }

    public function getDateTime(): string
    {
        return $this->startTime->toIso8601ZuluString();
    }

    public function getStartTimeForHumans(string $dateTimeFormat): string
    {
        return $this->startTime->format($dateTimeFormat);
    }

    public function getEndTimeForHumans(string $dateTimeFormat): string
    {
        return $this->endTime->format($dateTimeFormat);
    }

    /**
     * This function makes use of the start and end times of the event with minutes,
     * calculates the grid-row value and duration in grid units (1 unit per 5 minutes),
     * and outputs the result as a string that can be used as a CSS property.
     */
    public function calculateGridRow(): string
    {
        // Return the grid-row value and span as a CSS property
        return \sprintf(
            'grid-row: %s / span %s;',
            // Calculate the grid-row value for the start time
            ($this->startTime->format('G') * 12) + (int) ($this->startTime->format('i') / 5) + 2,
            // Calculate the duration in minutes and convert it to grid units (12 units per hour)
            (int) (($this->endTime->getTimestamp() - $this->startTime->getTimestamp()) / 60 / 5),
        );
    }
}
