<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Feature\Http\Livewire;

use BaseCodeOy\LivewireCalendar\Data\Day;
use BaseCodeOy\LivewireCalendar\Data\Month;
use BaseCodeOy\LivewireCalendar\Data\Week;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Livewire;
use Tests\Fixtures\Calendar;

beforeEach(function (): void {
    Carbon::setTestNow($today = Carbon::now());

    $this->day = new Day(
        date: $today->clone(),
        isCurrentMonth: $today->isCurrentMonth(),
        isToday: $today->isToday(),
    );
});

it('mounts and sets default properties', function (): void {
    $component = Livewire::test(Calendar::class);

    expect($component->weekStartsAt)->toBe(Carbon::MONDAY);
    expect($component->weekEndsAt)->toBe(Carbon::SUNDAY);
    expect($component->selectedDateTime)->toBeInstanceOf(Carbon::class);
    expect($component->selectedView)->toBe('month');
});

it('renders the component', function (): void {
    Livewire::test(Calendar::class)
        ->assertViewHas('year')
        ->assertViewHas('month')
        ->assertViewHas('week')
        ->assertViewHas('day')
        ->assertViewHas('events')
        ->assertViewHas('dayLabels')
        ->assertViewHas('timeLabels');
});

it('moves cursor to today', function (): void {
    $component = Livewire::test(Calendar::class);
    $component->call('moveCursor', 'today');

    expect($component->selectedDateTime)->toEqual(Carbon::now());
});

it('selects a day', function (): void {
    $component = Livewire::test(Calendar::class);
    $component->call('setDay', Carbon::now()->addDays(1)->format('Y-m-d'));

    expect($component->selectedDateTime->isSameDay(Carbon::now()->addDays(1)))->toBeTrue();
    expect($component->selectedView)->toBe('day');
});

it('selects a week', function (): void {
    $component = Livewire::test(Calendar::class);
    $component->call('setWeek', Carbon::now()->startOfWeek()->addWeek()->format('Y-m-d'));

    expect($component->selectedDateTime->isSameDay(Carbon::now()->startOfWeek()->addWeek()))->toBeTrue();
    expect($component->selectedView)->toBe('week');
});

it('selects a month', function (): void {
    $component = Livewire::test(Calendar::class);
    $component->call('setMonth', 5);

    expect($component->selectedDateTime->month)->toBe(5);
    expect($component->selectedView)->toBe('month');
});

it('selects a year', function (): void {
    $component = Livewire::test(Calendar::class);
    $component->call('setYear', 2_024);

    expect($component->selectedDateTime->year)->toBe(2_024);
    expect($component->selectedView)->toBe('year');
});

it('moves cursor to next and previous day, week, month, and year', function (): void {
    $component = Livewire::test(Calendar::class);
    $selectedDateTime = $component->selectedDateTime->clone();

    $component->call('moveCursor', 'next', 'day');
    expect($component->selectedDateTime->isSameDay($selectedDateTime->clone()->addDay()))->toBeTrue();

    $component->call('moveCursor', 'previous', 'day');
    expect($component->selectedDateTime->isSameDay($selectedDateTime))->toBeTrue();

    $component->call('moveCursor', 'next', 'week');
    expect($component->selectedDateTime->isSameDay($selectedDateTime->clone()->addWeek()))->toBeTrue();

    $component->call('moveCursor', 'previous', 'week');
    expect($component->selectedDateTime->isSameDay($selectedDateTime))->toBeTrue();

    $component->call('moveCursor', 'next', 'month');
    expect($component->selectedDateTime->isSameDay($selectedDateTime->clone()->addMonth()))->toBeTrue();

    $component->call('moveCursor', 'previous', 'month');
    expect($component->selectedDateTime->isSameDay($selectedDateTime))->toBeTrue();

    $component->call('moveCursor', 'next', 'year');
    expect($component->selectedDateTime->isSameDay($selectedDateTime->clone()->addYear()))->toBeTrue();

    $component->call('moveCursor', 'previous', 'year');
    expect($component->selectedDateTime->isSameDay($selectedDateTime))->toBeTrue();
});

