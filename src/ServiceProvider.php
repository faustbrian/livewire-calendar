<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar;

use BombenProdukt\LivewireCalendar\Data\Day;
use BombenProdukt\LivewireCalendar\Data\Event;
use BombenProdukt\LivewireCalendar\Data\Month;
use BombenProdukt\LivewireCalendar\Data\Week;
use BombenProdukt\LivewireCalendar\Data\Year;
use BombenProdukt\PackagePowerPack\Package\AbstractServiceProvider;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        Calendar::createEventUsing(Event::class);
        Calendar::createDayUsing(Day::class);
        Calendar::createMonthUsing(Month::class);
        Calendar::createWeekUsing(Week::class);
        Calendar::createYearUsing(Year::class);
    }
}
