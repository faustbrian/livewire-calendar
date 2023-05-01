<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BombenProdukt\LivewireCalendar\Data\Event;
use Carbon\Carbon;

it('can format time', function (): void {
    $startTime = Carbon::create(2023, 4, 22, 12, 0, 0);
    $event = new Event('1', 'Test Event', 'Test Description', 'https://example.com', $startTime, $startTime->clone()->addHour());

    expect($event->getTime('H:i'))->toBe('12:00');
});

it('can format date time', function (): void {
    $startTime = Carbon::create(2023, 4, 22, 12, 0, 0);
    $event = new Event('1', 'Test Event', 'Test Description', 'https://example.com', $startTime, $startTime->clone()->addHour());

    expect($event->getDateTime())->toBe($startTime->toIso8601ZuluString());
});

it('can format start time human', function (): void {
    $startTime = Carbon::create(2023, 4, 22, 12, 0, 0);
    $event = new Event('1', 'Test Event', 'Test Description', 'https://example.com', $startTime, $startTime->clone()->addHour());

    expect($event->getStartTimeForHumans('H:i'))->toBe('12:00');
});

it('can format end time human', function (): void {
    $startTime = Carbon::create(2023, 4, 22, 12, 0, 0);
    $endTime = $startTime->clone()->addHour();
    $event = new Event('1', 'Test Event', 'Test Description', 'https://example.com', $startTime, $endTime);

    expect($event->getEndTimeForHumans('H:i'))->toBe('13:00');
});

it('can calculate grid row', function (): void {
    $startTime = Carbon::create(2023, 4, 22, 12, 0, 0);
    $endTime = $startTime->clone()->addHour();
    $event = new Event('1', 'Test Event', 'Test Description', 'https://example.com', $startTime, $endTime);

    $expectedGridRow = 'grid-row: 146 / span 12;';
    expect($event->calculateGridRow())->toBe($expectedGridRow);
});

it('can be initialized with properties', function (): void {
    $startTime = Carbon::create(2023, 4, 22, 12, 0, 0);
    $endTime = $startTime->clone()->addHour();
    $event = new Event('1', 'Test Event', 'Test Description', 'https://example.com', $startTime, $endTime, 'high');

    expect($event->id)->toBe('1');
    expect($event->name)->toBe('Test Event');
    expect($event->description)->toBe('Test Description');
    expect($event->href)->toBe('https://example.com');
    expect($event->startTime)->toBe($startTime);
    expect($event->endTime)->toBe($endTime);
    expect($event->priority)->toBe('high');
});
