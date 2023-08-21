<div class="lg:flex lg:h-full lg:flex-col">
    <div class="shadow ring-1 ring-black ring-opacity-5 lg:flex lg:flex-auto lg:flex-col">
        <div
            class="grid grid-cols-7 gap-px border-b border-gray-300 bg-gray-200 text-center text-xs font-semibold leading-6 text-gray-700 lg:flex-none">
            @foreach ($dayLabels as $dayLabel)
                <div class="flex justify-center bg-white py-2">
                    <span>{{ $dayLabel->getCharacter() }}</span>
                    <span class="sr-only sm:not-sr-only">{{ $dayLabel->getCharacterSuffix() }}</span>
                </div>
            @endforeach
        </div>

        <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">
            <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-6 lg:gap-px">
                @foreach ($month->weeks as $week)
                    @foreach ($week->days as $day)
                        <div
                            id="{{ $componentId }}-{{ $day->date }}"
                            ondragenter="onLivewireCalendarEventDragEnter(event, '{{ $componentId }}', '{{ $day->date }}', '{{ $dragAndDropClasses }}');"
                            ondragleave="onLivewireCalendarEventDragLeave(event, '{{ $componentId }}', '{{ $day->date }}', '{{ $dragAndDropClasses }}');"
                            ondragover="onLivewireCalendarEventDragOver(event);"
                            ondrop="onLivewireCalendarEventDrop(event, '{{ $componentId }}', '{{ $day->date }}', '{{ $dragAndDropClasses }}');"
                            @class([
                                'bg-white' => $day->isCurrentMonth,
                                'bg-gray-50 text-gray-500' => !$day->isCurrentMonth,
                                'relative px-3 py-2',
                            ])
                        >
                            <time
                                dateTime="{{ $day->date }}"
                                @class([
                                    'flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white' =>
                                        $day->isToday,
                                    'cursor-pointer',
                                ])
                                wire:click="setDay('{{ $day->date }}')"
                            >
                                {{ $day->getNumber() }}
                            </time>

                            @unless ($this->eventsForDay($day, $events)->isEmpty())
                                <ol class="mt-2">
                                    @foreach ($this->eventsForDay($day, $events) as $event)
                                        <li
                                            draggable="true"
                                            ondragstart="onLivewireCalendarEventDragStart(event, '{{ $event->id }}')"
                                        >
                                            <span
                                                class="group flex cursor-pointer"
                                                wire:click="onEventClick('{{ $event->id }}')"
                                            >
                                                <p
                                                    class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                                    {{ $event->name }}
                                                </p>

                                                <time
                                                    class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block"
                                                    dateTime={{ $event->getDateTime() }}
                                                >
                                                    {{ $event->getTime($formatEventTime) }}
                                                </time>
                                            </span>
                                        </li>
                                    @endforeach

                                    @if ($this->eventsForDay($day, $events)->count() > 2)
                                        <li class="text-gray-500">
                                            + {{ $events->count() - 2 }} more
                                        </li>
                                    @endif
                                </ol>
                            @endunless
                        </div>
                    @endforeach
                @endforeach
            </div>

            <div class="isolate grid w-full grid-cols-7 grid-rows-6 gap-px lg:hidden">
                @foreach ($month->weeks as $week)
                    @foreach ($week->days as $day)
                        <button
                            type="button"
                            @class([
                                'bg-white' => $day->isCurrentMonth,
                                'bg-gray-50' => !$day->isCurrentMonth,
                                'font-semibold' => $this->isSelectedDay($day) || $day->isToday,
                                'text-white' => $this->isSelectedDay($day),
                                'text-indigo-600' => !$this->isSelectedDay($day) && $day->isToday,
                                'text-gray-900' =>
                                    !$this->isSelectedDay($day) && $day->isCurrentMonth && !$day->isToday,
                                'text-gray-500' =>
                                    !$this->isSelectedDay($day) && !$day->isCurrentMonth && !$day->isToday,
                                'flex h-14 flex-col px-3 py-2 hover:bg-gray-100 focus:z-10',
                            ])
                        >
                            <time
                                dateTime="{{ $day->date }}"
                                @class([
                                    'flex h-6 w-6 items-center justify-center rounded-full' => $this->isSelectedDay(
                                        $day),
                                    'bg-indigo-600' => $this->isSelectedDay($day) && $day->isToday,
                                    'bg-gray-900' => $this->isSelectedDay($day) && !$day->isToday,
                                    'ml-auto',
                                ])
                            >
                                {{ $day->getNumber() }}
                            </time>

                            <span class="sr-only">{{ $this->eventsForDay($day, $events)->count() }}
                                events</span>

                            @unless ($this->eventsForDay($day, $events)->isEmpty())
                                <span class="-mx-0.5 mt-auto flex flex-wrap-reverse">
                                    @foreach ($this->eventsForDay($day, $events) as $event)
                                        <span class="mx-0.5 mb-1 h-1.5 w-1.5 rounded-full bg-gray-400">
                                        </span>
                                    @endforeach
                                </span>
                            @endunless
                        </button>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    @if ($day)
        <div class="px-4 py-10 sm:px-6 lg:hidden">
            <ol
                class="divide-y divide-gray-100 overflow-hidden rounded-lg bg-white text-sm shadow ring-1 ring-black ring-opacity-5">
                @foreach ($this->eventsForDay($day, $events) as $event)
                    <li class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
                        <div class="flex-auto">
                            <p class="font-semibold text-gray-900">
                                {{ $event->name }}
                            </p>
                            <time
                                class="mt-2 flex items-center text-gray-700"
                                dateTime={{ $event->getDateTime() }}
                            >
                                <ClockIcon
                                    class="mr-2 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                                {{ $event->getTime($formatEventTime) }}
                            </time>
                        </div>
                        <span
                            class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100"
                            wire:click="onEventClick('{{ $event->id }}')"
                        >
                            Edit<span class="sr-only">, {{ $event->name }}</span>
                        </span>
                    </li>
                @endforeach
            </ol>
        </div>
    @endif
</div>
