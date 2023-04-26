<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Data;

final readonly class DayLabel
{
    public function __construct(
        private string $name,
    ) {
        //
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCharacter(): string
    {
        return \mb_strtoupper(\mb_substr($this->name, 0, 1));
    }

    public function getCharacterSuffix(): string
    {
        return \mb_substr($this->name, 1, 2);
    }
}
