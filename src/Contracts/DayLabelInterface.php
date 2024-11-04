<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Contracts;

/**
 * @property string $name
 */
interface DayLabelInterface
{
    public function getName(): string;

    public function getCharacter(): string;

    public function getCharacterSuffix(): string;
}
