<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar;

use Livewire\Livewire;
use PreemStudio\Jetpack\Package\AbstractServiceProvider;
use PreemStudio\LivewireCalendar\Http\Livewire\Calendar;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        Livewire::component('calendar', Calendar::class);
    }
}
