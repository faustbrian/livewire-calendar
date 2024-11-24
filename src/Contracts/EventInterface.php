<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Contracts;

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
    public function getTime(string $dateTimeFormat): string;

    public function getDateTime(): string;

    public function getStartTimeForHumans(string $dateTimeFormat): string;

    public function getEndTimeForHumans(string $dateTimeFormat): string;

    public function calculateGridRow(): string;
}
