<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use Carbon\Carbon;
use PreemStudio\LivewireCalendar\Data\TimeLabel;
use ReflectionClass;

it('can convert to string', function (): void {
    $dateTime = Carbon::create(2023, 4, 22, 12, 0, 0);
    $timeLabel = new TimeLabel('g:i A', $dateTime);

    expect($timeLabel->toString())->toBe('12:00 PM');
});

it('can be initialized with properties', function (): void {
    $dateTime = Carbon::create(2023, 4, 22, 12, 0, 0);
    $timeLabel = new TimeLabel('g:i A', $dateTime);

    // Use reflection to access the private properties for testing
    $reflection = new ReflectionClass(TimeLabel::class);
    $dateTimeFormatProperty = $reflection->getProperty('dateTimeFormat');
    $dateTimeFormatProperty->setAccessible(true);
    $dateTimeProperty = $reflection->getProperty('dateTime');
    $dateTimeProperty->setAccessible(true);

    expect($dateTimeFormatProperty->getValue($timeLabel))->toBe('g:i A');
    expect($dateTimeProperty->getValue($timeLabel))->toBe($dateTime);
});
