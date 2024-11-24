<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Data;

use BaseCodeOy\LivewireCalendar\Data\Day;
use Carbon\Carbon;

it('can determine if today', function (): void {
    $today = Carbon::today();
    $day = new Day($today, true, true);

    expect($day->isToday())->toBeTrue();
});

it('can get short name', function (): void {
    $date = Carbon::create(2_023, 4, 22);
    $day = new Day($date, true, false);

    expect($day->getShortName())->toBe('Sat');
});

it('can get character', function (): void {
    $date = Carbon::create(2_023, 4, 22);
    $day = new Day($date, true, false);

    expect($day->getCharacter())->toBe('S');
});

it('can get character suffix', function (): void {
    $date = Carbon::create(2_023, 4, 22);
    $day = new Day($date, true, false);

    expect($day->getCharacterSuffix())->toBe('at');
});

it('can get number', function (): void {
    $date = Carbon::create(2_023, 4, 22);
    $day = new Day($date, true, false);

    expect($day->getNumber())->toBe('22');
});

it('can be initialized with isCurrentMonth, isToday, and isSelected properties', function (): void {
    $date = Carbon::create(2_023, 4, 22);
    $day = new Day($date, true, false, true);

    expect($day->date)->toBe($date);
    expect($day->isCurrentMonth)->toBeTrue();
    expect($day->isToday)->toBeFalse();
    expect($day->isSelected)->toBeTrue();
});
