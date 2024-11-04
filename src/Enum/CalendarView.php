<?php

declare(strict_types=1);

namespace BaseCodeOy\LivewireCalendar\Enum;

enum CalendarView: string
{
    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';

    case YEAR = 'year';

    public function getLabel(): string
    {
        return match ($this) {
            self::DAY => __('Day'),
            self::WEEK => __('Week'),
            self::MONTH => __('Month'),
            self::YEAR => __('Year'),
        };
    }

    public function getViewLabel(): string
    {
        return match ($this) {
            self::DAY => __('Day view'),
            self::WEEK => __('Week view'),
            self::MONTH => __('Month view'),
            self::YEAR => __('Year view'),
        };
    }
}
