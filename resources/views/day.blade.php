<div class="isolate flex flex-auto overflow-hidden bg-white">
    <div class="flex flex-auto flex-col overflow-auto">
        <div
            class="sticky top-0 z-10 grid flex-none grid-cols-7 bg-white text-xs text-gray-500 shadow ring-1 ring-black ring-opacity-5 md:hidden">
            @foreach ($week->days as $weekDay)
                <button
                    class="flex flex-col items-center pb-1.5 pt-3"
                    type="button"
                >
                    <span>
                        {{ $weekDay->getCharacter() }}
                    </span>

                    <span
                        @class([
                            'mt-3 flex h-8 w-8 items-center justify-center rounded-full text-base font-semibold text-gray-900',
                            'bg-gray-900 text-white' => $this->isSelectedDay($weekDay),
                            'bg-indigo-600 text-white' => $weekDay->isToday(),
                            'text-indigo-600' => $weekDay->isToday() && !$this->isSelectedDay($weekDay),
                        ])
                        wire:click="setDay('{{ $weekDay->date }}')"
                    >
                        {{ $day->getNumber() }}
                    </span>
                </button>
            @endforeach
        </div>

        <div class="flex w-full flex-auto">
            <div class="w-14 flex-none bg-white ring-1 ring-gray-100"></div>

            <div class="grid flex-auto grid-cols-1 grid-rows-1">
                <div
                    class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100"
                    style="grid-template-rows: repeat(48, minmax(3.5rem, 1fr))"
                >
                    <div class="row-end-1 h-7"></div>

                    @foreach ($timeLabels as $timeLabel)
                        @unless ($loop->first)
                            <div></div>
                        @endunless

                        <div>
                            <div
                                class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-gray-400">
                                {{ $timeLabel->toString() }}
                            </div>
                        </div>

                        @if ($loop->last)
                            <div></div>
                        @endif
                    @endforeach
                </div>

                <ol
                    class="col-start-1 col-end-2 row-start-1 grid grid-cols-1"
                    style="grid-template-rows: 1.75rem repeat(288, minmax(0, 1fr)) auto"
                >
                    @foreach ($this->eventsForDay($day, $events) as $event)
                        <li
                            class="relative mt-px flex"
                            style="{{ $event->calculateGridRow() }}"
                        >
                            <span
                                class="group absolute inset-1 flex cursor-pointer flex-col overflow-y-auto rounded-lg bg-blue-50 p-2 text-xs leading-5 hover:bg-blue-100"
                                wire:click="onEventClick('{{ $event->id }}')"
                            >
                                <p class="order-1 font-semibold text-blue-700">
                                    {{ $event->name }}
                                </p>

                                @if ($event->description)
                                    <p class="order-1 text-blue-500 group-hover:text-blue-700">
                                        {{ $event->description }}
                                    </p>
                                @endif

                                <p class="text-blue-500 group-hover:text-blue-700">
                                    <time datetime="{{ $event->getDateTime() }}">
                                        {{ $event->getStartTimeForHumans($formatEventTime) }}
                                    </time>
                                </p>
                            </span>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <div class="hidden w-1/2 max-w-md flex-none border-l border-gray-100 px-8 py-10 md:block">
        <div class="flex items-center text-center text-gray-900">
            <button
                class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                type="button"
                wire:click="moveCursor('previous', 'month')"
            >
                <span class="sr-only">Previous month</span>
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>
            <div class="flex-auto text-sm font-semibold">
                {{ $selectedDateTime->format(config('livewire-calendar.formats.month_year')) }}
            </div>
            <button
                class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                type="button"
                wire:click="moveCursor('next', 'month')"
            >
                <span class="sr-only">Next month</span>
                <svg
                    class="h-5 w-5"
                    aria-hidden="true"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>
        </div>
        <div class="mt-6 grid grid-cols-7 text-center text-xs leading-6 text-gray-500">
            @foreach ($dayLabels as $dayLabel)
                <div>{{ $dayLabel->getCharacter() }}</div>
            @endforeach
        </div>
        <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
            @foreach ($month->weeks as $week)
                @foreach ($week->days as $dayIdx => $day)
                    <button
                        type="button"
                        @class([
                            'bg-white' => $day->isCurrentMonth,
                            'bg-gray-50' => !$day->isCurrentMonth,
                            'font-semibold' => $this->isSelectedDay($day) || $day->isToday,
                            'text-white' => $this->isSelectedDay($day),
                            'text-gray-900' =>
                                !$this->isSelectedDay($day) && $day->isCurrentMonth && !$day->isToday,
                            'text-gray-400' =>
                                !$this->isSelectedDay($day) && !$day->isCurrentMonth && !$day->isToday,
                            'text-indigo-600' => $day->isToday() && !$this->isSelectedDay($day),
                            'rounded-tl-lg' => $loop->parent->first && $loop->first,
                            'rounded-tr-lg' => $loop->parent->first && $loop->last,
                            'rounded-bl-lg' => $loop->parent->last && $loop->first,
                            'rounded-br-lg' => $loop->parent->last && $loop->last,
                            'py-1.5 hover:bg-gray-100 focus:z-10',
                        ])
                        wire:click="setDay('{{ $day->date }}')"
                    >
                        <time
                            dateTime={{ $day->date }}
                            @class([
                                'bg-indigo-600' => $this->isSelectedDay($day) && $day->isToday,
                                'bg-gray-900' => $this->isSelectedDay($day) && !$day->isToday,
                                'mx-auto flex h-7 w-7 items-center justify-center rounded-full',
                            ])
                        >
                            {{ $day->getNumber() }}
                        </time>
                    </button>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