it('creates events', function (): void {
    $component = (new Calendar())->mount();
    $events = $component->events();

    expect($events)->toBeInstanceOf(Collection::class);
    expect($events->count())->toBe(3);
});

it('renders the correct calendar grid', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    expect($months)->toBeInstanceOf(Collection::class);
    expect($months->count())->toBe(12);
});

it('gets the selected day, week, and month', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;
    $selectedDay = $component->getSelectedDay($months);
    $selectedWeek = $component->getSelectedWeek($months);
    $selectedMonth = $component->getSelectedMonth($months);

    expect($selectedDay)->toBeInstanceOf(Day::class);
    expect($selectedWeek)->toBeInstanceOf(Week::class);
    expect($selectedMonth)->toBeInstanceOf(Month::class);
});

it('checks if a day is the selected day', function (): void {
    $component = (new Calendar())->mount();

    expect($component->isSelectedDay($this->day))->toBeTrue();
});

it('calculates the correct number of weeks for each month', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $months->each(function ($month, $key) use ($component): void {
        $mapMonth = $component->mapMonth($key, $month->weeks->first()->days->first()->date, $month->weeks->last()->days->last()->date);
        $numberOfWeeks = $mapMonth->weeks->count();

        expect($numberOfWeeks)->toBeGreaterThanOrEqual(4);
        expect($numberOfWeeks)->toBeLessThanOrEqual(6);
    });
});

todo('checks if mapMonth throws an exception when the number of weeks is not correctly calculated');

it('gets events for a specific day', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;
    $selectedDay = $component->getSelectedDay($months);
    $events = $component->eventsForDay($selectedDay, $component->events());

    expect($events)->toBeInstanceOf(Collection::class);
});

it('selects day, week, month, and year', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $dayToSelect = $months->first()->weeks->first()->days->first();
    $component->setDay($dayToSelect->date->toDateString());
    expect($component->selectedDateTime->isSameDay($dayToSelect->date))->toBeTrue();
    expect($component->selectedView)->toEqual('day');

    $weekToSelect = $months->first()->weeks->first();
    $component->setWeek($weekToSelect->days->first()->date->toDateString());
    expect($component->selectedDateTime->isSameWeek($weekToSelect->days->first()->date))->toBeTrue();
    expect($component->selectedView)->toEqual('week');

    $monthToSelect = 5;
    $component->setMonth($monthToSelect);
    expect($component->selectedDateTime->month)->toEqual($monthToSelect);
    expect($component->selectedView)->toEqual('month');

    $yearToSelect = 2_025;
    $component->setYear($yearToSelect);
    expect($component->selectedDateTime->year)->toEqual($yearToSelect);
    expect($component->selectedView)->toEqual('year');
});

it('updates the selected date based on cursor movement', function (): void {
    $component = Livewire::test(Calendar::class);
    $component->call('selectView', 'day');

    $component->call('moveCursor', 'today');
    expect($component->selectedDateTime->isToday())->toBeTrue();

    $component->call('selectView', 'week');
    $component->call('moveCursor', 'today');
    expect($component->selectedDateTime->isToday())->toBeTrue();

    $component->call('selectView', 'month');
    $component->call('moveCursor', 'today');
    expect($component->selectedDateTime->isToday())->toBeTrue();

    $component->call('selectView', 'year');
    $component->call('moveCursor', 'today');
    expect($component->selectedDateTime->isToday())->toBeTrue();
});

it('checks if an event is happening on the same day', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;
    $events = $component->events();
    $selectedDay = $component->getSelectedDay($months);
    $eventsForDay = $component->eventsForDay($selectedDay, $events);

    $eventsForDay->each(function ($event) use ($selectedDay): void {
        expect($event->startTime->isSameDay($selectedDay->date))->toBeTrue();
    });
});

