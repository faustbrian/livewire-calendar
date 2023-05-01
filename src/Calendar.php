<?php

declare(strict_types=1);

namespace BombenProdukt\LivewireCalendar;

use BombenProdukt\LivewireCalendar\Contracts\DayInterface;
use BombenProdukt\LivewireCalendar\Contracts\DayLabelInterface;
use BombenProdukt\LivewireCalendar\Contracts\EventInterface;
use BombenProdukt\LivewireCalendar\Contracts\MonthInterface;
use BombenProdukt\LivewireCalendar\Contracts\TimeLabelInterface;
use BombenProdukt\LivewireCalendar\Contracts\WeekInterface;
use BombenProdukt\LivewireCalendar\Contracts\YearInterface;
use Illuminate\Support\Facades\App;

final class Calendar
{
    public static function createEvent(mixed ...$parameters): EventInterface
    {
        return App::make(EventInterface::class, $parameters);
    }

    public static function createEventUsing(string $class): void
    {
        App::singleton(EventInterface::class, $class);
    }

    public static function createDay(mixed ...$parameters): DayInterface
    {
        return App::make(DayInterface::class, $parameters);
    }

    public static function createDayUsing(string $class): void
    {
        App::singleton(DayInterface::class, $class);
    }

    public static function createWeek(mixed ...$parameters): WeekInterface
    {
        return App::make(WeekInterface::class, $parameters);
    }

    public static function createWeekUsing(string $class): void
    {
        App::singleton(WeekInterface::class, $class);
    }

    public static function createMonth(mixed ...$parameters): MonthInterface
    {
        return App::make(MonthInterface::class, $parameters);
    }

    public static function createMonthUsing(string $class): void
    {
        App::singleton(MonthInterface::class, $class);
    }

    public static function createYear(mixed ...$parameters): YearInterface
    {
        return App::make(YearInterface::class, $parameters);
    }

    public static function createYearUsing(string $class): void
    {
        App::singleton(YearInterface::class, $class);
    }

    public static function createDayLabel(mixed ...$parameters): DayLabelInterface
    {
        return App::make(DayLabelInterface::class, $parameters);
    }

    public static function createDayLabelUsing(string $class): void
    {
        App::singleton(DayLabelInterface::class, $class);
    }

    public static function createTimeLabel(mixed ...$parameters): TimeLabelInterface
    {
        return App::make(TimeLabelInterface::class, $parameters);
    }

    public static function createTimeLabelUsing(string $class): void
    {
        App::singleton(TimeLabelInterface::class, $class);
    }
}
