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

    public function monday(): Day
    {
        return $this->days->first();
    }

    public function tuesday(): Day
    {
        return $this->days->get(1);
    }

    public function wednesday(): Day
    {
        return $this->days->get(2);
    }

    public function thursday(): Day
    {
        return $this->days->get(3);
    }

    public function friday(): Day
    {
        return $this->days->get(4);
    }

    public function saturday(): Day
    {
        return $this->days->get(5);
    }

    public function sunday(): Day
    {
        return $this->days->last();
    }
}
