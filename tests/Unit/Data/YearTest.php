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
use BaseCodeOy\LivewireCalendar\Data\Year;
use Illuminate\Support\Collection;

it('can be initialized with properties', function (): void {
    $week = new Week(new Collection());
    $month = new Month(4, new Collection([$week]));
    $months = new Collection([$month]);
    $year = new Year($months);

    expect($year->months)->toBe($months);
});