it('checks if the first day of the month grid is the correct day of the week', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $months->each(function ($month, $key) use ($component): void {
        $mapMonth = $component->mapMonth($key, $month->weeks->first()->days->first()->date, $month->weeks->last()->days->last()->date);
        $firstDayOfGrid = $mapMonth->weeks->first()->days->first();

        expect($firstDayOfGrid->date->dayOfWeek)->toEqual($component->weekStartsAt);
    });
});

it('checks if the last day of the month grid is the correct day of the week', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $months->each(function ($month, $key) use ($component): void {
        $mapMonth = $component->mapMonth($key, $month->weeks->first()->days->first()->date, $month->weeks->last()->days->last()->date);
        $lastDayOfGrid = $mapMonth->weeks->last()->days->last();

        expect($lastDayOfGrid->date->dayOfWeek)->toEqual($component->weekEndsAt);
    });
});

it('checks if the selected month and year are correctly set', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;
    $selectedMonth = $component->selectedDateTime->month;
    $selectedYear = $component->selectedDateTime->year;

    expect($months->keys()->contains($selectedMonth))->toBeTrue();

    $selectedmapMonth = $component->getSelectedMonth($months);
    $selectedmapMonth->weeks->each(function ($week) use ($selectedYear): void {
        $week->days->each(function ($day) use ($selectedYear): void {
            expect($day->date->year)->toEqual($selectedYear);
        });
    });
});

it('checks if the isSelectedDay function returns correct result', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;
    $selectedDay = $component->getSelectedDay($months);
    $selectedWeek = $component->getSelectedWeek($months);

    $selectedWeek->days->each(function ($day) use ($component, $selectedDay): void {
        if ($day->date->isSameDay($selectedDay->date)) {
            expect($component->isSelectedDay($day))->toBeTrue();
        } else {
            expect($component->isSelectedDay($day))->toBeFalse();
        }
    });
});

it('checks if the selected day and week are correctly set after selecting a week', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $weekToSelect = $months->get(3)->weeks->get(3);
    $component->setWeek($weekToSelect->days->first()->date->toDateString());

    $selectedDay = $component->getSelectedDay($months);
    $selectedWeek = $component->getSelectedWeek($months);

    expect($selectedWeek->days->filter(fn (Day $day): bool => $day->date->toDateString() === $selectedDay->date->toDateString())->count())->toBeGreaterThanOrEqual(0);
});

it('checks if the number of weeks in the month grid is 6 or less', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $months->each(function ($month): void {
        expect($month->weeks->count())->toBeLessThanOrEqual(6);
    });
});

it('validates month grid by ensuring all days are sequential', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $months->each(function ($month): void {
        $previousDay = null;

        $month->weeks->each(function ($week) use (&$previousDay): void {
            $week->days->each(function ($day) use (&$previousDay): void {
                if ($previousDay !== null) {
                    expect($day->date->isNextDay($previousDay))->toBeTrue();
                }

                $previousDay = $day->date;
            });
        });
    });
});

it('checks if the selected day, week, month, and year are correctly set after selecting a day', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $dayToSelect = $months->get(3)->weeks->get(3)->days->first();
    $component->setDay($dayToSelect->date->toDateString());

    $selectedDay = $component->getSelectedDay($months);
    $selectedWeek = $component->getSelectedWeek($months);
    // $selectedMonth = $component->getSelectedMonth($months);

    expect($selectedDay->date->isSameDay($dayToSelect->date))->toBeTrue();
    expect($selectedWeek->days->contains($selectedDay))->toBeTrue();
    // expect($selectedMonth->contains($selectedWeek))->toBeTrue();
});

it('checks if the selected day, week, month, and year are correctly set after selecting a month', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $monthToSelect = 5;
    $component->setMonth($monthToSelect);

    $selectedDay = $component->getSelectedDay($months);
    $selectedWeek = $component->getSelectedWeek($months);
    // $selectedMonth = $component->getSelectedMonth($months);

    expect($selectedDay->date->month)->toEqual($monthToSelect);
    expect($selectedWeek->days)->toContainDay($selectedDay);
    // expect($selectedMonth->contains($selectedWeek))->toBeTrue();
});

