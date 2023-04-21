<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire\Concerns;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Collection;
use PreemStudio\LivewireCalendar\Data\Day;
use PreemStudio\LivewireCalendar\Data\Month;
use PreemStudio\LivewireCalendar\Data\Week;
use PreemStudio\LivewireCalendar\Data\Year;

trait ManagesGrid
{
    public function getYear(): Year
    {
        return new Year(
            collect(
                CarbonPeriod::create(
                    $this->selectedDateTime->clone()->startOfYear()->startOfWeek($this->weekStartsAt),
                    '1 month',
                    $this->selectedDateTime->clone()->endOfYear()->endOfWeek($this->weekEndsAt)->startOfDay(),
                ),
            )->mapWithKeys(fn (Carbon $month) => [
                $month->month => $this->monthGrid($month->month, $month->clone()->startOfMonth(), $month->clone()->endOfMonth()),
            ]),
        );
    }

    public function monthGrid(int $month, Carbon $startsAt, Carbon $endsAt): Month
    {
        $firstDayOfGrid = $startsAt->clone()->startOfWeek($this->weekStartsAt);
        $lastDayOfGrid = $endsAt->clone()->endOfWeek($this->weekEndsAt);

        $diffInWeeks = $lastDayOfGrid->diffInWeeks($firstDayOfGrid);

        if ($lastDayOfGrid->diffInWeeks($firstDayOfGrid) !== 6) {
            $lastDayOfGrid = $lastDayOfGrid->addWeeks(6 - $diffInWeeks);
        }

        $numbersOfWeeks = $lastDayOfGrid->diffInWeeks($firstDayOfGrid) + 1;
        $days = $lastDayOfGrid->diffInDays($firstDayOfGrid) + 1;

        if ($days % 7 !== 0) {
            throw new Exception('Livewire Calendar not correctly configured. Check initial inputs.');
        }

        $monthGrid = new Collection();
        $currentDay = $firstDayOfGrid->clone();

        while (!$currentDay->greaterThan($lastDayOfGrid)) {
            $monthGrid->push(
                new Day(
                    date: $currentDay->clone(),
                    isCurrentMonth: $currentDay->month === $month,
                    isToday: $currentDay->isToday(),
                ),
            );

            $currentDay->addDay();
        }

        $monthGrid = $monthGrid->chunk(7);

        if ($numbersOfWeeks !== $monthGrid->count()) {
            throw new Exception('Livewire Calendar calculated wrong number of weeks. Sorry :(');
        }

        $monthGrid->pop();

        return new Month($month, $monthGrid->map(fn (Collection $days) => new Week($days->values())));
    }
}
