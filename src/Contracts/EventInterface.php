<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar\Contracts;

use Carbon\Carbon;

/**
 * @property string  $id
 * @property string  $name
 * @property string  $description
 * @property string  $href
 * @property Carbon  $startTime
 * @property Carbon  $endTime
 * @property ?string $priority
 * @property array   $meta
 */
interface EventInterface
{
    public function time(string $dateTimeFormat): string;

    public function dateTime(): string;

    public function startTimeHuman(string $dateTimeFormat): string;

    public function endTimeHuman(string $dateTimeFormat): string;

    public function calculateGridRow(): string;
}
