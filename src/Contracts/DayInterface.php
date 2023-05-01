<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Contracts;

use Carbon\Carbon;

/**
 * @property Carbon $date
 * @property bool   $isCurrentMonth
 * @property bool   $isToday
 * @property bool   $isSelected
 */
interface DayInterface
{
    public function getShortName(): string;

    public function getCharacter(): string;

    public function getCharacterSuffix(): string;

    public function getNumber(): string;

    public function isToday(): bool;
}