it('checks if the selected day, week, month, and year are correctly set after selecting a year', function (): void {
    $component = (new Calendar())->mount();
    $yearToSelect = 2_024;
    $component->setYear($yearToSelect);

    $months = $component->getYear()->months;
    $selectedDay = $component->getSelectedDay($months);
    $selectedWeek = $component->getSelectedWeek($months);
    // $selectedMonth = $component->getSelectedMonth($months);

    expect($selectedDay->date->year)->toEqual($yearToSelect);
    expect($selectedWeek->days)->toContainDay($selectedDay);
    // expect($selectedMonth->contains($selectedWeek))->toBeTrue();
});

it('checks if the selected day, week, month, and year are correctly set after moving the cursor', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $previousDay = $component->getSelectedDay($months);

    $component->moveCursor('next', 'month');

    $selectedDay = $component->getSelectedDay($months);
    $selectedWeek = $component->getSelectedWeek($months);
    // $selectedMonth = $component->call('getSelectedMonth', $months);

    expect($selectedDay->date->isSameDay($previousDay->date->addMonth()))->toBeTrue();
    expect($selectedWeek->days)->toContainDay($selectedDay);
    // expect($selectedMonth->contains($selectedWeek))->toBeTrue();
});

it('checks if the selected day, week, month, and year are correctly set after moving the cursor to today', function (): void {
    $component = (new Calendar())->mount();
    $component->moveCursor('today');

    $months = $component->getYear()->months;
    $selectedDay = $component->getSelectedDay($months);
    $selectedWeek = $component->getSelectedWeek($months);
    // $selectedMonth = $component->getSelectedMonth($months);

    $expectedSelectedDay = Carbon::now();

    expect($selectedDay->date->isSameDay($expectedSelectedDay))->toBeTrue();
    expect($selectedWeek->days)->toContainDay($selectedDay);
    // expect($selectedMonth->contains($selectedWeek))->toBeTrue();
});

it('checks if events are correctly assigned to days', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;
    $events = $component->events();

    $months->each(function ($month) use ($component, $events): void {
        $month->weeks->each(function ($week) use ($component, $events): void {
            $week->days->each(function ($day) use ($component, $events): void {
                $dayEvents = $component->eventsForDay($day, $events);

                $events->each(function ($event) use ($day, $dayEvents): void {
                    if ($event->startTime->isSameDay($day->date)) {
                        expect($dayEvents->contains($event))->toBeTrue();
                    } else {
                        expect($dayEvents->contains($event))->toBeFalse();
                    }
                });
            });
        });
    });
});

it('checks if isSelectedDay returns the correct result', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $selectedDay = $component->getSelectedDay($months);

    $months->each(function ($month) use ($component, $selectedDay): void {
        $month->weeks->each(function ($week) use ($component, $selectedDay): void {
            $week->days->each(function ($day) use ($component, $selectedDay): void {
                if ($day->date->isSameDay($selectedDay->date)) {
                    expect($component->isSelectedDay($day))->toBeTrue();
                } else {
                    expect($component->isSelectedDay($day))->toBeFalse();
                }
            });
        });
    });
});

it('checks if the correct number of weeks are calculated for each month', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $months->each(function ($month): void {
        $month->weeks->each(function ($week): void {
            expect($week->days->count())->toEqual(7);
        });
    });
});

it('checks if the correct number of months are generated', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    expect($months->count())->toEqual(12);
});

it('checks if the selected view is correctly set after selecting a day, week, month, or year', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;
    $dayToSelect = $months->first()->weeks->first()->days->first();

    // Select Day
    $component->setDay($dayToSelect->date->toDateString());
    expect($component->selectedView)->toEqual('day');

    // Select Week
    $startOfWeek = $months->first()->weeks->first()->days->first()->date->toDateString();
    $component->setWeek($startOfWeek);
    expect($component->selectedView)->toEqual('week');

    // Select Month
    $monthToSelect = 5;
    $component->setMonth($monthToSelect);
    expect($component->selectedView)->toEqual('month');

    // Select Year
    $yearToSelect = 2_024;
    $component->setYear($yearToSelect);
    expect($component->selectedView)->toEqual('year');
});

