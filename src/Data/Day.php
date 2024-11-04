<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Data;

use BaseCodeOy\LivewireCalendar\Contracts\DayInterface;
use Carbon\Carbon;
use Illuminate\Support\Traits\Macroable;

final class Day implements DayInterface
{
    use Macroable;

    public function __construct(
        public Carbon $date,
        public bool $isCurrentMonth,
        public bool $isToday,
        public bool $isSelected = false,
    ) {
        //
    }

    public function getShortName(): string
    {
        return $this->date->format('D');
    }

    public function getCharacter(): string
    {
        return \mb_strtoupper(\mb_substr($this->getShortName(), 0, 1));
    }

    public function getCharacterSuffix(): string
    {
        return \mb_substr($this->getShortName(), 1);
    }

    public function getNumber(): string
    {
        return $this->date->format('d');
    }

    public function isToday(): bool
    {
        return $this->date->isToday();
    }
}
