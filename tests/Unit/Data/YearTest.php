<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use Illuminate\Support\Collection;
use PreemStudio\LivewireCalendar\Data\Month;
use PreemStudio\LivewireCalendar\Data\Week;
use PreemStudio\LivewireCalendar\Data\Year;

it('can be initialized with properties', function (): void {
    $week = new Week(new Collection());
    $month = new Month(4, new Collection([$week]));
    $months = new Collection([$month]);
    $year = new Year($months);

    expect($year->months)->toBe($months);
});
