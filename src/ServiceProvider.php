<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar;

use BaseCodeOy\LivewireCalendar\Data\Day;
use BaseCodeOy\LivewireCalendar\Data\DayLabel;
use BaseCodeOy\LivewireCalendar\Data\Event;
use BaseCodeOy\LivewireCalendar\Data\Month;
use BaseCodeOy\LivewireCalendar\Data\TimeLabel;
use BaseCodeOy\LivewireCalendar\Data\Week;
use BaseCodeOy\LivewireCalendar\Data\Year;
use BaseCodeOy\PackagePowerPack\Package\AbstractServiceProvider;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        Calendar::createEventUsing(Event::class);

        Calendar::createDayUsing(Day::class);
        Calendar::createMonthUsing(Month::class);
        Calendar::createWeekUsing(Week::class);
        Calendar::createYearUsing(Year::class);

        Calendar::createDayLabelUsing(DayLabel::class);
        Calendar::createTimeLabelUsing(TimeLabel::class);
    }
}
