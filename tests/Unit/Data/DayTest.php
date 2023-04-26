<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BombenProdukt\LivewireCalendar\Data\Day;
use Carbon\Carbon;

it('can determine if today', function (): void {
    $today = Carbon::today();
    $day = new Day($today, true, true);

    expect($day->isToday())->toBeTrue();
});

it('can get short name', function (): void {
    $date = Carbon::create(2023, 4, 22);
    $day = new Day($date, true, false);

    expect($day->shortName())->toBe('Sat');
});

it('can get character', function (): void {
    $date = Carbon::create(2023, 4, 22);
    $day = new Day($date, true, false);

    expect($day->character())->toBe('S');
});

it('can get character suffix', function (): void {
    $date = Carbon::create(2023, 4, 22);
    $day = new Day($date, true, false);

    expect($day->characterSuffix())->toBe('at');
});

it('can get number', function (): void {
    $date = Carbon::create(2023, 4, 22);
    $day = new Day($date, true, false);

    expect($day->number())->toBe('22');
});

it('can be initialized with isCurrentMonth, isToday, and isSelected properties', function (): void {
    $date = Carbon::create(2023, 4, 22);
    $day = new Day($date, true, false, true);

    expect($day->date)->toBe($date);
    expect($day->isCurrentMonth)->toBeTrue();
    expect($day->isToday)->toBeFalse();
    expect($day->isSelected)->toBeTrue();
});
