<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Data;

use BaseCodeOy\LivewireCalendar\Data\Month;
use BaseCodeOy\LivewireCalendar\Data\Week;
use Illuminate\Support\Collection;

it('can get name', function (): void {
    $week = new Week(new Collection());
    $month = new Month(4, new Collection([$week]));

    expect($month->getName())->toBe('April');
});

it('can be initialized with properties', function (): void {
    $week = new Week(new Collection());
    $weeks = new Collection([$week]);
    $month = new Month(4, $weeks);

    expect($month->number)->toBe(4);
    expect($month->weeks)->toBe($weeks);
});
