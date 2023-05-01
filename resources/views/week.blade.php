<div class="isolate flex flex-auto flex-col overflow-auto bg-white">
    <div
        class="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full"
        style="width: 165%"
    >
        <div class="sticky top-0 z-30 flex-none bg-white shadow ring-1 ring-black ring-opacity-5 sm:pr-8">
            <div class="grid grid-cols-7 text-sm leading-6 text-gray-500 sm:hidden">
                @foreach ($week->days as $weekDay)
                    <button
                        class="flex flex-col items-center pb-1.5 pt-3"
                        type="button"
                    >
                        <span class="text-xs">
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
                            {{ $weekDay->getNumber() }}
                        </span>
                    </button>
                @endforeach
            </div>

            <div
                class="-mr-px hidden h-16 grid-cols-7 divide-x divide-gray-100 border-r border-gray-100 text-sm leading-6 text-gray-500 sm:grid">
                <div class="col-end-1 w-14"></div>
                @foreach ($week->days as $weekDay)
                    <div class="flex items-center justify-center py-3">
                        <span @class(['flex items-baseline' => $weekDay->isToday])>
                            {{ $weekDay->getShortName() }}
                            <span
                                @class([
                                    'ml-1.5 flex h-8 w-8 rounded-full bg-indigo-600 text-white' =>
                                        $weekDay->isToday,
                                    'text-gray-900' => !$weekDay->isToday,
                                    'items-center justify-center font-semibold cursor-pointer',
                                ])
                                wire:click="setDay('{{ $weekDay->date }}')"
                            >
                                {{ $weekDay->getNumber() }}
                            </span>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-auto">
            <div class="sticky left-0 z-10 w-14 flex-none bg-white ring-1 ring-gray-100"></div>

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

                <div
                    class="col-start-1 col-end-2 row-start-1 hidden grid-cols-7 grid-rows-1 divide-x divide-gray-100 sm:grid sm:grid-cols-7">
                    <div class="col-start-1 row-span-full"></div>
                    <div class="col-start-2 row-span-full"></div>
                    <div class="col-start-3 row-span-full"></div>
                    <div class="col-start-4 row-span-full"></div>
                    <div class="col-start-5 row-span-full"></div>
                    <div class="col-start-6 row-span-full"></div>
                    <div class="col-start-7 row-span-full"></div>
                    <div class="col-start-8 row-span-full w-8"></div>
                </div>

                <ol
                    class="col-start-1 col-end-2 row-start-1 grid grid-cols-1 sm:grid-cols-7 sm:pr-8"
                    style="grid-template-rows: 1.75rem repeat(288, minmax(0, 1fr)) auto"
                >
                    @foreach ($week->days as $dayIndex => $day)
                        @foreach ($this->eventsForDay($day, $events) as $event)
                            <li
                                class="sm:col-start-{{ $dayIndex + 1 }} relative mt-px flex"
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
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
