<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Data;

use BaseCodeOy\LivewireCalendar\Data\TimeLabel;
use Carbon\Carbon;

it('can convert to string', function (): void {
    $dateTime = Carbon::create(2_023, 4, 22, 12, 0, 0);
    $timeLabel = new TimeLabel($dateTime, 'g:i A');

    expect($timeLabel->toString())->toBe('12:00 PM');
});

it('can be initialized with properties', function (): void {
    $dateTime = Carbon::create(2_023, 4, 22, 12, 0, 0);
    $timeLabel = new TimeLabel($dateTime, 'g:i A');

    // Use reflection to access the private properties for testing
    $reflection = new \ReflectionClass(TimeLabel::class);
    $dateTimeFormatProperty = $reflection->getProperty('dateTimeFormat');
    $dateTimeFormatProperty->setAccessible(true);
    $dateTimeProperty = $reflection->getProperty('dateTime');
    $dateTimeProperty->setAccessible(true);

    expect($dateTimeFormatProperty->getValue($timeLabel))->toBe('g:i A');
    expect($dateTimeProperty->getValue($timeLabel))->toBe($dateTime);
});
