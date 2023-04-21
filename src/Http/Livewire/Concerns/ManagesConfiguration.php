<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire\Concerns;

use Carbon\Carbon;

trait ManagesConfiguration
{
    public ?int $weekStartsAt = Carbon::MONDAY;

    public ?int $weekEndsAt = Carbon::SUNDAY;
}
