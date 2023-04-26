<div class="lg:flex lg:h-screen lg:flex-col">
    <header class="flex h-20 flex-none items-center justify-between border-b border-gray-200 px-6 py-4">
        <div>
            @if ($selectedView === 'day')
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    <time datetime="{{ $selectedDateTime->toDateString() }}" class="sm:hidden">
                        {{ $day->date->format('F d, Y') }}
                    </time>

                    <time datetime="{{ $selectedDateTime->toDateString() }}" class="hidden sm:inline">
                        {{ $day->date->format('F d, Y') }}
                    </time>
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $selectedDateTime->format('l') }}
                </p>
            @endif

            @if ($selectedView === 'week')
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    @php($weekOfYear = $week->days->first()->date->weekOfYear)

                    <time datetime="{{ $selectedDateTime->toDateString() }}" class="sm:hidden">
                        Week {{ $weekOfYear }}
                    </time>

                    <time datetime="{{ $selectedDateTime->toDateString() }}" class="hidden sm:inline">
                        Week {{ $weekOfYear }}
                    </time>
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $selectedDateTime->format('F') }}
                </p>
            @endif

            @if ($selectedView === 'month')
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    <time datetime="{{ $selectedDateTime->toDateString() }}" class="sm:hidden">
                        {{ $selectedDateTime->format('F Y') }}
                    </time>

                    <time datetime="{{ $selectedDateTime->toDateString() }}" class="hidden sm:inline">
                        {{ $selectedDateTime->format('F Y') }}
                    </time>
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $selectedDateTime->format('F') }}
                </p>
            @endif

            @if ($selectedView === 'year')
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    <time datetime="{{ $selectedDateTime->toDateString() }}" class="sm:hidden">
                        {{ $selectedDateTime->toFormattedDateString() }}
                    </time>

                    <time datetime="{{ $selectedDateTime->toDateString() }}" class="hidden sm:inline">
                        {{ $selectedDateTime->toFormattedDateString() }}
                    </time>
                </h1>
            @endif
        </div>

        <div class="flex items-center">
            <div class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch">
                <div class="pointer-events-none absolute inset-0 rounded-md ring-1 ring-inset ring-gray-300"
                    aria-hidden="true"></div>

                <button type="button"
                    class="flex items-center justify-center rounded-l-md py-2 pl-3 pr-4 text-gray-400 hover:text-gray-500 md:w-9 md:px-2 md:hover:bg-gray-50"
                    wire:click="moveCursor('previous')">
                    <span class="sr-only">Previous {{ $selectedView }}</span>

                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <button type="button"
                    class="hidden px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 md:block"
                    wire:click="moveCursor('today')">Today</button>

                <span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden"></span>

                <button type="button"
                    class="flex items-center justify-center rounded-r-md py-2 pl-4 pr-3 text-gray-400 hover:text-gray-500 md:w-9 md:px-2 md:hover:bg-gray-50"
                    wire:click="moveCursor('next')">
                    <span class="sr-only">Next {{ $selectedView }}</span>

                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="hidden md:ml-4 md:flex md:items-center" x-data="{ isOpen: false }"
                @keydown.escape="isOpen = false">
                <div class="relative">
                    <button type="button"
                        class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        @click="isOpen = ! isOpen">
                        {{ Str::title($selectedView) }}

                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div class="absolute right-0 z-10 mt-3 w-32 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        @click.outside="isOpen = false">
                        <div class="py-1" role="none">
                            <button type="button" role="menuitem" tabindex="-1"
                                wire:click="$set('selectedView', 'day')" @click="isOpen = false"
                                @class([
                                    'bg-gray-100 text-gray-900' => $selectedView === 'day',
                                    'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                                ])>
                                Day View
                            </button>

                            <button type="button" role="menuitem" tabindex="-1"
                                wire:click="$set('selectedView', 'week')" @click="isOpen = false"
                                @class([
                                    'bg-gray-100 text-gray-900' => $selectedView === 'week',
                                    'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                                ])>
                                Week View
                            </button>

                            <button type="button" role="menuitem" tabindex="-1"
                                wire:click="$set('selectedView', 'month')" @click="isOpen = false"
                                @class([
                                    'bg-gray-100 text-gray-900' => $selectedView === 'month',
                                    'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                                ])>
                                Month View
                            </button>

                            <button type="button" role="menuitem" tabindex="-1"
                                wire:click="$set('selectedView', 'year')" @click="isOpen = false"
                                @class([
                                    'bg-gray-100 text-gray-900' => $selectedView === 'year',
                                    'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                                ])>
                                Year View
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative ml-6 md:hidden" x-data="{ isOpen: false }">
                <button type="button"
                    class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500"
                    id="menu-0-button" aria-expanded="false" aria-haspopup="true" @click="isOpen = ! isOpen">
                    <span class="sr-only">Open menu</span>

                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path
                            d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                    </svg>
                </button>

                <div class="absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu" aria-orientation="vertical" aria-labelledby="menu-0-button" tabindex="-1"
                    x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    @click.outside="isOpen = false">
                    <div class="py-1" role="none">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                            tabindex="-1" wire:click="moveCursor('today')">Go to today</a>
                    </div>

                    <div class="py-1" role="none">
                        <button type="button" role="menuitem" tabindex="-1"
                            wire:click="$set('selectedView', 'day')" @click="isOpen = false"
                            @class([
                                'bg-gray-100 text-gray-900' => $selectedView === 'day',
                                'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                            ])>Day view</button>

                        <button type="button" role="menuitem" tabindex="-1"
                            wire:click="$set('selectedView', 'week')"
                            @click="isOpen = false"class([ 'bg-gray-100 text-gray-900'=> $selectedView === 'week',
                            'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                            ])>Week view</button>

                        <button type="button" role="menuitem" tabindex="-1"
                            wire:click="$set('selectedView', 'month')" @click="isOpen = false"
                            @class([
                                'bg-gray-100 text-gray-900' => $selectedView === 'month',
                                'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                            ])>Month view</button>

                        <button type="button" role="menuitem" tabindex="-1"
                            wire:click="$set('selectedView', 'year')" @click="isOpen = false"
                            @class([
                                'bg-gray-100 text-gray-900' => $selectedView === 'year',
                                'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                            ])>Year view</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="bg-white lg:h-full">
        @if ($selectedView === 'day')
            <div class="isolate flex flex-auto overflow-hidden bg-white">
                <div class="flex flex-auto flex-col overflow-auto">
                    <div
                        class="sticky top-0 z-10 grid flex-none grid-cols-7 bg-white text-xs text-gray-500 shadow ring-1 ring-black ring-opacity-5 md:hidden">
                        @foreach ($week->days as $weekDay)
                            <button type="button" class="flex flex-col items-center pb-1.5 pt-3">
                                <span>
                                    {{ $weekDay->character() }}
                                </span>

                                <span @class([
                                    'mt-3 flex h-8 w-8 items-center justify-center rounded-full text-base font-semibold text-gray-900',
                                    'bg-gray-900 text-white' => $this->isSelectedDay($weekDay),
                                    'bg-indigo-600 text-white' => $weekDay->isToday(),
                                    'text-indigo-600' => $weekDay->isToday() && !$this->isSelectedDay($weekDay),
                                ]) wire:click="setDay('{{ $weekDay->date }}')">
                                    {{ $day->number() }}
                                </span>
                            </button>
                        @endforeach
                    </div>

                    <div class="flex w-full flex-auto">
                        <div class="w-14 flex-none bg-white ring-1 ring-gray-100"></div>

                        <div class="grid flex-auto grid-cols-1 grid-rows-1">
                            <div class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100"
                                style="grid-template-rows: repeat(48, minmax(3.5rem, 1fr))">
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

                            <ol class="col-start-1 col-end-2 row-start-1 grid grid-cols-1"
                                style="grid-template-rows: 1.75rem repeat(288, minmax(0, 1fr)) auto">
                                @foreach ($this->eventsForDay($day, $events) as $event)
                                    <li class="relative mt-px flex" style="{{ $event->calculateGridRow() }}">
                                        <span
                                            class="group absolute inset-1 flex cursor-pointer flex-col overflow-y-auto rounded-lg bg-blue-50 p-2 text-xs leading-5 hover:bg-blue-100"
                                            wire:click="onEventClick('{{ $event->id }}')">
                                            <p class="order-1 font-semibold text-blue-700">
                                                {{ $event->name }}
                                            </p>

                                            @if ($event->description)
                                                <p class="order-1 text-blue-500 group-hover:text-blue-700">
                                                    {{ $event->description }}
                                                </p>
                                            @endif

                                            <p class="text-blue-500 group-hover:text-blue-700">
                                                <time datetime="{{ $event->dateTime() }}">
                                                    {{ $event->startTimeHuman($formatEventTime) }}
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
                        <button type="button"
                            class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                            wire:click="moveCursor('previous', 'month')">
                            <span class="sr-only">Previous month</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="flex-auto text-sm font-semibold">
                            {{ $selectedDateTime->format('F Y') }}
                        </div>
                        <button type="button"
                            class="-m-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                            wire:click="moveCursor('next', 'month')">
                            <span class="sr-only">Next month</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 grid grid-cols-7 text-center text-xs leading-6 text-gray-500">
                        @foreach ($dayLabels as $dayLabel)
                            <div>{{ $dayLabel->getCharacter() }}</div>
                        @endforeach
                    </div>
                    <div
                        class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
                        @foreach ($month->weeks as $week)
                            @foreach ($week->days as $dayIdx => $day)
                                <button type="button" @class([
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
                                    wire:click="setDay('{{ $day->date }}')">
                                    <time dateTime={{ $day->date }} @class([
                                        'bg-indigo-600' => $this->isSelectedDay($day) && $day->isToday,
                                        'bg-gray-900' => $this->isSelectedDay($day) && !$day->isToday,
                                        'mx-auto flex h-7 w-7 items-center justify-center rounded-full',
                                    ])>
                                        {{ $day->number() }}
                                    </time>
                                </button>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($selectedView === 'week')
            <div class="isolate flex flex-auto flex-col overflow-auto bg-white">
                <div style="width: 165%" class="flex max-w-full flex-none flex-col sm:max-w-none md:max-w-full">
                    <div class="sticky top-0 z-30 flex-none bg-white shadow ring-1 ring-black ring-opacity-5 sm:pr-8">
                        <div class="grid grid-cols-7 text-sm leading-6 text-gray-500 sm:hidden">
                            @foreach ($week->days as $weekDay)
                                <button type="button" class="flex flex-col items-center pb-1.5 pt-3">
                                    <span class="text-xs">
                                        {{ $weekDay->character() }}
                                    </span>

                                    <span @class([
                                        'mt-3 flex h-8 w-8 items-center justify-center rounded-full text-base font-semibold text-gray-900',
                                        'bg-gray-900 text-white' => $this->isSelectedDay($weekDay),
                                        'bg-indigo-600 text-white' => $weekDay->isToday(),
                                        'text-indigo-600' => $weekDay->isToday() && !$this->isSelectedDay($weekDay),
                                    ]) wire:click="setDay('{{ $weekDay->date }}')">
                                        {{ $weekDay->number() }}
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
                                        {{ $weekDay->shortName() }}
                                        <span @class([
                                            'ml-1.5 flex h-8 w-8 rounded-full bg-indigo-600 text-white' =>
                                                $weekDay->isToday,
                                            'text-gray-900' => !$weekDay->isToday,
                                            'items-center justify-center font-semibold cursor-pointer',
                                        ])
                                            wire:click="setDay('{{ $weekDay->date }}')">
                                            {{ $weekDay->number() }}
                                        </span>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-auto">
                        <div class="sticky left-0 z-10 w-14 flex-none bg-white ring-1 ring-gray-100"></div>

                        <div class="grid flex-auto grid-cols-1 grid-rows-1">
                            <div class="col-start-1 col-end-2 row-start-1 grid divide-y divide-gray-100"
                                style="grid-template-rows: repeat(48, minmax(3.5rem, 1fr))">
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

                            <ol class="col-start-1 col-end-2 row-start-1 grid grid-cols-1 sm:grid-cols-7 sm:pr-8"
                                style="grid-template-rows: 1.75rem repeat(288, minmax(0, 1fr)) auto">
                                @foreach ($week->days as $dayIndex => $day)
                                    @foreach ($this->eventsForDay($day, $events) as $event)
                                        <li class="sm:col-start-{{ $dayIndex + 1 }} relative mt-px flex"
                                            style="{{ $event->calculateGridRow() }}">
                                            <span
                                                class="group absolute inset-1 flex cursor-pointer flex-col overflow-y-auto rounded-lg bg-blue-50 p-2 text-xs leading-5 hover:bg-blue-100"
                                                wire:click="onEventClick('{{ $event->id }}')">
                                                <p class="order-1 font-semibold text-blue-700">
                                                    {{ $event->name }}
                                                </p>

                                                @if ($event->description)
                                                    <p class="order-1 text-blue-500 group-hover:text-blue-700">
                                                        {{ $event->description }}
                                                    </p>
                                                @endif

                                                <p class="text-blue-500 group-hover:text-blue-700">
                                                    <time datetime="{{ $event->dateTime() }}">
                                                        {{ $event->startTimeHuman($formatEventTime) }}
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
        @endif

        @if ($selectedView === 'month')
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
                                    <div @class([
                                        'bg-white' => $day->isCurrentMonth,
                                        'bg-gray-50 text-gray-500' => !$day->isCurrentMonth,
                                        'relative px-3 py-2',
                                    ])>
                                        <time dateTime="{{ $day->date }}" @class([
                                            'flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white' =>
                                                $day->isToday,
                                            'cursor-pointer',
                                        ])
                                            wire:click="setDay('{{ $day->date }}')">
                                            {{ $day->number() }}
                                        </time>

                                        @unless ($this->eventsForDay($day, $events)->isEmpty())
                                            <ol class="mt-2">
                                                @foreach ($this->eventsForDay($day, $events) as $event)
                                                    <li>
                                                        <span class="group flex cursor-pointer"
                                                            wire:click="onEventClick('{{ $event->id }}')">
                                                            <p
                                                                class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">
                                                                {{ $event->name }}
                                                            </p>

                                                            <time dateTime={{ $event->dateTime() }}
                                                                class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">
                                                                {{ $event->time($formatEventTime) }}
                                                            </time>
                                                        </span>
                                                    </li>
                                                @endforeach

                                                @if ($events->count() > 2)
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
                                    <button type="button" @class([
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
                                    ])>
                                        <time dateTime="{{ $day->date }}" @class([
                                            'flex h-6 w-6 items-center justify-center rounded-full' => $this->isSelectedDay(
                                                $day),
                                            'bg-indigo-600' => $this->isSelectedDay($day) && $day->isToday,
                                            'bg-gray-900' => $this->isSelectedDay($day) && !$day->isToday,
                                            'ml-auto',
                                        ])>
                                            {{ $day->number() }}
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
                                        <time dateTime={{ $event->dateTime() }}
                                            class="mt-2 flex items-center text-gray-700">
                                            <ClockIcon class="mr-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                                            {{ $event->time($formatEventTime) }}
                                        </time>
                                    </div>
                                    <span
                                        class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100"
                                        wire:click="onEventClick('{{ $event->id }}')">
                                        Edit<span class="sr-only">, {{ $event->name }}</span>
                                    </span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endif
            </div>
        @endif

        @if ($selectedView === 'year')
            <div
                class="mx-auto grid max-w-3xl grid-cols-1 gap-x-8 gap-y-16 px-4 py-16 sm:grid-cols-2 sm:px-6 xl:max-w-none xl:grid-cols-3 xl:px-8 2xl:grid-cols-4">
                @foreach ($year->months as $month)
                    <section class="text-center">
                        <h2 class="text-sm font-semibold text-gray-900" wire:click="setMonth({{ $month->number }})">
                            {{ $month->name() }}
                        </h2>

                        <div class="mt-6 grid grid-cols-7 text-xs leading-6 text-gray-500">
                            @foreach ($dayLabels as $dayLabel)
                                <div>{{ $dayLabel->getCharacter() }}</div>
                            @endforeach
                        </div>

                        <div
                            class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
                            @foreach ($month->weeks as $week)
                                @foreach ($week->days as $dayIdx => $day)
                                    <button type="button" @class([
                                        'bg-white text-gray-900' => $day->isCurrentMonth,
                                        'bg-gray-50 text-gray-400' => !$day->isCurrentMonth,
                                        'rounded-tl-lg' => $loop->parent->first && $loop->first,
                                        'rounded-tr-lg' => $loop->parent->first && $loop->last,
                                        'rounded-bl-lg' => $loop->parent->last && $loop->first,
                                        'rounded-br-lg' => $loop->parent->last && $loop->last,
                                        'py-1.5 hover:bg-gray-100 focus:z-10',
                                    ])
                                        wire:click="setDay('{{ $day->date }}')">
                                        <time datetime="" @class([
                                            'bg-indigo-600 font-semibold text-white' => $day->isToday,
                                            'mx-auto flex h-7 w-7 items-center justify-center rounded-full',
                                        ])>
                                            {{ $day->number() }}
                                        </time>
                                    </button>
                                @endforeach
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>
        @endif
    </div>
</div>
