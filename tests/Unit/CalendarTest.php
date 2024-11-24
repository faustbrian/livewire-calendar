<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit;

use BaseCodeOy\LivewireCalendar\Calendar;
use BaseCodeOy\LivewireCalendar\Data\Day;
use BaseCodeOy\LivewireCalendar\Data\Event;
use BaseCodeOy\LivewireCalendar\Data\Month;
use BaseCodeOy\LivewireCalendar\Data\Week;
use BaseCodeOy\LivewireCalendar\Data\Year;
use Carbon\Carbon;
use Illuminate\Support\Collection;

it('can create an event instance', function (): void {
    $actual = Calendar::createEvent(
        id: '1',
        name: 'Test Event',
        description: 'Test Description',
        href: 'https://example.com',
        startTime: Carbon::now(),
        endTime: Carbon::now(),
    );

    expect($actual)->toBeInstanceOf(Event::class);
});

it('can create a day instance', function (): void {
    $actual = Calendar::createDay(
        date: Carbon::today(),
        isCurrentMonth: true,
        isToday: true,
    );

    expect($actual)->toBeInstanceOf(Day::class);
});

it('can create a week instance', function (): void {
    $actual = Calendar::createWeek(
        days: new Collection(),
    );

    expect($actual)->toBeInstanceOf(Week::class);
});

it('can create a month instance', function (): void {
    $actual = Calendar::createMonth(
        number: 1,
        weeks: new Collection(),
    );

    expect($actual)->toBeInstanceOf(Month::class);
});

it('can create a year instance', function (): void {
    $actual = Calendar::createYear(
        months: new Collection(),
    );

    expect($actual)->toBeInstanceOf(Year::class);
});
