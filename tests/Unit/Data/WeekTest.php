<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BombenProdukt\LivewireCalendar\Data\Day;
use BombenProdukt\LivewireCalendar\Data\Week;
use Carbon\Carbon;
use Illuminate\Support\Collection;

it('can be initialized with properties', function (): void {
    $day = new Day(Carbon::today(), true, true);
    $days = new Collection([$day]);
    $week = new Week($days);

    expect($week->days)->toBe($days);
});