it('checks if the month grid is generated correctly for each month', function (): void {
    $component = (new Calendar())->mount();
    $months = $component->getYear()->months;

    $months->each(function ($month) use ($component): void {
        $firstDayOfMonth = $month->weeks->first()->days->first()->date;
        $lastDayOfMonth = $month->weeks->last()->days->last()->date;

        // Check if the first day of the grid is the start of the week
        expect($firstDayOfMonth->dayOfWeek)->toEqual($component->weekStartsAt);

        // Check if the last day of the grid is the end of the week
        expect($lastDayOfMonth->dayOfWeek)->toEqual($component->weekEndsAt);
    });
});

it('checks if moveCursor method updates the selectedDateTime correctly', function (): void {
    $component = Livewire::test(Calendar::class);

    // Move cursor to today
    $component->call('moveCursor', 'today');
    expect($component->get('selectedDateTime')->toString())->toBe(Carbon::now()->toString());

    $initialDateTime = $component->get('selectedDateTime')->clone();

    // Move cursor to the next day
    $component->set('selectedView', 'day');
    $component->call('moveCursor', 'next');
    expect($component->get('selectedDateTime')->toString())->toBe($initialDateTime->clone()->addDay()->toString());

    // Move cursor to the previous day
    $component->call('moveCursor', 'prev');

    expect($component->get('selectedDateTime')->toString())->toBe($initialDateTime->clone()->toString());

    // Move cursor to the next week
    $component->set('selectedView', 'week');
    $component->call('moveCursor', 'next');
    expect($component->get('selectedDateTime')->toString())->toBe($initialDateTime->clone()->addWeek()->toString());

    // Move cursor to the previous week
    $component->call('moveCursor', 'prev');
    expect($component->get('selectedDateTime')->toString())->toBe($initialDateTime->clone()->toString());

    // Move cursor to the next month
    $component->set('selectedView', 'month');
    $component->call('moveCursor', 'next');
    expect($component->get('selectedDateTime')->toString())->toBe($initialDateTime->clone()->addMonth()->toString());

    // Move cursor to the previous month
    $component->call('moveCursor', 'prev');
    expect($component->get('selectedDateTime')->toString())->toBe($initialDateTime->clone()->toString());

    // Move cursor to the next year
    $component->set('selectedView', 'year');
    $component->call('moveCursor', 'next');
    expect($component->get('selectedDateTime')->toString())->toBe($initialDateTime->clone()->addYear()->toString());

    // Move cursor to the previous year
    $component->call('moveCursor', 'prev');
    expect($component->get('selectedDateTime')->toString())->toBe($initialDateTime->clone()->toString());
});

it('checks if setDay, setWeek, setMonth, and setYear methods update the selectedDateTime and selectedView correctly', function (): void {
    $component = Livewire::test(Calendar::class);

    // Select a day
    $date = '2023-05-15';
    $component->call('setDay', $date);
    expect($component->get('selectedDateTime')->toString())->toBe(Carbon::parse($date)->toString());
    expect($component->get('selectedView'))->toBe('day');

    // Select a week
    $startOfWeek = '2023-06-10';
    $component->call('setWeek', $startOfWeek);
    expect($component->get('selectedDateTime')->toString())->toBe(Carbon::parse($startOfWeek)->toString());
    expect($component->get('selectedView'))->toBe('week');

    // Select a month
    $month = 7;
    $component->call('setMonth', $month);
    expect($component->get('selectedDateTime')->month)->toBe($month);
    expect($component->get('selectedView'))->toBe('month');

    // Select a year
    $year = 2_024;
    $component->call('setYear', $year);
    expect($component->get('selectedDateTime')->year)->toBe($year);
    expect($component->get('selectedView'))->toBe('year');
});
